<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaboratoryExaminationTypeM extends BaseModel
{
    use HasFactory;
    protected $table = 'laboratory_examination_type_m';
    protected $primaryKey = 'laboratory_examination_type_id';
    protected $fillable = [
        'laboratory_examination_type_id',
        'laboratory_examination_group_id',
        'laboratory_examination_type_code',
        'laboratory_examination_type_name',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function examinations()
    {
        return $this->hasMany(LaboratoryExaminationM::class, 'laboratory_examination_type_id', 'laboratory_examination_type_id');
    }
}
