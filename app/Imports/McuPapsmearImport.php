<?php

namespace App\Imports;

use App\Models\DoctorM;
use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\PapsmearT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuPapsmearImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
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
                $modelDoctor = DoctorM::select('id')
                ->where('doctor_code', $row['doctor_code'])
                ->first();
                $doctor_id = $modelDoctor->id;
            }

            $modelPapsmear = PapsmearT::select('papsmear_id')->where('mcu_id', $mcu_id)->first();
            if ($modelPapsmear != null) {
                PapsmearT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'papsmear_date' => date('Y-m-d H:i:s'),
                'conclusion' => !empty($row['kesimpulan']) ? $row['kesimpulan'] : null,
                'classification' => !empty($row['kesan']) ? $row['kesan'] : null,
                'speciment' => !empty($row['spesimen']) ? $row['spesimen'] : null,
                'clinical_description' => !empty($row['keterangan_klinis']) ? $row['keterangan_klinis'] : null,
                'general_category' => !empty($row['kategori_umum']) ? $row['kategori_umum'] : null,
                'recommendations' => !empty($row['anjuran']) ? $row['anjuran'] : null,
                'is_abnormal' => !empty($row['is_abnormal']) ? $row['is_abnormal'] : null,
                'doctor_id' => !empty($row['doctor_code']) ? $doctor_id : null,
            ];
            PapsmearT::insert($data);
        }
        DB::commit();
    }

}
