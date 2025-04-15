<?php

namespace App\Imports;

use App\Models\EmployeeM;
use App\Models\LaboratoryDetailT;
use App\Models\LaboratoryExaminationM;
use App\Models\LaboratoryT;
use App\Models\McuT;
use App\Models\PackageM;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuLaboratoryImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
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

            $modelLab = LaboratoryT::select('laboratory_id')->where('mcu_id', $mcu_id)->first();
            if ($modelLab != null) {
                LaboratoryT::where('mcu_id', $mcu_id)->delete();
                LaboratoryDetailT::where('laboratory_id', $modelLab->laboratory_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'laboratory_date' => date('Y-m-d H:i:s')
            ];
            $laboratory = LaboratoryT::create($data);
            $new_laboratory_id = $laboratory->laboratory_id;
            unset($row['no']);
            unset($row['nik']);
            unset($row['nama_pegawai']);
            unset($row['kode_paket']);
            unset($row['mcu_code']);

            $detail = [];

            foreach ($row as $key => $value) {
                $newKey = str_replace('_', '-', strtoupper($key));
                $newValue = $value;

                if (strpos($key, '_') !== false) {
                    unset($detail[strtoupper($key)]);
                }

                $modelLabExam = LaboratoryExaminationM::select('laboratory_examination_id')->where('laboratory_examination_code', $newKey)->first();
                if (empty($modelLabExam)) {
                    throw new \Exception('Terjadi Kesalahan! Pemeriksaan dengan kode '.$newKey.' Tidak Ditemukan!');
                }

                if (strpos($value, '*') !== false) {
                    $newValue = str_replace('*', '', $value);
                    $detail[] = [
                        'laboratory_id' => $new_laboratory_id,
                        'laboratory_examination_id' => $modelLabExam->laboratory_examination_id,
                        'result' => $newValue,
                        'is_abnormal' => true
                    ];
                } else {
                    $detail[] = [
                        'laboratory_id' => $new_laboratory_id,
                        'laboratory_examination_id' => $modelLabExam->laboratory_examination_id,
                        'result' => $newValue,
                        'is_abnormal' => false
                    ];
                }
            }
            LaboratoryDetailT::insert($detail);
        }
        DB::commit();
    }

}
