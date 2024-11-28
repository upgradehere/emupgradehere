<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryExaminationM extends Model
{
    use HasFactory;
    protected $table = 'laboratory_examination_m';
    protected $primaryKey = 'laboratory_examination_id';
    protected $fillable = [
        'laboratory_examination_id',
        'laboratory_examination_type_id',
        'laboratory_examination_code',
        'laboratory_examination_name',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
