<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RontgenT extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'rontgen_t';
    protected $primaryKey = 'rontgen_id';
    protected $fillable = [
        'rontgen_id',
        'mcu_id',
        'rontgen_code',
        'rontgen_date',
        'rontgen_examination_type',
        'clinical_diagnosis',
        'cor',
        'pulmo',
        'oss_costae',
        'diaphragmatic_sinus',
        'conclusion',
        'examination_status',
        'doctor_id',
        'notes',
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
        'rontgen_date' => 'required'
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'rontgen_date.required' => 'Tanggal Rontgen tidak boleh kosong.',
    ];

    public $attributes = [
        'rontgen_id' => 'Rontgen ID',
        'mcu_id' => 'MCU ID',
        'rontgen_code' => 'Rontgen Code',
        'rontgen_date' => 'Rontgen Date',
        'rontgen_examination_type' => 'rontgen_examination_type',
        'clinical_diagnosis' => 'clinical_diagnosis',
        'cor' => 'cor',
        'pulmo' => 'pulmo',
        'oss_costae' => 'oss_costae',
        'diaphragmatic_sinus' => 'diaphragmatic_sinus',
        'examination_status' => 'examination_status',
        'is_abnormal' => 'is_abnormal',
        'conclusion' => 'Kesimpulan & Saran',
        'notes' => 'Catatan',
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
