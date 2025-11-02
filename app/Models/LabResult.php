<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LabResult extends BaseModel
{
    protected $fillable = ['sample_id','mcu_code','raw_data','payload_hash'];
    protected $casts = ['raw_data' => 'array'];

    public function items(): HasMany
    {
        return $this->hasMany(LabResultItem::class);
    }
}
