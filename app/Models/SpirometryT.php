<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpirometryT extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'spirometry_t';
    protected $primaryKey = 'spirometry_id';
    protected $fillable = [
        'spirometry_id',
        'mcu_id',
        'spirometry_code',
        'spirometry_date',
        'prediction_value',
        'kvp',
        'kvp_percentage',
        'vep',
        'vep_percetage',
        'ape',
        'ape_total',
        'classification',
        'conclusion',
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
        'spirometry_date' => 'required'
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'spirometry_date.required' => 'Tanggal Spirometri tidak boleh kosong.',
    ];

    public $attributes = [
        'spirometry_id' => 'Spirometri ID',
        'mcu_id' => 'MCU ID',
        'spirometry_code' => 'Spirometri Code',
        'spirometry_date' => 'Sprieometri Date',
        'prediction_value' => 'prediction_value',
        'kvp' => 'kvp',
        'kvp_percentage' => 'kvp_percentage',
        'vep' => 'vep',
        'vep_percetage' => 'vep_percetage',
        'ape' => 'ape',
        'ape_total' => 'ape_total',
        'classification' => 'classification',
        'is_abnormal' => 'is_abnormal',
        'conclusion' => 'Kesimpulan',
        'doctor_id' => 'Dokter ID',
        'is_abnormal' => 'is_abnormal',
        'image_file' => 'Image File',
        'additional_data' => 'Additional Data',
        'is_import' => 'is_import',
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }
}
