<?php

namespace App\Models;
use App\Models\Base\BaseModel;

class LabAnalyte extends BaseModel
{
    protected $fillable = [
        'code','display_name','default_unit','ref_lo','ref_hi','synonyms','instrument_synonyms'
    ];

    protected $casts = [
        'ref_lo' => 'decimal:4',
        'ref_hi' => 'decimal:4',
        'synonyms' => 'array',
        'instrument_synonyms' => 'array',
    ];
}
