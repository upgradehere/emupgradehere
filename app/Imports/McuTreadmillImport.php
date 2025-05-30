<?php

namespace App\Imports;

use App\Models\DoctorM;
use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\TreadmillT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuTreadmillImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
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

            $modelTreadmill = TreadmillT::select('treadmill_id')->where('mcu_id', $mcu_id)->first();
            if ($modelTreadmill != null) {
                TreadmillT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'treadmill_date' => date('Y-m-d H:i:s'),
                'resting_ekg' => !empty($row['ekg_saat_istirahat']) ? $row['ekg_saat_istirahat'] : null,
                'max_heart_rate_target' => !empty($row['target_denyut_jantung_max']) ? $row['target_denyut_jantung_max'] : null,
                'reached' => !empty($row['tercapai']) ? $row['tercapai'] : null,
                'end_test_minute' => !empty($row['test_diakhiri_pada_menit_ke']) ? $row['test_diakhiri_pada_menit_ke'] : null,
                'heart_rate_response' => !empty($row['response_denyut_jantung']) ? $row['response_denyut_jantung'] : null,
                'blood_preassure_response' => !empty($row['response_tekanan_darah']) ? $row['response_tekanan_darah'] : null,
                'aritmia' => !empty($row['aritmia']) ? $row['aritmia'] : null,
                'chest_pain' => !empty($row['nyeri_dada']) ? $row['nyeri_dada'] : null,
                'other_symptoms' => !empty($row['gejala_lain_lain']) ? $row['gejala_lain_lain'] : null,
                'during_after_training_test' => !empty($row['selama_setelah_uji_latih']) ? $row['selama_setelah_uji_latih'] : null,
                'mm_lead' => !empty($row['mm_lead']) ? $row['mm_lead'] : null,
                'at_the_minute' => !empty($row['pada_menit_ke']) ? $row['pada_menit_ke'] : null,
                'st_normalization_after' => !empty($row['st_normalisasi_setelah']) ? $row['st_normalisasi_setelah'] : null,
                'functional_class' => !empty($row['functional_class']) ? $row['functional_class'] : null,
                'freshness_level' => !empty($row['tingkat_kesegaran']) ? $row['tingkat_kesegaran'] : null,
                'aerobic_capacity' => !empty($row['kapasitas_aerobik']) ? $row['kapasitas_aerobik'] : null,
                'conc_normalization_after' => !empty($row['kesimpulan_normalisasi_setelah']) ? $row['kesimpulan_normalisasi_setelah'] : null,
                'is_abnormal' => !empty($row['is_abnormal']) ? $row['is_abnormal'] : null,
                'notes' => !empty($row['catatan']) ? $row['catatan'] : null,
                'is_import' => !empty($row['is_import']) && ($row['is_import']) == true ? true : false,
                'doctor_id' => !empty($row['doctor_code']) ? $doctor_id : null,
            ];
            TreadmillT::insert($data);
        }
        DB::commit();
    }

}
