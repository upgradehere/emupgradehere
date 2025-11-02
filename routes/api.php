<?php

use App\Http\Controllers\Mcu\ProgramMcuController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LabResultsInboxController;
use App\Http\Controllers\LabResultsPromotionController;
use Illuminate\Support\Facades\Log;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'mcu'], function () {
    Route::group(['prefix' => 'program-mcu'], function () {
        Route::get('get-data-mcu-program-company',  [ProgramMcuController::class, 'getDataMcuProgramCompany']);
        Route::get('get-data-mcu-employee',  [ProgramMcuController::class, 'getDataMcuEmployee']);
    });
});

Route::group(['prefix' => 'package'], function () {
    Route::get('get-data-package',  [PackageController::class, 'getDataPackage']);
});

Route::group(['prefix' => 'company'], function () {
    Route::get('get-data-company',  [CompanyController::class, 'getDataCompany']);
});

Route::post('/lab-results/inbox', [LabResultsInboxController::class, 'store'])
    ->middleware(['verify.apikey','throttle:labresults']);

Route::post('/_echo', function (Request $r) {
    Log::info('ECHO-HIT', [
        'headers'  => $r->headers->all(),
        'body_raw' => $r->getContent(),
        'json'     => $r->collect()->all(),
    ]);
    return response()->json(['ok' => true]);
});

Route::post('/lab-results/promote/{inbox}', [LabResultsPromotionController::class, 'promote'])
    ->name('lab-results.promote');
