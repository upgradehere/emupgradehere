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
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuLaboratoryImport implements ToCollection, WithHeadingRow
{

    public function __construct($mcuDate, $companyId, $mcuProgramId)
    {
        $this->mcuDate = $mcuDate;
        $this->companyId = $companyId;
        $this->mcuProgramId = $mcuProgramId;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        foreach ($collection as $row)
        {
            $employeeModel = EmployeeM::select('employee_id')->where('nik', $row['nik'])->first();
            $packageModel = PackageM::select('id')->where('package_code', $row['kode_paket'])->first();

            if ($employeeModel == null) {
                throw new \Exception('Terjadi Kesalahan! Peserta dengan nik '.$row['nik'].' Tidak Ditemukan!');
            }
            if ($packageModel == null) {
                throw new \Exception('Terjadi Kesalahan! Kode paket '.$row['kode_paket'].' Tidak Ditemukan!');
            }
            $modelMcu = McuT::select('mcu_id')
                ->where('employee_id', $employeeModel->employee_id)
                ->where('company_id', $this->companyId)
                ->where('mcu_program_id', $this->mcuProgramId)
                ->where('is_import', true)
                ->where('package_id', $packageModel->id)
                ->first();

            if ($modelMcu != null) {
                $mcu_id = $modelMcu->mcu_id;
            } else {
                McuT::insert([
                    'mcu_date' => $this->mcuDate,
                    'employee_id' => $employeeModel->employee_id,
                    'company_id' => $this->companyId,
                    'mcu_program_id' => $this->mcuProgramId,
                    'is_import' => true,
                    'package_id' => $packageModel->id
                ]);
                $modelMcu = McuT::select('mcu_id')
                    ->where('employee_id', $employeeModel->employee_id)
                    ->where('company_id', $this->companyId)
                    ->where('mcu_program_id', $this->mcuProgramId)
                    ->where('package_id', $packageModel->id)
                    ->where('is_import', true)->first();
                $mcu_id = $modelMcu->mcu_id;
            }

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
