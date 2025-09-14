<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class LabResultsInboxController extends Controller
{
    /**
     * POST /api/lab-results/inbox
     *
     * Requirements:
     * - Auth via X-API-Key (handled by verify.apikey middleware)
     * - Throttle via named limiter "labresults"
     * - Validate: source  {TC3060, TEK8520}; obx non-empty; each item has test_name + value
     * - Normalize: uppercase source; patient_id used as mcu_code
     * - Insert only into lab_results_inbox_t; store payload verbatim; trigger fills status/items_count/run_at
     * - Response: { ok:true, inbox_id, mcu_id|null, status }
     */
    public function store(Request $request)
    {
        // Validate basic shape
        $validated = $request->validate([
            'source'       => ['required', 'string'],
            'patient_id'   => ['nullable', 'string'],
            'generated_at' => ['nullable', 'string'],
            'excel_file'   => ['nullable', 'string'],
            'bridge_version' => ['nullable', 'string'],
            'obx'          => ['required', 'array', 'min:1'],
            'obx.*.test_name' => ['required', 'string'],
            'obx.*.value'     => ['required'], // allow string/number
        ]);

        // Normalize/guard source AFTER validation
        $source = strtoupper($validated['source']);
        if (!in_array($source, ['TC3060', 'TEK8520'], true)) {
            return response()->json([
                'message' => 'The source must be either TC3060 or TEK8520.'
            ], 422);
        }

        // Use patient_id as mcu_code if present
        $mcuCode = $validated['patient_id'] ?? null;

        // Store the payload VERBATIM as sent (do not mutate)
        $payload = $request->all();

        // Insert into inbox table; let DB trigger resolve fields
        // Note: primary key column is assumed to be "inbox_id".
        $now = now();
        $inboxId = DB::table('lab_results_inbox_t')
            ->insertGetId([
                'source'     => $source,
                'mcu_code'   => $mcuCode,
                'payload'    => json_encode($payload), // jsonb will accept JSON text
                'created_at' => $now,
                'updated_at' => $now,
            ], 'inbox_id');

        // Read back resolved fields (trigger ran BEFORE INSERT)
        $row = DB::table('lab_results_inbox_t')
            ->select('inbox_id', 'mcu_id', 'status')
            ->where('inbox_id', $inboxId)
            ->first();

        // Log success (nice-to-have)
        Log::info('lab_inbox.accepted', [
            'api_key_id' => $request->attributes->get('api_key_id'),
            'inbox_id'   => $inboxId,
            'mcu_id'     => $row->mcu_id ?? null,
            'status'     => $row->status ?? null,
        ]);

        return response()->json([
            'ok'       => true,
            'inbox_id' => $inboxId,
            'mcu_id'   => $row->mcu_id ?? null,
            'status'   => $row->status ?? null,
        ], 200);
    }
}