<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefractionT extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'refraction_t';
    protected $primaryKey = 'refraction_id';
    protected $fillable = [
        'refraction_id',
        'mcu_id',
        'refraction_code',
        'refraction_date',
        'left_spherical',
        'left_cylinder',
        'left_axis',
        'left_add',
        'left_pd',
        'uncorrected_vision_left_od',
        'uncorrected_vision_left_os',
        'right_spherical',
        'right_cylinder',
        'right_axis',
        'right_add',
        'right_pd',
        'uncorrected_vision_right_od',
        'uncorrected_vision_right_os',
        'image_file',
        'refraction_therapy_result',
        'conclusion',
        'notes',
        'doctor_id',
        'additional_data',
        'is_import',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public $rules = [
        'mcu_id' => 'required',
        'refraction_date' => 'required'
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'refraction_date.required' => 'Tanggal Refraksi tidak boleh kosong.',
    ];

    public $attributes = [
        'refraction_id' => 'Refraction ID',
        'mcu_id' => 'MCU ID',
        'refraction_code' => 'Refraction Code',
        'refraction_date' => 'Refraction Date',
        'left_spherical' => 'Spheris Kiri',
        'left_cylinder' => 'Cylinder Kiri',
        'left_axis' => 'Axis Kiri',
        'left_add' => 'ADD Kiri',
        'left_pd' => 'PD Kiri',
        'uncorrected_vision_left_od' => 'Visus Tanpa Koreksi, OD Kiri',
        'uncorrected_vision_left_os' => 'Visus Tanpa Koreksi, OS Kiri',
        'right_spherical' => 'Spheris Kanan',
        'right_cylinder' => 'Cylinder Kanan',
        'right_axis' => 'Axis Kanan',
        'right_add' => 'ADD Kanan',
        'right_pd' => 'PD Kanan',
        'uncorrected_vision_right_od' => 'Visus Tanpa Koreksi, OD Kanan',
        'uncorrected_vision_right_os' => 'Visus Tanpa Koreksi, OS Kanan',
        'image_file' => 'Image File',
        'refraction_therapy_result' => 'Terapi Hasil Refraksi',
        'conclusion' => 'Kesimpulan & Saran',
        'notes' => 'Catatan',
        'doctor_id' => 'Dokter ID',
        'additional_data' => 'Additional Data',
        'is_import' => 'is_import',
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }
}
