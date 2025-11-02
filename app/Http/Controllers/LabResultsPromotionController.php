<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class LabResultsPromotionController extends Controller
{
    public function promote(Request $request, int $inbox)
    {
        $userId = auth()->id() ?? 1;

        return DB::transaction(function () use ($inbox, $userId) {
            // 1) Lock inbox row
            $row = DB::table('lab_results_inbox_t')
                ->lockForUpdate()
                ->where('inbox_id', $inbox)
                ->first();

            if (!$row) {
                return back()->with('error', "Inbox #{$inbox} not found.");
            }

            if (($row->status ?? null) === 'promoted' && $row->promoted_lab_id) {
                return back()->with('success', "Already promoted (Lab #{$row->promoted_lab_id}).");
            }

            // 2) Decode payload + normalize OBX code/name
            $payload = is_string($row->payload) ? json_decode($row->payload, true) : (array) $row->payload;
            $obx = is_array($payload['obx'] ?? null) ? $payload['obx'] : [];
            $obx = array_map(function ($o) {
                $name = $o['test_name'] ?? ($o['name'] ?? ($o['code'] ?? null));
                if ($name) {
                    $o['name'] = $o['name'] ?? $name;
                    $o['code'] = $o['code'] ?? $name;
                }
                return $o;
            }, $obx);
            $source = $row->source ?? ($payload['source'] ?? null);

            // 3) Try DB function first (if present)
            try {
                $fn = DB::selectOne('select * from fn_promote_lab_inbox(?, ?, ?)', [$row->inbox_id, $source, $userId]);
                if ($fn && ($fn->laboratory_id ?? null)) {
                    DB::table('lab_results_inbox_t')
                        ->where('inbox_id', $row->inbox_id)
                        ->update([
                            'status'          => 'promoted',
                            'promoted_lab_id' => $fn->laboratory_id,
                            'promoted_by'     => $userId,
                            'promoted_at'     => now(),
                            'updated_at'      => now(),
                        ]);

                    return back()->with(
                        'success',
                        "Promoted via DB function (Lab #{$fn->laboratory_id}, items: " . (($fn->inserted_count ?? 0)) . ")."
                    );
                }
            } catch (Throwable $e) {
                Log::warning('fn_promote_lab_inbox failed, falling back', [
                    'inbox_id' => $inbox,
                    'error'    => $e->getMessage(),
                ]);
            }

            // 4) Fallback in Laravel — build alias maps
            $aliases = DB::table('laboratory_examination_alias_m')
                ->where('source', $source)
                ->where('active', true)
                ->get(['incoming_code', 'incoming_name', 'laboratory_examination_id']);

            $map = [];
            foreach ($aliases as $a) {
                if ($a->incoming_code) {
                    $k = strtoupper($a->incoming_code);
                    if (!isset($map[$k])) $map[$k] = (int) $a->laboratory_examination_id;
                }
                if ($a->incoming_name) {
                    $k = strtoupper($a->incoming_name);
                    if (!isset($map[$k])) $map[$k] = (int) $a->laboratory_examination_id;
                }
            }

            // 5) Create lab header
            $labId = DB::table('laboratory_t')->insertGetId([
                'mcu_id'          => $row->mcu_id,
                'laboratory_date' => $row->run_at ?? now(),
                'additional_data' => json_encode(
                    ['source' => $source, 'inbox_id' => $row->inbox_id],
                    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                ),
                'created_at'      => now(),
                'updated_at'      => now(),
            ], 'laboratory_id');

            // 6) Insert details
            $inserted = 0;
            $skipped  = [];

            foreach ($obx as $o) {
                $code = strtoupper($o['code'] ?? ($o['test_name'] ?? ''));
                if (!$code || !isset($map[$code])) {
                    $skipped[] = $code ?: '(empty)';
                    continue;
                }

                $flag = strtoupper((string)($o['flag'] ?? ''));
                $isAbnormal = in_array($flag, ['H', 'HH', 'L', 'LL', 'A', 'AH', 'AL'], true) ? true : null;

                DB::table('laboratory_detail_t')->insert([
                    'laboratory_id'                   => $labId,
                    'laboratory_examination_id'       => $map[$code],
                    'laboratory_reference_value_id'   => null,
                    'result'                          => $o['value'] ?? null,
                    'is_abnormal'                     => $isAbnormal,
                    'created_at'                      => now(),
                    'updated_at'                      => now(),
                ]);

                $inserted++;
            }

            // 7) If nothing mapped, rollback header and abort
            if ($inserted === 0) {
                DB::table('laboratory_t')->where('laboratory_id', $labId)->delete();
                return back()->with('error', 'Promote failed: no OBX items mapped for source ' . $source . '.');
            }

            // 8) Mark inbox as promoted
            DB::table('lab_results_inbox_t')
                ->where('inbox_id', $row->inbox_id)
                ->update([
                    'status'          => 'promoted',
                    'promoted_lab_id' => $labId,
                    'promoted_by'     => $userId,
                    'promoted_at'     => now(),
                    'updated_at'      => now(),
                ]);

            Log::info('Laboratory promoted via Laravel fallback', [
                'inbox_id' => $row->inbox_id,
                'labId'    => $labId,
                'inserted' => $inserted,
                'skipped'  => $skipped,
            ]);

            $msg = "Promoted via fallback (Lab #{$labId}, items: {$inserted})";
            if (count($skipped)) $msg .= ' — skipped: ' . implode(', ', $skipped);

            return back()->with('success', $msg);
        });
    }
}
