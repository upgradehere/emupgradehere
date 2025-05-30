<?php

namespace App\Imports;

use App\Models\AudiometryT;
use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuAudiometryImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $map = self::mappingHertz();
        $right_air_conduction = [];
        $left_air_conduction = [];
        $right_bone_conduction = [];
        $left_bone_conduction = [];

        DB::beginTransaction();
        foreach ($collection as $row)
        {
            // right_air_conduction
            foreach ($map as $index => $r) {
                $right_air_conduction[$map[$index]] = isset($row["right_air_conduction_$r"]) ? $row["right_air_conduction_$r"] : 0;
            }

            // left_air_conduction
            foreach ($map as $index => $r) {
                $left_air_conduction[$map[$index]] = isset($row["left_air_conduction_$r"]) ? $row["left_air_conduction_$r"] : 0;
            }

            // right_bone_conduction
            foreach ($map as $index => $r) {
                $right_bone_conduction[$map[$index]] = isset($row["right_bone_conduction_$r"]) ? $row["right_bone_conduction_$r"] : 0;
            }

            // left_bone_conduction
            foreach ($map as $index => $r) {
                $left_bone_conduction[$map[$index]] = isset($row["left_bone_conduction_$r"]) ? $row["left_bone_conduction_$r"] : 0;
            }

            $modelMcu = McuT::select('mcu_id')
                ->where('mcu_code', $row['mcu_code'])
                ->first();

            if ($modelMcu == null) {
                throw new \Exception('Terjadi Kesalahan! Peserta dengan kode mcu '.$row['mcu_code'].' Tidak Ditemukan!');
            }
            $mcu_id = $modelMcu->mcu_id;

            $modelAudiometry = AudiometryT::select('audiometry_id')->where('mcu_id', $mcu_id)->first();
            if ($modelAudiometry != null) {
                AudiometryT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'audiometry_date' => date('Y-m-d H:i:s'),
                'right_air_conduction' => json_encode($right_air_conduction),
                'left_air_conduction' => json_encode($left_air_conduction),
                'right_bone_conduction' => json_encode($right_bone_conduction),
                'left_bone_conduction' => json_encode($left_bone_conduction),
                'right_ear' => !empty($row['telinga_kanan']) ? $row['telinga_kanan'] : null,
                'left_ear' => !empty($row['telinga_kiri']) ? $row['telinga_kiri'] : null,
                'conclusion' => !empty($row['kesimpulan']) ? $row['kesimpulan'] : null,
                'suggestion' => !empty($row['saran']) ? $row['saran'] : null,
                'is_abnormal' => !empty($row['is_abnormal']) ? $row['is_abnormal'] : null,
                'is_import' => !empty($row['is_import']) && ($row['is_import']) == true ? true : false,
            ];
            AudiometryT::insert($data);
        }
        DB::commit();
    }

    private function mappingHertz () {
        return [
            'hz_200',
            'hz_500',
            'hz_750',
            'hz_1000',
            'hz_1500',
            'hz_2000',
            'hz_3000',
            'hz_4000',
            'hz_6000',
            'hz_8000'
        ];
    }

}
