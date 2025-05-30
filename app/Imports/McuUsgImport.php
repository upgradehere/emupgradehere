<?php

namespace App\Imports;

use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\UsgT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuUsgImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
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

            $modelUsg = UsgT::select('usg_id')->where('mcu_id', $mcu_id)->first();
            if ($modelUsg != null) {
                UsgT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'usg_date' => date('Y-m-d H:i:s'),
                'liver' => !empty($row['hepar']) ? $row['hepar'] : null,
                'gallbladder' => !empty($row['kantong_empedu']) ? $row['kantong_empedu'] : null,
                'pancreas' => !empty($row['pankreas']) ? $row['pankreas'] : null,
                'lien' => !empty($row['lien']) ? $row['lien'] : null,
                'kidney' => !empty($row['ginjal']) ? $row['ginjal'] : null,
                'bladder' => !empty($row['buli_buli']) ? $row['buli_buli'] : null,
                'prostat' => !empty($row['prostat']) ? $row['prostat'] : null,
                'classification' => !empty($row['kesan']) ? $row['kesan'] : null,
                'suggestion' => !empty($row['kesimpulan']) ? $row['kesimpulan'] : null,
                'is_abnormal' => !empty($row['is_abnormal']) ? $row['is_abnormal'] : null,
                'is_import' => !empty($row['is_import']) && ($row['is_import']) == true ? true : false,
            ];
            UsgT::insert($data);
        }
        DB::commit();
    }

}
