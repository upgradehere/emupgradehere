<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class EmployeeM extends BaseModel
{
    use HasFactory;

    protected $table = 'employee_m';
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'employee_id',
        'employee_code',
        'employee_name',
        'nik',
        'company_id',
        'departement_id',
        'dob',
        'phone_number',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
        'sex',
        'email'
    ];

    public function company()
    {
        return $this->hasOne(CompanyM::class, 'company_id', 'company_id');
    }

    public function getUmur()
    {
        if ($this->dob) {
            $dob = Carbon::parse($this->dob);
            $now = Carbon::now();

            $diff = $dob->diff($now);

            return $diff->y . ' TAHUN ' . $diff->m . ' BULAN';
        }

        return null;
    }
}
