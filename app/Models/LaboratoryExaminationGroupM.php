<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryExaminationGroupM extends Model
{
    use HasFactory;
    protected $table = 'laboratory_examination_group_m';
    protected $primaryKey = 'laboratory_examination_group_id';
    protected $fillable = [
        'laboratory_examination_group_id',
        'laboratory_examination_group_code',
        'laboratory_examination_group_name',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function examinationTypes()
    {
        return $this->hasMany(LaboratoryExaminationTypeM::class, 'laboratory_examination_group_id', 'laboratory_examination_group_id');
    }
}
