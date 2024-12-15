<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TreadmillT extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'treadmill_t';
    protected $primaryKey = 'treadmill_id';
    protected $fillable = [
        'treadmill_id',
        'mcu_id',
        'treadmill_code',
        'treadmill_date',
        'resting_ekg',
        'max_heart_rate_target',
        'reached',
        'end_test_minute',
        'heart_rate_response',
        'blood_preassure_response',
        'aritmia',
        'chest_pain',
        'other_symptoms',
        'during_after_training_test',
        'mm_lead',
        'at_the_minute',
        'st_normalization_after',
        'functional_class',
        'freshness_level',
        'aerobic_capacity',
        'conc_normalization_after',
        'doctor_id',
        'is_abnormal',
        'image_file',
        'notes',
        'additional_data',
        'is_import',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public $rules = [
        'mcu_id' => 'required',
        'treadmill_date' => 'required'
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'treadmill_date.required' => 'Tanggal Treadmill tidak boleh kosong.',
    ];

    public $attributes = [
        'treadmill_id' => 'treadmill_id',
        'mcu_id' => 'mcu_id',
        'treadmill_code' => 'treadmill_code',
        'treadmill_date' => 'treadmill_date',
        'resting_ekg' => 'resting_ekg',
        'max_heart_rate_target' => 'max_heart_rate_target',
        'reached' => 'reached',
        'end_test_minute' => 'end_test_minute',
        'heart_rate_response' => 'heart_rate_response',
        'blood_preassure_response' => 'blood_preassure_response',
        'aritmia' => 'aritmia',
        'chest_pain' => 'chest_pain',
        'other_symptoms' => 'other_symptoms',
        'during_after_training_test' => 'during_after_training_test',
        'mm_lead' => 'mm_lead',
        'at_the_minute' => 'at_the_minute',
        'st_normalization_after' => 'st_normalization_after',
        'functional_class' => 'functional_class',
        'freshness_level' => 'freshness_level',
        'aerobic_capacity' =>'aerobic_capacity',
        'conc_normalization_after' => 'conc_normalization_after',
        'doctor_id' => 'doctor_id',
        'is_abnormal' => 'is_abnormal',
        'image_file' => 'image_file',
        'notes' => 'notes',
        'additional_data' => 'additional_data',
        'is_import' => 'is_import'
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }
}
