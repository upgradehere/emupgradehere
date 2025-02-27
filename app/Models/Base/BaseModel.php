<?php

namespace App\Models\Base;

use App\Models\AuditTrailsLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;

class BaseModel extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        self::auditTrail();
    }

    protected static function auditTrail()
    {
        static::created(function ($model) {
            $agent = new Agent();
            AuditTrailsLog::create([
                'user_id' => auth()->id(),
                'event' => 'created',
                'model' => get_class($model),
                'url' => Request::fullUrl(),
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'old_values' => null,
                'new_values' => json_encode($model->getAttributes()),
            ]);
        });

        static::updated(function ($model) {
            $agent = new Agent();
            AuditTrailsLog::create([
                'user_id' => auth()->id(),
                'event' => 'updated',
                'model' => get_class($model),
                'url' => Request::fullUrl(),
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'old_values' => json_encode($model->getOriginal()),
                'new_values' => json_encode($model->getChanges()),
            ]);
        });

        static::deleting(function ($model) {
            $agent = new Agent();
            if ($model->isForceDeleting()) { // Hard delete
                $event = 'hard_deleted';
            } else { // Soft delete
                $event = 'soft_deleted';
            }

            AuditTrailsLog::create([
                'user_id' => auth()->id(),
                'event' => $event,
                'model' => get_class($model),
                'url' => Request::fullUrl(),
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'old_values' => json_encode($model->getOriginal()),
                'new_values' => null,
            ]);
        });

        static::restored(function ($model) {
            $agent = new Agent();
            AuditTrailsLog::create([
                'user_id' => auth()->id(),
                'event' => 'restored',
                'model' => get_class($model),
                'url' => Request::fullUrl(),
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'old_values' => null,
                'new_values' => json_encode($model->getAttributes()),
            ]);
        });
    }

    public static function insert(array $values)
    {
        $agent = new Agent();
        $table = (new static)->getTable();

        AuditTrailsLog::create([
            'user_id' => auth()->id(),
            'event' => 'inserted',
            'model' => static::class,
            'url' => Request::fullUrl(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'device' => $agent->device(),
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'old_values' => null,
            'new_values' => json_encode($values),
        ]);

        return DB::table($table)->insert($values);
    }

}
