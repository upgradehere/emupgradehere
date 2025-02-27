<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaboratoryDetailT extends BaseModel
{
    use HasFactory;
    protected $table = 'laboratory_detail_t';
    protected $primaryKey = 'laboratory_detail_id';
    protected $fillable = [
        'laboratory_detail_id',
        'laboratory_id',
        'laboratory_examination_id',
        'laboratory_reference_value',
        'result',
        'is_abnormal',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
