<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeM extends Model
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
        'sex'
    ];

}
