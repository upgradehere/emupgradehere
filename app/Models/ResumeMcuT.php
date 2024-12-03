<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResumeMcuT extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'resume_mcu_t';
    protected $primaryKey = 'resume_mcu_id';
    protected $fillable = [
        'resume_mcu_id',
        'mcu_id',
        'resume_mcu_code',
        'resume_mcu_date',
        'physical_impression',
        'rontgen_impression',
        'ekg_impression',
        'audiometry_impression',
        'usg_impression',
        'refreaction_impression',
        'laboratory_impression',
        'result_conclusion',
        'suggestion',
        'doctor_id',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public $rules = [
        'mcu_id' => 'required',
        'resume_mcu_date' => 'required'
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'resume_mcu_date.required' => 'Tanggal Resume MCU tidak boleh kosong.',
    ];

    public $attributes = [
        'resume_mcu_id' => 'resume_mcu_id',
        'mcu_id' => 'mcu_id',
        'resume_mcu_code' => 'resume_mcu_code',
        'resume_mcu_date' => 'resume_mcu_date',
        'physical_impression' => 'physical_impression',
        'rontgen_impression' => 'rontgen_impression',
        'ekg_impression' => 'ekg_impression',
        'audiometry_impression' => 'audiometry_impression',
        'usg_impression' => 'usg_impression',
        'refreaction_impression' => 'refreaction_impression',
        'laboratory_impression' => 'laboratory_impression',
        'result_conclusion' => 'result_conclusion',
        'suggestion' => 'suggestion',
        'doctor_id' => 'doctor_id',
        'additional_data' => 'additional_data',
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }
}
