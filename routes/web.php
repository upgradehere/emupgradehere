<?php

use App\Http\Controllers\AuditTrailsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Mcu\PemeriksaanMcuController;
use App\Http\Controllers\Mcu\ProgramMcuController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DepartementController;
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
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login-check', [AuthController::class, 'check'])->name('login.check');
Route::post('/login-otp', [AuthController::class, 'otp'])->name('login.otp');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/mcu/program-mcu/detail/pemeriksaan/open-email-pemeriksaan/{secret}', [PemeriksaanMcuController::class, 'openEmailPemeriksaan'])->name('open-email-pemeriksaan-mcu');
Route::get('/mcu/program-mcu/detail/pemeriksaan/cetak-pemeriksaan', [PemeriksaanMcuController::class, 'cetakPemeriksaanMcu'])->name('print-pemeriksaan-mcu');

Route::group(['middleware' => ['auth', 'role:1,2']], function () { // Admin - Company
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/get-all-data-chart/{program_id}', [DashboardController::class, 'getAllDataChart'])->name('get-all-data-chart');
});

Route::group(['middleware' => ['auth', 'role:1,2,3,4,5']], function () { // ALL ROLES
    Route::get('/mcu/program-mcu', [ProgramMcuController::class, 'index'])->name('program-mcu');
    Route::post('/mcu/program-mcu/save-program', [ProgramMcuController::class, 'saveProgram'])->name('program-mcu-save-program');
    Route::post('/mcu/program-mcu/update-program', [ProgramMcuController::class, 'updateProgram'])->name('program-mcu-update-program');
    Route::get('/mcu/program-mcu/detail/name/{id}', [ProgramMcuController::class, 'getProgramName'])->name('detail-program-mcu-name');
    Route::get('/mcu/program-mcu/detail', [ProgramMcuController::class, 'detailProgramMcu'])->name('detail-program-mcu');
    Route::get('/mcu/program-mcu/detail/input-manual-mcu', [ProgramMcuController::class, 'insertManualMcu'])->name('input-manual-mcu');
    Route::post('/mcu/program-mcu/detail/input-manual-mcu/save-input-manual-mcu', [ProgramMcuController::class, 'actionInsertManualMcu'])->name('save-input-manual-mcu');
    Route::post('/mcu/program-mcu/detail/import-excel-anamnesa', [ProgramMcuController::class, 'importExcelAnamnesa']);
    Route::post('/mcu/program-mcu/detail/import-excel-mcu', [ProgramMcuController::class, 'importExcelMcu']);
    Route::post('/mcu/program-mcu/detail/upload-hasil', [ProgramMcuController::class, 'uploadHasil']);
    Route::get('/get-data-mcu-program-company/{id}',  [ProgramMcuController::class, 'getDataMcuProgramCompany']);

    Route::get('/mcu/program-mcu/detail', [ProgramMcuController::class, 'detailProgramMcu'])->name('detail-program-mcu');
    Route::get('/get-data-mcu-employee',  [ProgramMcuController::class, 'getDataMcuEmployee']);

    Route::get('/mcu/program-mcu/detail/pemeriksaan', [PemeriksaanMcuController::class, 'index']);
    Route::post('/mcu/program-mcu/detail/pemeriksaan/kirim-batch-pemeriksaan', [PemeriksaanMcuController::class, 'sendBatchPemeriksaanMcu'])->name('send-batch-pemeriksaan-mcu');
    Route::get('/mcu/program-mcu/detail/pemeriksaan/kirim-single-pemeriksaan/{mcu_id}', [PemeriksaanMcuController::class, 'sendSinglePemeriksaanMcu'])->name('send-single-pemeriksaan-mcu');
});

