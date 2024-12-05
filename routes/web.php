<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Mcu\PemeriksaanMcuController;
use App\Http\Controllers\Mcu\ProgramMcuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Authenticaton
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login-check', [AuthController::class, 'check'])->name('login.check');
Route::post('/login-otp', [AuthController::class, 'otp'])->name('login.otp');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'role:1,2']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/get-gender/{id_program}', [DashboardController::class, 'getGender'])->name('get-gender');
    Route::get('/dashboard/get-age/{id_program}', [DashboardController::class, 'getAge'])->name('get-age');
    Route::get('/dashboard/get-participant/{id_program}', [DashboardController::class, 'getParticipant'])->name('get-participant');
    Route::get('/dashboard/get-health-category/{id_program}', [DashboardController::class, 'getHealthCategory'])->name('get-health-category');
    Route::get('/dashboard/get-metabolic-syndrome/{id_program}', [DashboardController::class, 'getMetabolicSyndrome'])->name('get-metabolic-syndrome');
    Route::get('/dashboard/get-disease-history/{id_program}', [DashboardController::class, 'getDiseaseHistory'])->name('get-disease-history');
    Route::get('/dashboard/get-lab-diagnosis/{id_program}', [DashboardController::class, 'getLabDiagnosis'])->name('get-lab-diagnosis');
    Route::get('/dashboard/get-non-lab-diagnosis/{id_program}', [DashboardController::class, 'getNonLabDiagnosis'])->name('get-non-lab-diagnosis');
    Route::get('/dashboard/get-symptom/{id_program}', [DashboardController::class, 'getSymptoms'])->name('get-symptoms');
    Route::get('/dashboard/get-conclusion-recommendation/{id_program}', [DashboardController::class, 'getConclusionAndRecommendation'])->name('get-conclusion-recommendation');
    
    Route::get('/mcu/program-mcu', [ProgramMcuController::class, 'index'])->name('program-mcu');
    Route::get('/mcu/program-mcu/detail', [ProgramMcuController::class, 'detailProgramMcu'])->name('detail-program-mcu');
    Route::get('/mcu/program-mcu/detail/input-manual-mcu', [ProgramMcuController::class, 'insertManualMcu'])->name('input-manual-mcu');
    Route::post('/mcu/program-mcu/detail/input-manual-mcu/save-input-manual-mcu', [ProgramMcuController::class, 'actionInsertManualMcu'])->name('save-input-manual-mcu');
    Route::post('/mcu/program-mcu/detail/import-excel-anamnesa', [ProgramMcuController::class, 'importExcelAnamnesa']);
    Route::get('/mcu/program-mcu/detail/pemeriksaan', [PemeriksaanMcuController::class, 'index']);
    Route::get('/mcu/program-mcu/detail/pemeriksaan/cetak-pemeriksaan', [PemeriksaanMcuController::class, 'cetakPemeriksaanMcu']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-anamnesis', [PemeriksaanMcuController::class, 'saveAnamnesis']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-lab', [PemeriksaanMcuController::class, 'saveLab']);
});
