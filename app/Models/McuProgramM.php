<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McuProgramM extends Model
{
    use HasFactory;
    protected $table = 'mcu_program_m';
    protected $primaryKey = 'mcu_program_id';
    protected $fillable = [
        'mcu_program_id',
        'mcu_program_code',
        'mcu_program_name',
        'company_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
