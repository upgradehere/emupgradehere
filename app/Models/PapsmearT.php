<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PapsmearT extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'papsmear_t';
    protected $primaryKey = 'papsmear_id';
    protected $fillable = [
        'papsmear_id',
        'mcu_id',
        'papsmear_code',
        'papsmear_date',
        'conclusion',
        'classification',
        'speciment',
        'clinical_description',
        'general_category',
        'recommendations',
        'doctor_id',
        'is_abnormal',
        'image_file',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public $rules = [
        'mcu_id' => 'required',
        'papsmear_date' => 'required'
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'papsmear_date.required' => 'Tanggal Papsmear tidak boleh kosong.',
    ];

    public $attributes = [
        'papsmear_id' => 'papsmear_id',
        'mcu_id' => 'mcu_id',
        'papsmear_code' => 'papsmear_code',
        'papsmear_date' => 'papsmear_date',
        'conclusion' => 'conclusion',
        'classification' => 'classification',
        'speciment' => 'speciment',
        'clinical_description' => 'clinical_description',
        'general_category' => 'general_category',
        'recommendations' => 'recommendations',
        'doctor_id' => 'doctor_id',
        'is_abnormal' => 'is_abnormal',
        'image_file' => 'image_file',
        'additional_data' => 'additional_data',
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }
}
