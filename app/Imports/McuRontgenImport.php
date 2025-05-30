<?php

namespace App\Imports;

use App\Models\DoctorM;
use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\RontgenT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuRontgenImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
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

            $modelRontgen = RontgenT::select('rontgen_id')->where('mcu_id', $mcu_id)->first();
            if ($modelRontgen != null) {
                RontgenT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'rontgen_date' => date('Y-m-d H:i:s'),
                'rontgen_examination_type' => !empty($row['jenis_pemeriksaan']) ? $row['jenis_pemeriksaan'] : null,
                'clinical_diagnosis' => !empty($row['diagnosa_klinis']) ? $row['diagnosa_klinis'] : null,
                'cor' => !empty($row['cor']) ? $row['cor'] : null,
                'pulmo' => !empty($row['pulmo']) ? $row['pulmo'] : null,
                'oss_costae' => !empty($row['oss_costae']) ? $row['oss_costae'] : null,
                'diaphragmatic_sinus' => !empty($row['sinus_diafragma']) ? $row['sinus_diafragma'] : null,
                'conclusion' => !empty($row['kesimpulan']) ? $row['kesimpulan'] : null,
                'examination_status' => !empty($row['status_pemeriksaan']) ? $row['status_pemeriksaan'] : null,
                'notes' => !empty($row['catatan']) ? $row['catatan'] : null,
                'is_abnormal' => !empty($row['is_abnormal']) ? $row['is_abnormal'] : null,
                'is_import' => !empty($row['is_import']) && ($row['is_import']) == true ? true : false,
                'doctor_id' => !empty($row['doctor_code']) ? $doctor_id : null,
            ];
            RontgenT::insert($data);
        }
        DB::commit();
    }

}
