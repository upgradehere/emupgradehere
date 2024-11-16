<?php

use App\Http\Controllers\Dashboard\DashboardController;
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

Route::get('/', [DashboardController::class, 'index'])->name('index');
Route::get('/mcu/program-mcu', [ProgramMcuController::class, 'index'])->name('program-mcu');
