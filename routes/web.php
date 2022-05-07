<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\SinhVienController;
use App\Models\SinhVien;
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
Route::post('/', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::get('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'dang-ky', 'as' => 'register.'], function() {
        Route::get('/sinh-vien', [AuthController::class, 'registerForStudent'])->name('student');
        Route::get('/nhan-vien', [AuthController::class, 'registerForEmployee'])->name('employee');
        Route::post('/nhan-vien', [NhanVienController::class, 'save'])->name('employee.save');
        Route::post('/sinh-vien', [SinhVienController::class, 'save'])->name('student.save');
    });
    Route::group(['prefix' => 'sinh-vien', 'as' => 'students.'], function() {
        Route::get('/{id}', [SinhVienController::class, 'show'])->name('show');
    });
    Route::group(['prefix' => 'phong', 'as' => 'rooms.'], function() {
        Route::get('/danh-sach', [PhongController::class, 'list'])->name('list');
        Route::get('/tao-phong', [PhongController::class, 'create'])->name('create');
        Route::post('/', [PhongController::class, 'store'])->name('store');
        Route::get('/{id}', [PhongController::class, 'show'])->name('show');
        Route::post('/{id}/duoi/{id_student}', [PhongController::class, 'kickStudent'])->name('kick_student');
        Route::get('/{id}/sua', [PhongController::class, 'edit'])->name('edit');
        Route::post('/{id}', [PhongController::class, 'update'])->name('update');
        Route::delete('/{id}', [PhongController::class, 'destroy'])->name('destroy');
        // Route::get('/nhan-vien', [AuthController::class, 'registerForEmployee'])->name('employee');
        // Route::post('/nhan-vien', [NhanVienController::class, 'save'])->name('employee.save');
        // Route::post('/sinh-vien', [SinhVienController::class, 'save'])->name('student.save');
    });
});