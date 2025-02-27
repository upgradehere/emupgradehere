<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AudiometryT extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'audiometry_t';
    protected $primaryKey = 'audiometry_id';
    protected $fillable = [
        'audiometry_id',
        'mcu_id',
        'audiometry_code',
        'audiometry_date',
        'right_air_conduction',
        'left_air_conduction',
        'right_bone_conduction',
        'left_bone_conduction',
        'right_ear',
        'left_ear',
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
        'audiometry_date' => 'required'
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'audiometry_date.required' => 'Tanggal Audiometri tidak boleh kosong.',
    ];

    public $attributes = [
        'audiometry_id' => 'audiometry_id',
        'mcu_id' => 'mcu_id',
        'audiometry_code' => 'audiometry_code',
        'audiometry_date' => 'audiometry_date',
        'right_air_conduction' => 'right_air_conduction',
        'left_air_conduction' => 'left_air_conduction',
        'right_bone_conduction' => 'right_bone_conduction',
        'left_bone_conduction' => 'left_bone_conduction',
        'right_ear' => 'right_ear',
        'left_ear' => 'left_ear',
        'conclusion' => 'conclusion',
        'suggestion' => 'suggestion',
        'doctor_id' => 'doctor_id',
        'is_abnormal' => 'is_abnormal',
        'image_file' => 'image_file',
        'additional_data' => 'additional_data',
        'is_import' => 'is_import'
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }
}
