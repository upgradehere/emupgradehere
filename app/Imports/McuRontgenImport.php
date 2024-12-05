<?php

namespace App\Imports;

use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\RontgenT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuRontgenImport implements ToCollection, WithHeadingRow
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
            ];
            RontgenT::insert($data);
        }
        DB::commit();
    }

}