Route::group(['middleware' => ['auth', 'role:1,2,3,4']], function () { // Admin - Company - Dokter - CSO
    Route::post('/mcu/program-mcu/save-program', [ProgramMcuController::class, 'saveProgram'])->name('program-mcu-save-program');
    Route::post('/mcu/program-mcu/update-program', [ProgramMcuController::class, 'updateProgram'])->name('program-mcu-update-program');
    Route::get('/mcu/program-mcu/delete-program/{id}', [ProgramMcuController::class, 'deleteProgram'])->name('program-mcu-delete-program');
    Route::get('/mcu/program-mcu/detail/name/{id}', [ProgramMcuController::class, 'getProgramName'])->name('detail-program-mcu-name');

    Route::get('/change-password', [PasswordController::class, 'index'])->name('change-password');
    Route::post('/change-password/store', [PasswordController::class, 'store'])->name('change-password.store');

    Route::get('/mcu/program-mcu/detail/pemeriksaan/cetak-blanko', [PemeriksaanMcuController::class, 'cetakBlankoMcu'])->name('print-blanko-mcu');
    Route::get('/mcu/program-mcu/detail/pemeriksaan/cetak-barcode', [PemeriksaanMcuController::class, 'cetakBarcodeMcu'])->name('print-barcode-mcu');
});

Route::group(['middleware' => ['auth', 'role:1,2,3,5']], function () { // Admin - Company - Dokter - Karyawan
    
});

Route::group(['middleware' => ['auth', 'role:1,2,3']], function () { // Admin - Company - Dokter
    Route::get('/mcu/program-mcu/detail/input-manual-mcu', [ProgramMcuController::class, 'insertManualMcu'])->name('input-manual-mcu');
    Route::post('/mcu/program-mcu/detail/input-manual-mcu/save-input-manual-mcu', [ProgramMcuController::class, 'actionInsertManualMcu'])->name('save-input-manual-mcu');
    Route::post('/mcu/program-mcu/detail/import-excel-anamnesa', [ProgramMcuController::class, 'importExcelAnamnesa']);
    Route::post('/mcu/program-mcu/detail/upload-hasil', [ProgramMcuController::class, 'uploadHasil']);
    
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
    Route::post('/mcu/program-mcu/detail/save-conclusion-suggestion', [ProgramMcuController::class, 'saveConclusionSuggestion'])->name('program-mcu-save-conclusion-suggestion');
});

Route::group(['middleware' => ['auth', 'role:1,4']], function () {
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
    Route::post('/company/reset', [CompanyController::class, 'reset'])->name('company.reset');
    Route::get('/get-data-company',  [CompanyController::class, 'getDataCompany']);

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::get('/employee/data/{id}', [EmployeeController::class, 'data'])->name('employee.data');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employee/delete/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
    Route::get('/employee/detail/{id}', [EmployeeController::class, 'detail'])->name('employee.detail');
    Route::post('/employee/update', [EmployeeController::class, 'update'])->name('employee.update');
    Route::post('/employee/import-photo', [EmployeeController::class, 'importPhoto'])->name('employee.import-photo');
    Route::post('/employee/import-employee', [EmployeeController::class, 'importEmployee'])->name('employee.import-employee');

    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');
    Route::get('/doctor/data', [DoctorController::class, 'data'])->name('doctor.data');
    Route::post('/doctor/store', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('/doctor/delete/{id}', [DoctorController::class, 'delete'])->name('doctor.delete');
    Route::get('/doctor/detail/{id}', [DoctorController::class, 'detail'])->name('doctor.detail');
    Route::post('/doctor/update', [DoctorController::class, 'update'])->name('doctor.update');

    Route::get('/departement', [DepartementController::class, 'index'])->name('departement');
    Route::get('/departement/show/{company_id}', [DepartementController::class, 'show'])->name('departement.show');
    Route::get('/departement/data/{id}', [DepartementController::class, 'data'])->name('departement.data');
    Route::post('/departement/store', [DepartementController::class, 'store'])->name('departement.store');
    Route::get('/departement/delete/{id}', [DepartementController::class, 'delete'])->name('departement.delete');
    Route::get('/departement/detail/{id}', [DepartementController::class, 'detail'])->name('departement.detail');
    Route::post('/departement/update', [DepartementController::class, 'update'])->name('departement.update');

    Route::get('/audit-trails', [AuditTrailsController::class, 'index'])->name('audit-trails');
    Route::get('/audit-trails/get-data', [AuditTrailsController::class, 'getData'])->name('audit-trails.get-data');
});
