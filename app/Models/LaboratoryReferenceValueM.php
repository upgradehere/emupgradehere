<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryReferenceValueM extends Model
{
    use HasFactory;
    protected $table = 'laboratory_reference_value_m';
    protected $primaryKey = 'laboratory_reference_value_id';
    protected $fillable = [
        'laboratory_reference_value_id',
        'laboratory_examination_id',
        'laboratory_reference_value_name',
        'min_male',
        'max_male',
        'min_female',
        'max_female',
        'unit',
        'reference_value',
        'information',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
