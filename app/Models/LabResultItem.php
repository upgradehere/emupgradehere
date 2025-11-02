<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LabResultItem extends BaseModel
{
    protected $fillable = [
        'lab_result_id','analyte_id','source_name','value','unit','flag','ref_range','measured_at',
    ];

    protected $casts = [
        'measured_at' => 'datetime',
    ];

    public function result(): BelongsTo
    {
        return $this->belongsTo(LabResult::class, 'lab_result_id');
    }

    public function analyte(): BelongsTo
    {
        return $this->belongsTo(LabAnalyte::class, 'analyte_id');
    }
}
