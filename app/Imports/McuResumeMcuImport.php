<?php

namespace App\Imports;

use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\ResumeMcuT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuResumeMcuImport implements ToCollection, WithHeadingRow
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

            $modelResumeMcu = ResumeMcuT::select('resume_mcu_id')->where('mcu_id', $mcu_id)->first();
            if ($modelResumeMcu != null) {
                ResumeMcuT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'resume_mcu_date' => date('Y-m-d H:i:s'),
                'physical_impression' => !empty($row['kesan_fisik']) ? $row['kesan_fisik'] : null,
                'rontgen_impression' => !empty($row['kesan_rontgen']) ? $row['kesan_rontgen'] : null,
                'ekg_impression' => !empty($row['kesan_ekg']) ? $row['kesan_ekg'] : null,
                'audiometry_impression' => !empty($row['kesan_audiometri']) ? $row['kesan_audiometri'] : null,
                'usg_impression' => !empty($row['kesan_usg']) ? $row['kesan_usg'] : null,
                'spirometry_impression' => !empty($row['kesan_spirometri']) ? $row['kesan_spirometri'] : null,
                'refreaction_impression' => !empty($row['kesan_refraksi']) ? $row['kesan_refraksi'] : null,
                'laboratory_impression' => !empty($row['kesan_laboratorium']) ? $row['kesan_laboratorium'] : null,
                'result_conclusion' => !empty($row['kesimpulan_hasil']) ? $row['kesimpulan_hasil'] : null,
                'suggestion' => !empty($row['saran']) ? $row['saran'] : null,
            ];
            ResumeMcuT::insert($data);
        }
        DB::commit();
    }

}
