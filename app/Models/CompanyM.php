<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyM extends Model
{
    use HasFactory;
    protected $table = 'company_m';
    protected $primaryKey = 'company_id';
    protected $fillable = [
        'company_id',
        'company_code',
        'company_name',
        'npwp_company_number',
        'pic_name',
        'pic_email',
        'pic_phone_number',
        'company_address',
        'subdistrict_id',
        'district_id',
        'city_id',
        'province_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
