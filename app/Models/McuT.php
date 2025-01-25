<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeM;
use App\Models\McuProgramM;
use App\Models\CompanyM;
use Illuminate\Database\Eloquent\SoftDeletes;

class McuT extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'mcu_t';
    protected $primaryKey = 'mcu_id';
    protected $fillable = [
        'mcu_id',
        'mcu_code',
        'mcu_date',
        'employee_id',
        'company_id',
        'mcu_program_id',
        'package_id',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public $rules = [
        'mcu_date' => 'required',
        'employee_id' => 'required',
        'package_id' => 'required'
    ];

    public $customMessages = [
        'mcu_date.required' => 'Tanggal MCU tidak boleh kosong.',
        'employee_id.required' => 'Peserta tidak boleh kosong.',
        'package_id.required' => 'Paket tidak boleh kosong.',
    ];

    public $attributes = [
        'mcu_id' => 'mcu_id',
        'mcu_code' => 'mcu_code',
        'mcu_date' => 'mcu_date',
        'employee_id' => 'employee_id',
        'company_id' => 'company_id',
        'mcu_program_id' => 'mcu_program_id',
        'package_id' => 'package_id',
        'additional_data' => 'additional_data',
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }

    public function employee()
    {
        return $this->hasOne(EmployeeM::class, 'employee_id', 'employee_id');
    }

    public function program()
    {
        return $this->hasOne(McuProgramM::class, 'mcu_program_id', 'mcu_program_id');
    }

    public function company()
    {
        return $this->hasOne(CompanyM::class, 'company_id', 'company_id');
    }
}
