<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaboratoryT extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'laboratory_t';
    protected $primaryKey = 'laboratory_id';
    protected $fillable = [
        // 'laboratory_id',
        'mcu_id',
        'laboratory_date',
        'image_file',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public $rules = [
        'mcu_id' => 'required',
        'laboratory_date' => 'required',
    ];

    public $customMessages = [
        'mcu_id.required' => 'Mcu ID tidak boleh kosong..',
        'laboratory_date.required' => 'Tanggal Lab tidak boleh kosong.',
    ];

    public $attributes = [
        // 'laboratory_id' => 'Lab ID',
        'mcu_id' => 'MCU ID',
        'laboratory_date' => 'Lab Date'
    ];

    public function validate(){
        return GlobalHelper::validation($this->toArray(), $this->rules, $this->customMessages);
    }
}
