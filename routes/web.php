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

    Route::get('/dashboard/get-chart-data/{id_program}', [DashboardController::class, 'getChartData'])->name('get-chart-data');

    Route::get('/mcu/program-mcu', [ProgramMcuController::class, 'index'])->name('program-mcu');
    Route::get('/mcu/program-mcu/detail', [ProgramMcuController::class, 'detailProgramMcu'])->name('detail-program-mcu');
    Route::get('/mcu/program-mcu/detail/input-manual-mcu', [ProgramMcuController::class, 'insertManualMcu'])->name('input-manual-mcu');
    Route::post('/mcu/program-mcu/detail/input-manual-mcu/save-input-manual-mcu', [ProgramMcuController::class, 'actionInsertManualMcu'])->name('save-input-manual-mcu');
    Route::post('/mcu/program-mcu/detail/import-excel-anamnesa', [ProgramMcuController::class, 'importExcelAnamnesa']);
    Route::post('/mcu/program-mcu/detail/upload-hasil', [ProgramMcuController::class, 'uploadHasil']);
    Route::get('/mcu/program-mcu/detail/pemeriksaan', [PemeriksaanMcuController::class, 'index']);
    Route::get('/mcu/program-mcu/detail/pemeriksaan/cetak-pemeriksaan', [PemeriksaanMcuController::class, 'cetakPemeriksaanMcu']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-anamnesis', [PemeriksaanMcuController::class, 'saveAnamnesis']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-lab', [PemeriksaanMcuController::class, 'saveLab']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-refraction', [PemeriksaanMcuController::class, 'saveRefraction']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-rontgen', [PemeriksaanMcuController::class, 'saveRontgen']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-spirometry', [PemeriksaanMcuController::class, 'saveSpirometry']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-audiometry', [PemeriksaanMcuController::class, 'saveAudiometry']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-ekg', [PemeriksaanMcuController::class, 'saveEkg']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-usg', [PemeriksaanMcuController::class, 'saveUsg']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-treadmill', [PemeriksaanMcuController::class, 'saveTreadmill']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-papsmear', [PemeriksaanMcuController::class, 'savePapsmear']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/save-resume-mcu', [PemeriksaanMcuController::class, 'saveResumeMcu']);
});
