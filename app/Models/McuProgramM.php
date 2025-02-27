<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class McuProgramM extends BaseModel
{
    use HasFactory;
    protected $table = 'mcu_program_m';
    protected $primaryKey = 'mcu_program_id';
    protected $fillable = [
        'mcu_program_id',
        'mcu_program_code',
        'mcu_program_name',
        'company_id',
        'conclusions',
        'suggestions',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
