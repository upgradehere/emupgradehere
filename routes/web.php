<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
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
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login-check', [AuthController::class, 'check'])->name('login.check');
Route::post('/login-otp', [AuthController::class, 'otp'])->name('login.otp');

Route::get('/', [DashboardController::class, 'index'])->name('index');
