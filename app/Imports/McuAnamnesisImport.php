<?php

namespace App\Imports;

use App\Models\AnamnesisT;
use App\Models\EmployeeM;
use App\Models\McuT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuAnamnesisImport implements ToCollection, WithHeadingRow
{

    public function __construct($mcuDate, $companyId, $mcuProgramId)
    {
        $this->mcuDate = $mcuDate;
        $this->companyId = $companyId;
        $this->mcuProgramId = $mcuProgramId;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $rps = [
            'asma',
            'kencing_manis',
            'kejang_kejang_berulang',
            'penyakit_jantung',
            'batuk_dahak_darah',
            'rheumatik',
            'tekanan_darah_tinggi',
            'tekanan_darah_rendah',
            'sering_bengkak_wajah_kaki',
            'riwayat_operasi',
            'catatan_riwayat_operasi',
            'obat_terus_menerus',
            'alergi',
            'hepatitis',
            'kecanduan_obat_obatan',
            'patah_tulang',
            'gangguan_pendengaran',
            'perokok',
            'olahraga_rutin',
            'nyeri_buang_air_kecil',
            'keputihan',
            'epilepsi',
            'catatan_epilepsi',
            'keluhan_utama'
        ];

        $rps_en = [
            'asthma',
            'diabetes',
            'recurrent_seizures',
            'heart_disease',
            'haemoptysis',
            'rheumatism',
            'hypertension',
            'hypotension',
            'angioedema',
            'surgical_history',
            'surgical_history_notes',
            'drug_continously',
            'allergy',
            'hepatitis',
            'drug_addiction',
            'fracture',
            'hearing_disorders',
            'smoker',
            'exercise_regularly',
            'pain_when_urinating',
            'white_discharge',
            'epilepsy',
            'epilepsy_notes',
            'main_complaint'

        ];
        DB::beginTransaction();

        foreach ($collection as $row)
        {
            $riwayatPenyakit = [];

            foreach ($rps as $index => $r) {
                if ($r == 'catatan_riwayat_operasi' || $r == 'catatan_epilepsi' || $r == 'keluhan_utama') {
                    $riwayatPenyakit[$rps_en[$index]] = isset($row["riwayat_penyakit_sebelumnya_$r"]) ? $row["riwayat_penyakit_sebelumnya_$r"] : '';
                } else {
                    $riwayatPenyakit[$rps_en[$index]] = isset($row["riwayat_penyakit_sebelumnya_$r"]) && $row["riwayat_penyakit_sebelumnya_$r"] == 'Ya' ? 1 : 0;
                }
            }
            $employeeModel = EmployeeM::select('employee_id')->where('nik', $row['nik'])->first();

            if ($employeeModel == null) {
                DB::rollBack();
                throw new \Exception('Terjadi Kesalahan! Peserta Tidak Ditemukan!');
            }
            $modelMcu = McuT::select('mcu_id')
                ->where('employee_id', $employeeModel->employee_id)
                ->where('company_id', $this->companyId)
                ->where('mcu_program_id', $this->mcuProgramId)
                ->where('is_import', true)->first();

            if ($modelMcu != null) {
                $mcu_id = $modelMcu->mcu_id;
            } else {
                McuT::insert([
                    'mcu_date' => $this->mcuDate,
                    'employee_id' => $employeeModel->employee_id,
                    'company_id' => $this->companyId,
                    'mcu_program_id' => $this->mcuProgramId,
                    'is_import' => true
                ]);
                $modelMcu = McuT::select('mcu_id')
                    ->where('employee_id', $employeeModel->employee_id)
                    ->where('company_id', $this->companyId)
                    ->where('mcu_program_id', $this->mcuProgramId)
                    ->where('is_import', true)->first();
                $mcu_id = $modelMcu->mcu_id;
            }

            $modelAnamnesis = AnamnesisT::select('anamnesis_id')->where('mcu_id', $mcu_id)->first();
            if ($modelAnamnesis != null) {
                AnamnesisT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'anamnesis_code' => '-',
                'anamnesis_date' => date('Y-m-d H:i:s'),
                'medical_history' => json_encode($riwayatPenyakit),
                'systolic' => $row['pemeriksaan_umum_sistol'],
                'diastolic' => $row['pemeriksaan_umum_diastol'],
            ];
            AnamnesisT::insert($data);
        }
        DB::commit();
    }
}
