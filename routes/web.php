<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Mcu\PemeriksaanMcuController;
use App\Http\Controllers\Mcu\ProgramMcuController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CompanyController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::post('/mcu/program-mcu/detail/upload-hasil', [ProgramMcuController::class, 'uploadHasil']);
    Route::get('/get-data-mcu-program-company',  [ProgramMcuController::class, 'getDataMcuProgramCompany']);
    Route::get('/get-data-mcu-employee',  [ProgramMcuController::class, 'getDataMcuEmployee']);
    
    Route::get('/mcu/program-mcu/detail/pemeriksaan', [PemeriksaanMcuController::class, 'index']);
    Route::get('/mcu/program-mcu/detail/pemeriksaan/cetak-pemeriksaan', [PemeriksaanMcuController::class, 'cetakPemeriksaanMcu']);
    Route::delete('/mcu/program-mcu/detail/pemeriksaan/delete-pemeriksaan', [PemeriksaanMcuController::class, 'deletePemeriksaanMcu']);
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

Route::group(['middleware' => ['auth', 'role:1']], function () {
    Route::post('/mcu/program-mcu/detail/save-conclusion-suggestion', [ProgramMcuController::class, 'saveConclusionSuggestion'])->name('program-mcu-save-conclusion-suggestion');

    Route::get('/package', [PackageController::class, 'index'])->name('package');
    Route::post('/package/store', [PackageController::class, 'store'])->name('package.store');
    Route::get('/package/delete/{id}', [PackageController::class, 'delete'])->name('package.delete');
    Route::get('/package/detail/{id}', [PackageController::class, 'detail'])->name('package.detail');
    Route::post('/package/update', [PackageController::class, 'update'])->name('package.update');
    Route::get('/get-data-package',  [PackageController::class, 'getDataPackage']);

    Route::get('/company', [CompanyController::class, 'index'])->name('company');
    Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/company/delete/{id}', [CompanyController::class, 'delete'])->name('company.delete');
    Route::get('/company/detail/{id}', [CompanyController::class, 'detail'])->name('company.detail');
    Route::post('/company/update', [CompanyController::class, 'update'])->name('company.update');
    Route::get('/get-data-company',  [CompanyController::class, 'getDataCompany']);
});
