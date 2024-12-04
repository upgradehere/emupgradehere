<?php

namespace App\Imports;

use App\Models\EkgT;
use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuEkgImport implements ToCollection, WithHeadingRow
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
