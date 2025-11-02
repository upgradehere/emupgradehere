<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiKey
{
    /**
     * Checks for X-API-Key (case-insensitive), validates against api_keys table.
     * - 401 if header missing
     * - 403 if key invalid/inactive
     * On success, attaches api_key_id to request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Header is case-insensitive; Laravel normalizes, but we check robustly.
        $header = $request->header('X-API-Key');
        if (!$header) {
            // Also try lower-case just in case a client sent it oddly
            $header = $request->headers->get('x-api-key');
        }

        if (!$header) {
            return response()->json(['message' => 'X-API-Key header is required'], 401);
        }

        // Look up in DB
        $row = DB::table('api_keys')
            ->where('api_key', $header)
            ->where('active', true)
            ->first();

        if (!$row) {
            return response()->json(['message' => 'Invalid or inactive API key'], 403);
        }

        // Attach api_key_id for downstream logging
        $request->attributes->set('api_key_id', $row->id);

        return $next($request);
    }
}