<?php

namespace App\Imports;

use App\Helpers\ConstantsHelper;
use App\Models\EmployeeM;
use App\Models\McuT;
use App\Models\PackageM;
use App\Models\ResumeMcuT;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class McuHeaderImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{

    public function __construct($companyId, $mcuProgramId)
    {
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
                throw new \Exception('Terjadi Kesalahan! NIK '.$row['nik']. ' dengan kode paket ' . $row['kode_paket'] . ' sudah terdaftar!');
            } else {
                if (empty($row['tgl_mcu'])) {
                    throw new \Exception('Terjadi Kesalahan! Tanggal MCU tidak boleh kosong!');
                }
                $date = date("Y-m-d", strtotime($row['tgl_mcu']));
                McuT::insert([
                    'mcu_date' => $date,
                    'employee_id' => $employeeModel->employee_id,
                    'company_id' => $this->companyId,
                    'mcu_program_id' => $this->mcuProgramId,
                    'is_import' => true,
                    'package_id' => $packageModel->id
                ]);
            }
        }
        DB::commit();
    }

}
