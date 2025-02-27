<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Models\AuditTrailsLog;
use Illuminate\Http\Request;
use App\Models\DoctorM;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;
use Session;

class AuditTrailsController extends Controller
{

    public function index()
    {
        return view('audit-trails/index');
    }

    public function getData(Request $request)
    {
        try {
            $model = new AuditTrailsLog();
            $query = $model->select(
                'users.id as user_id',
                'users.name',
                'event',
                'url',
                'ip_address',
                'device',
                'platform',
                'browser',
                'old_values',
                'new_values',
                'audit_trails_log.created_at'
            )
            ->leftJoin('users', 'users.id', '=', 'audit_trails_log.user_id')
            ->orderBy('audit_trails_log.created_at', 'desc');
            return response()->json(GlobalHelper::dataTable($request, $query));
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

}
