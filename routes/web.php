<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\SinhVienController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dang-nhap', [AuthController::class, 'loginView'])->name('auth.view_login');
Route::post('/', [AuthController::class, 'login'])->name('auth.login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::get('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'dang-ky', 'as' => 'register.'], function() {
        Route::get('/sinh-vien', [AuthController::class, 'registerForStudent'])->name('student');
        Route::get('/nhan-vien', [AuthController::class, 'registerForEmployee'])->name('employee');
        Route::post('/nhan-vien', [NhanVienController::class, 'save'])->name('employee.save');
        Route::post('/sinh-vien', [SinhVienController::class, 'save'])->name('student.save');
    });
});