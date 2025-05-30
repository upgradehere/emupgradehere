<?php

namespace App\Imports;

use App\Helpers\ConstantsHelper;
use App\Models\DoctorM;
use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\ResumeMcuT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuResumeMcuImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        foreach ($collection as $row)
        {
            $modelMcu = McuT::select('mcu_id')
                ->where('mcu_code', $row['mcu_code'])
                ->first();

            if ($modelMcu == null) {
                throw new \Exception('Terjadi Kesalahan! Peserta dengan kode mcu '.$row['mcu_code'].' Tidak Ditemukan!');
            }

            $mcu_id = $modelMcu->mcu_id;

            $doctor_id = null;
            if (!empty($row['doctor_code'])) {
                $modelDoctor = DoctorM::select('doctor_id')
                ->where('doctor_code', $row['doctor_code'])
                ->first();
                $doctor_id = $modelDoctor->doctor_id;
            }

            if ($modelDoctor == null) {
                throw new \Exception('Terjadi Kesalahan! Dokter dengan kode '.$row['doctor_code'].' Tidak Ditemukan!');
            }

            $modelResumeMcu = ResumeMcuT::select('resume_mcu_id')->where('mcu_id', $mcu_id)->first();
            if ($modelResumeMcu != null) {
                ResumeMcuT::where('mcu_id', $mcu_id)->delete();
            }

            if (isset($row['kesimpulan_hasil'])) {
                if ($row['kesimpulan_hasil'] == ConstantsHelper::KESIMPULAN_FIT_TO_WORK_NAME) {
                    $resultConclusion = ConstantsHelper::KESIMPULAN_FIT_TO_WORK;
                } elseif ($row['kesimpulan_hasil'] == ConstantsHelper::KESIMPULAN_FIT_TO_WORK_WITH_MEDICAL_NOTE_NAME) {
                    $resultConclusion = ConstantsHelper::KESIMPULAN_FIT_TO_WORK_WITH_MEDICAL_NOTE;
                } elseif ($row['kesimpulan_hasil'] == ConstantsHelper::KESIMPULAN_FIT_TEMPORARY_UNFIT_NAME) {
                    $resultConclusion = ConstantsHelper::KESIMPULAN_FIT_TEMPORARY_UNFIT;
                } elseif ($row['kesimpulan_hasil'] == ConstantsHelper::KESIMPULAN_NEED_FURTHER_EXAMINATION_NAME) {
                    $resultConclusion = ConstantsHelper::KESIMPULAN_NEED_FURTHER_EXAMINATION;
                } elseif ($row['kesimpulan_hasil'] == ConstantsHelper::KESIMPULAN_FIT_WITH_NOTE_NAME) {
                    $resultConclusion = ConstantsHelper::KESIMPULAN_FIT_WITH_NOTE;
                } else {
                    $resultConclusion = null;
                }
            } else {
                $resultConclusion = null;
            }
            $data = [
                'mcu_id' => $mcu_id,
                'resume_mcu_date' => date('Y-m-d H:i:s'),
                'physical_impression' => !empty($row['kesan_fisik']) ? $row['kesan_fisik'] : null,
                'rontgen_impression' => !empty($row['kesan_rontgen']) ? $row['kesan_rontgen'] : null,
                'ekg_impression' => !empty($row['kesan_ekg']) ? $row['kesan_ekg'] : null,
                'audiometry_impression' => !empty($row['kesan_audiometri']) ? $row['kesan_audiometri'] : null,
                'usg_impression' => !empty($row['kesan_usg']) ? $row['kesan_usg'] : null,
                'spirometry_impression' => !empty($row['kesan_spirometri']) ? $row['kesan_spirometri'] : null,
                'refreaction_impression' => !empty($row['kesan_refraksi']) ? $row['kesan_refraksi'] : null,
                'laboratory_impression' => !empty($row['kesan_laboratorium']) ? $row['kesan_laboratorium'] : null,
                'result_conclusion' => $resultConclusion,
                'suggestion' => !empty($row['saran']) ? $row['saran'] : null,
                'doctor_id' => !empty($row['doctor_code']) ? $doctor_id : null,
            ];
            ResumeMcuT::insert($data);
        }
        DB::commit();
    }

}
