<?php

namespace App\Jobs;

use App\Models\LabAnalyte;
use App\Models\LabResult;
use App\Models\LabResultItem;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NormalizeLabResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $labResultId;

    /** Cache analyte synonym map across a single job run */
    protected array $mapByCode = [];
    protected array $mapBySynonym = [];            // NORM_NAME => analyte_id
    protected array $mapByInstrumentSynonym = [];  // INSTRUMENT|NORM_NAME => analyte_id

    public function __construct(int $labResultId)
    {
        $this->labResultId = $labResultId;
    }

    public function handle(): void
    {
        $lr = LabResult::find($this->labResultId);
        if (!$lr) return;

        $payload = $lr->raw_data;
        $instrument = $this->detectInstrument($payload); // "TEK8520" / "TC3060" / null
        $measuredAt = $this->detectMeasuredAt($payload); // Carbon|null

        // Build analyte maps (once)
        $this->buildAnalyteMaps();

        // Clear old items (idempotent re-run safety)
        $lr->items()->delete();

        $items = [];

        if (is_array($payload) && array_is_list($payload)) {
            // Legacy TC-3060 batch array (we support it, though your new bridge emits per-patient)
            foreach ($payload as $entry) {
                if (!is_array($entry)) continue;
                $plist = $entry['parameters'] ?? [];
                $measuredAtEntry = $this->parseDate($entry['patient_details']['date_sample_running'] ?? null) ?? $measuredAt;

                foreach ($plist as $p) {
                    $name = trim((string)($p['parameter_name'] ?? ''));
                    $value = (string)($p['parameter_value']['value2'] ?? '');
                    $unit = (string)($p['parameter_value']['unit'] ?? '');
                    $flag = (string)($p['parameter_value']['flag'] ?? '');
                    $refMin = (string)($p['parameter_value']['ref_min'] ?? '');
                    $refMax = (string)($p['parameter_value']['ref_max'] ?? '');
                    $refRange = trim($refMin.'-'.$refMax, '-');

                    if ($name === '') continue;

                    $analyteId = $this->matchAnalyte($name, $instrument);
                    $items[] = [
                        'lab_result_id' => $lr->id,
                        'analyte_id'    => $analyteId,
                        'source_name'   => $name,
                        'value'         => $value,
                        'unit'          => $unit,
                        'flag'          => $flag,
                        'ref_range'     => $refRange,
                        'measured_at'   => $measuredAtEntry,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];
                }
            }
        } elseif (is_array($payload) && isset($payload['obx']) && is_array($payload['obx'])) {
            // TEK8520 or new per-patient TC-3060: obx[]
            foreach ($payload['obx'] as $obx) {
                $name = trim((string)($obx['test_name'] ?? $obx['test_code'] ?? ''));
                $value = (string)($obx['value'] ?? '');
                $unit = (string)($obx['unit'] ?? '');
                $flag = (string)($obx['flag'] ?? '');
                $refRange = (string)($obx['ref_range'] ?? '');

                if ($name === '') continue;

                $analyteId = $this->matchAnalyte($name, $instrument);
                $items[] = [
                    'lab_result_id' => $lr->id,
                    'analyte_id'    => $analyteId,
                    'source_name'   => $name,
                    'value'         => $value,
                    'unit'          => $unit,
                    'flag'          => $flag,
                    'ref_range'     => $refRange,
                    'measured_at'   => $measuredAt,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            }
        } else {
            // Unknown shape — do nothing (we still have raw_data)
        }

        if (!empty($items)) {
            LabResultItem::insert($items);
        }
    }

    protected function detectInstrument($payload): ?string
    {
        if (is_array($payload)) {
            if (isset($payload['source'])) return (string)$payload['source'];
            if (array_is_list($payload) && isset($payload[0]['source'])) return (string)$payload[0]['source'];
        }
        return null;
    }

    protected function detectMeasuredAt($payload): ?Carbon
    {
        // TC-3060 (new): raw_date_sample_running at top-level
        $d = is_array($payload) ? ($payload['raw_date_sample_running'] ?? null) : null;
        if ($d) return $this->parseDate($d);

        // TC-3060 (legacy): patient_details.date_sample_running
        if (is_array($payload) && array_is_list($payload)) {
            $d = $payload[0]['patient_details']['date_sample_running'] ?? null;
            if ($d) return $this->parseDate($d);
        }

        // TEK8520: often no explicit timestamp in obx entries — return null
        return null;
    }

    protected function parseDate($s): ?Carbon
    {
        if (!$s) return null;
        try {
            return Carbon::parse($s);
        } catch (\Throwable $e) {
            return null;
        }
    }

    protected function buildAnalyteMaps(): void
    {
        /** @var Collection<int, LabAnalyte> $analytes */
        $analytes = LabAnalyte::query()->get();

        foreach ($analytes as $a) {
            $id = $a->id;
            // by canonical code
            $this->mapByCode[$this->norm($a->code)] = $id;

            // by synonyms array
            $syns = is_array($a->synonyms) ? $a->synonyms : [];
            foreach ($syns as $syn) {
                $this->mapBySynonym[$this->norm((string)$syn)] = $id;
            }

            // by instrument-specific synonyms
            $inst = is_array($a->instrument_synonyms) ? $a->instrument_synonyms : [];
            foreach ($inst as $instrument => $list) {
                if (!is_array($list)) continue;
                foreach ($list as $syn) {
                    $key = $this->instKey((string)$instrument, (string)$syn);
                    $this->mapByInstrumentSynonym[$key] = $id;
                }
            }
        }
    }

    protected function matchAnalyte(string $name, ?string $instrument): ?int
    {
        $n = $this->norm($name);

        // 1) exact code match
        if (isset($this->mapByCode[$n])) return $this->mapByCode[$n];

        // 2) generic synonyms
        if (isset($this->mapBySynonym[$n])) return $this->mapBySynonym[$n];

        // 3) instrument-specific synonyms
        if ($instrument) {
            $key = $this->instKey($instrument, $name);
            if (isset($this->mapByInstrumentSynonym[$key])) {
                return $this->mapByInstrumentSynonym[$key];
            }
        }

        return null;
    }

    protected function norm(string $s): string
    {
        // Uppercase, replace spaces/dashes with underscore; keep %, #, _ for names like GR%, Lym#, RDW_SD
        $s = strtoupper($s);
        $s = str_replace([' ', '-'], '_', $s);
        // Remove everything except A-Z, 0-9, underscore, percent, hash
        return preg_replace('/[^A-Z0-9_%#]/', '', $s) ?? $s;
    }

    protected function instKey(string $instrument, string $name): string
    {
        return $this->norm($instrument).'|'.$this->norm($name);
    }
}
