<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LookupC extends BaseModel
{
    use HasFactory;

    protected $table = 'lookup_c';
    protected $primaryKey = 'lookup_id';
    protected $fillable = [
        'lookup_id',
        'lookup_code',
        'lookup_name',
        'additional_data',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

}
