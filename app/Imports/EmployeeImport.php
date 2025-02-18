<?php

namespace App\Imports;

use Exception;
use App\Models\EmployeeM;
use App\Models\DepartementM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmployeeImport implements ToModel, WithHeadingRow
{
    protected $companyId;

    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    public function model(array $row)
    {
        DB::beginTransaction();

        try {
            // Validation NIK
            $nik = $row['nik'];
            $emp = EmployeeM::where('nik', $nik)
                            ->first();
            if ($emp) {
                throw new Exception("NIK ".$nik." sudah terdaftar.");
            }

            // Validation Departement
            $departmentCode = $row['kode_departemen'];
            $department = DepartementM::where('departement_code', $departmentCode)
                                        ->where('company_id', $this->companyId)
                                        ->first();
            if (!$department) {
                throw new Exception("Kode Departemen ".$departmentCode." tidak ditemukan untuk perusahaan yang dipilih.");
            }

            // Validation Email
            $validator = Validator::make(['email' => $row['email']], [
                'email' => 'required|email',
            ]);
            
            if ($validator->fails()) {
                throw new Exception("Email '".$row['email']."' tidak valid.");
            }

            // Validation DOB
            $validator = Validator::make(['date' => $row['tanggal_lahir']], [
                'date' => 'required|date_format:Y-m-d',
            ]);

            if ($validator->fails()) {
                throw new Exception("Tanggal Lahir harus dengan format yyyy-mm-dd");
            }
            
            // Validation Sex
            if (!in_array($row['jenis_kelamin'], ['Pria', 'Wanita'])) {
                throw new Exception("Jenis kelamin harus diisi 'Pria' / 'Wanita'");
            }


            EmployeeM::create([
                'employee_code' => $row['kode_pegawai'],
                'employee_name' => $row['nama_pegawai'],
                'nik' => $row['nik'],
                'company_id' => $this->companyId,
                'departement_id' => $department->departement_id,
                'dob' => $row['tanggal_lahir'],
                'phone_number' => $row['no_telp'],
                'additional_data' => "-",
                'sex' => ($row['jenis_kelamin'] == 'Pria') ? 11 : 12,
                'email' => $row['email'],
                'photo' => null,
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return null;
    }
}
