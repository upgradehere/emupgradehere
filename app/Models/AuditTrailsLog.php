<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrailsLog extends Model
{
    protected $table = 'audit_trails_log';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'event', 'model', 'url', 'ip_address', 'user_agent', 'device', 'platform', 'browser', 'old_values', 'new_values'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function getCreatedAtAttribute($value)
    {
        $date = new \DateTime($value, new \DateTimeZone('UTC')); // Assuming the timestamp is stored in UTC
        $date->setTimezone(new \DateTimeZone('Asia/Jakarta')); // Convert to Jakarta timezone
        return $date->format('Y-m-d H:i:s'); // Format the output
    }
}
