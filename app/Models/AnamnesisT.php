<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnamnesisT extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'anamnesis_t';
    protected $primaryKey = 'anamnesis_id';
    protected $fillable = [
        'anamnesis_id',
        'anamnesis_code',
        'anamnesis_date',
        'mcu_id',
        'systolic',
        'diastolic',
        'pulse_rate',
        'breathing',
        'height',
        'weight',
        'weight_recommended',
        'bmi',
        'body_temprature',
        'bmi_classification',
        'skin_condition',
        'medical_history',
        'eyes',
        'ears',
        'nose',
        'oral_cavity',
        'teeth',
        'neck',
        'thorax',
        'abdomen',
        'spine',
        'upper_extremities',
        'lower_extremities',
        'additional_data',
        'notes',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public $rules = [
        'mcu_id' => 'required',
        'anamnesis_code' => 'required',
        'anamnesis_date' => 'required',
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'anamnesis_code.required' => 'Kode Anamnesis tidak boleh kosong.',
        'anamnesis_date.required' => 'Tanggal Anamnesis tidak boleh kosong.',
    ];

    public $attributes = [
        'anamnesis_id' => 'Anamnesis ID',
        'anamnesis_code' => 'Anamnesis Code',
        'anamnesis_date' => 'Anamnesis Date',
        'mcu_id' => 'MCU ID',
        'systolic' => 'Systolic',
        'diastolic' => 'Diastolic',
        'pulse_rate' => 'Pulse Rate',
        'breathing' => 'Breathing',
        'height' => 'Height',
        'weight' => 'Weight',
        'weight_recommended' => 'Weight Recommended',
        'bmi' => 'BMI',
        'body_temprature' => 'Body Temprature',
        'bmi_classification' => 'Bmi Classification',
        'skin_condition' => 'Skin Condition',
        'medical_history' => 'Medical History',
        'eyes' => 'Eyes',
        'ears' => 'Ears',
        'nose' => 'Nose',
        'oral_cavity' => 'Oral Cavity',
        'teeth' => 'Teeth',
        'neck' => 'Neck',
        'thorax' => 'Thorax',
        'abdomen' => 'Abdomen',
        'spine' => 'Spine',
        'upper_extremities' => 'Upper Extremities',
        'lower_extremities' => 'Lower Extremities',
        'additional_data' => 'Additional Data',
        'notes' => 'Notes'
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }

}
