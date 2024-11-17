<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McuT extends Model
{
    use HasFactory;
    protected $table = 'mcu_t';
    protected $primaryKey = 'mcu_id';
    protected $fillable = [
        'mcu_id',
        'mcu_code',
        'mcu_date',
        'employee_id',
        'company_id',
        'mcu_program_id',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
