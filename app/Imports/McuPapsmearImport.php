<?php

namespace App\Imports;

use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\PapsmearT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuPapsmearImport implements ToCollection, WithHeadingRow
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

            $modelPapsmear = PapsmearT::select('papsmear_id')->where('mcu_id', $mcu_id)->first();
            if ($modelPapsmear != null) {
                PapsmearT::where('mcu_id', $mcu_id)->delete();
            }
            $data = [
                'mcu_id' => $mcu_id,
                'papsmear_date' => date('Y-m-d H:i:s'),
                'conclusion' => !empty($row['kesimpulan']) ? $row['kesimpulan'] : null,
                'classification' => !empty($row['kesan']) ? $row['kesan'] : null,
                'speciment' => !empty($row['spesimen']) ? $row['spesimen'] : null,
                'clinical_description' => !empty($row['keterangan_klinis']) ? $row['keterangan_klinis'] : null,
                'general_category' => !empty($row['kategori_umum']) ? $row['kategori_umum'] : null,
                'recommendations' => !empty($row['anjuran']) ? $row['anjuran'] : null,
                'is_abnormal' => !empty($row['is_abnormal']) ? $row['is_abnormal'] : null
            ];
            PapsmearT::insert($data);
        }
        DB::commit();
    }

}
