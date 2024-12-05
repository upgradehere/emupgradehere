<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsgT extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'usg_t';
    protected $primaryKey = 'usg_id';
    protected $fillable = [
        'usg_id',
        'mcu_id',
        'usg_code',
        'usg_date',
        'liver',
        'gallbladder',
        'pancreas',
        'lien',
        'kidney',
        'bladder',
        'prostat',
        'classification',
        'suggestion',
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
        'usg_date' => 'required'
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'usg_date.required' => 'Tanggal USG tidak boleh kosong.',
    ];

    public $attributes = [
        'usg_id' => 'usg_id',
        'mcu_id' => 'mcu_id',
        'usg_code' => 'usg_code',
        'usg_date' => 'usg_date',
        'liver' => 'liver',
        'gallbladder' => 'gallbladder',
        'pancreas' => 'pancreas',
        'lien' => 'lien',
        'kidney' => 'kidney',
        'bladder' => 'bladder',
        'prostat' => 'prostat',
        'classification' => 'classification',
        'suggestion' => 'suggestion',
        'doctor_id' => 'doctor_id',
        'is_abnormal' => 'is_abnormal',
        'image_file' => 'image_file',
        'additional_data' => 'additional_data',
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }
}
