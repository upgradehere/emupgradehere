<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorM extends Model
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
