<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EkgT extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ekg_t';
    protected $primaryKey = 'ekg_id';
    protected $fillable = [
        'ekg_id',
        'mcu_id',
        'ekg_code',
        'ekg_date',
        'rhythm',
        'rate',
        'axis',
        'abnormality',
        'conclusion',
        'suggestion',
        'doctor_id',
        'is_abnormal',
        'image_file',
        'additional_data',
        'is_import',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public $rules = [
        'mcu_id' => 'required',
        'ekg_date' => 'required'
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'ekg_date.required' => 'Tanggal EKG tidak boleh kosong.',
    ];

    public $attributes = [
        'ekg_id' => 'ekg_id',
        'mcu_id' => 'mcu_id',
        'ekg_code' => 'ekg_code',
        'ekg_date' => 'ekg_date',
        'rhythm' => 'rhythm',
        'rate' => 'rate',
        'axis' => 'axis',
        'abnormality' => 'abnormality',
        'conclusion' => 'conclusion',
        'suggestion' => 'suggestion',
        'doctor_id' => 'doctor_id',
        'is_abnormal' => 'is_abnormal',
        'image_file' =>'image_file',
        'additional_data' => 'additional_data',
        'is_import' => 'is_import'
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }
}
