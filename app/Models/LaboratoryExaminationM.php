<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\LaboratoryExaminationTypeM;

class LaboratoryExaminationM extends BaseModel
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

    public function type()
    {
        return $this->hasOne(LaboratoryExaminationTypeM::class, 'laboratory_examination_type_id', 'laboratory_examination_type_id');
    }
}
