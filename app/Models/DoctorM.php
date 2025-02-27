<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorM extends BaseModel
{
    use HasFactory;

    protected $table = 'doctor_m';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'doctor_code',
        'doctor_name',
        'doctor_sign',
        'deleted_at',
        'created_at',
        'updated_at',
        'sex'
    ];

}
