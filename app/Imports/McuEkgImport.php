<?php

namespace App\Imports;

use App\Models\EkgT;
use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuEkgImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
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

            $modelEkg = EkgT::select('ekg_id')->where('mcu_id', $mcu_id)->first();
            if ($modelEkg != null) {
                EkgT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'ekg_date' => date('Y-m-d H:i:s'),
                'rhythm' => !empty($row['irama']) ? $row['irama'] : null,
                'rate' => !empty($row['rate']) ? $row['rate'] : null,
                'axis' => !empty($row['axis']) ? $row['axis'] : null,
                'abnormality' => !empty($row['kelainan']) ? $row['kelainan'] : null,
                'conclusion' => !empty($row['kesimpulan']) ? $row['kesimpulan'] : null,
                'suggestion' => !empty($row['saran']) ? $row['saran'] : null,
                'is_abnormal' => !empty($row['is_abnormal']) ? $row['is_abnormal'] : null,
            ];
            EkgT::insert($data);
        }
        DB::commit();
    }

}
