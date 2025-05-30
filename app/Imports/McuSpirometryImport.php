<?php

namespace App\Imports;

use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\SpirometryT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuSpirometryImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
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

            $modelSpirometry = SpirometryT::select('spirometry_id')->where('mcu_id', $mcu_id)->first();
            if ($modelSpirometry != null) {
                SpirometryT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'spirometry_date' => date('Y-m-d H:i:s'),
                'prediction_value' => !empty($row['nilai_prediksi']) ? $row['nilai_prediksi'] : null,
                'kvp' => !empty($row['kvp']) ? $row['kvp'] : null,
                'kvp_percentage' => !empty($row['kvp_percentage']) ? $row['kvp_percentage'] : null,
                'vep' => !empty($row['vep']) ? $row['vep'] : null,
                'vep_percetage' => !empty($row['vep_percentage']) ? $row['vep_percentage'] : null,
                'ape' => !empty($row['ape']) ? $row['ape'] : null,
                'ape_total' => !empty($row['ape_total']) ? $row['ape_total'] : null,
                'classification' => !empty($row['kesan']) ? $row['kesan'] : null,
                'conclusion' => !empty($row['kesimpulan']) ? $row['kesimpulan'] : null,
                'is_abnormal' => !empty($row['is_abnormal']) ? $row['is_abnormal'] : null,
                'is_import' => !empty($row['is_import']) && ($row['is_import']) == true ? true : false,
            ];
            SpirometryT::insert($data);
        }
        DB::commit();
    }

}
