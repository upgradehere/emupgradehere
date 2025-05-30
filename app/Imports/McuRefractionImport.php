<?php

namespace App\Imports;

use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\RefractionT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuRefractionImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
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

            $modelRefraction = RefractionT::select('refraction_id')->where('mcu_id', $mcu_id)->first();
            if ($modelRefraction != null) {
                RefractionT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'refraction_date' => date('Y-m-d H:i:s'),
                'left_spherical' => !empty($row['spheris_kiri']) ? $row['spheris_kiri'] : null,
                'left_cylinder' => !empty($row['cylinder_kiri']) ? $row['cylinder_kiri'] : null,
                'left_axis' => !empty($row['axis_kiri']) ? $row['axis_kiri'] : null,
                'left_add' => !empty($row['add_kiri']) ? $row['add_kiri'] : null,
                'left_pd' => !empty($row['pd_kiri']) ? $row['pd_kiri'] : null,
                'uncorrected_vision_left_od' => !empty($row['visus_tanpa_koreksi_od_kiri']) ? $row['visus_tanpa_koreksi_od_kiri'] : null,
                'uncorrected_vision_left_os' => !empty($row['visus_tanpa_koreksi_os_kiri']) ? $row['visus_tanpa_koreksi_os_kiri'] : null,
                'right_spherical' => !empty($row['spheris_kanan']) ? $row['spheris_kanan'] : null,
                'right_cylinder' => !empty($row['cylinder_kanan']) ? $row['cylinder_kanan'] : null,
                'right_axis' => !empty($row['axis_kanan']) ? $row['axis_kanan'] : null,
                'right_add' => !empty($row['add_kanan']) ? $row['add_kanan'] : null,
                'right_pd' => !empty($row['pd_kanan']) ? $row['pd_kanan'] : null,
                'uncorrected_vision_right_od' => !empty($row['visus_tanpa_koreksi_od_kanan']) ? $row['visus_tanpa_koreksi_od_kanan'] : null,
                'uncorrected_vision_right_os' => !empty($row['visus_tanpa_koreksi_os_kanan']) ? $row['visus_tanpa_koreksi_os_kanan'] : null,
                'refraction_therapy_result' => !empty($row['terapi_hasil_refraksi']) ? $row['terapi_hasil_refraksi'] : null,
                'conclusion' => !empty($row['kesimpulan']) ? $row['kesimpulan'] : null,
                'notes' => !empty($row['catatan']) ? $row['catatan'] : null,
                'is_import' => !empty($row['is_import']) ? $row['is_import'] : true,
            ];
            RefractionT::insert($data);
        }
        DB::commit();
    }

}
