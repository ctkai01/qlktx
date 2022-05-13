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
    Route::get('/ho-so', [AuthController::class, 'profile'])->name('profile');
    Route::post('/ho-so/cap-nhat', [AuthController::class, 'profileUpdate'])->name('profile_update');
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
        Route::get('/danh-sach/datatable', [PhongController::class, 'listDatatable'])->name('list_dt');
        Route::get('/tao-phong', [PhongController::class, 'create'])->name('create');
        Route::post('/', [PhongController::class, 'store'])->name('store');
        Route::get('/{id}', [PhongController::class, 'show'])->name('show');
        Route::get('/{id}/datatable_student', [PhongController::class, 'showStudentDatatable'])->name('show_student_dt');
        Route::post('/{id}/duoi/{id_student}', [PhongController::class, 'kickStudent'])->name('kick_student');
        Route::get('/{id}/sua', [PhongController::class, 'edit'])->name('edit');
        Route::post('/{id}', [PhongController::class, 'update'])->name('update');
        Route::delete('/{id}', [PhongController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/them-sinh-vien', [PhongController::class, 'addSinhVienRoom'])->name('add_student');
        Route::get('/{id}/hoa-don', [PhongController::class, 'createBill'])->name('add_bill');
        Route::get('/{id}/danh-sach-hoa-don', [PhongController::class, 'listBillByRoom'])->name('list_bill');
        Route::get('/{id}/danh-sach-hoa-don/datatable', [PhongController::class, 'listBillByRoomDatatable'])->name('list_bill_dt');
        Route::post('/{id}/hoa-don', [PhongController::class, 'storeBill'])->name('store_bill');
            // Route::get('/nhan-vien', [AuthController::class, 'registerForEmployee'])->name('employee');
            // Route::post('/nhan-vien', [NhanVienController::class, 'save'])->name('employee.save');
            // Route::post('/sinh-vien', [SinhVienController::class, 'save'])->name('student.save');
    });

    Route::group(['prefix' => 'hoa-don-no', 'as' => 'student.'], function() {
        Route::get('/danh-sach', [SinhVienController::class, 'billOwe'])->name('bill_owe');
        Route::get('/danh-sach/datatable', [SinhVienController::class, 'billOweDatatable'])->name('bill_owe_dt');
    });

    Route::group(['prefix' => 'tien-phong-no', 'as' => 'student.'], function() {
        Route::get('/danh-sach', [SinhVienController::class, 'roomOwe'])->name('room_owe');
        Route::get('/danh-sach/datatable', [SinhVienController::class, 'roomOweDatatable'])->name('room_owe_dt');

    });

    Route::post('/hoa-don/{id}/thanh-toan', [PhongController::class, 'payment'])->name('bill_payment');
    Route::post('/sinh-vien/{id}/thanh-toan', [PhongController::class, 'paymentRoom'])->name('room_payment');
    
    Route::get('/sinh-vien/{id}/danh-sach-no-phong', [NhanVienController::class, 'oweRoomList'])->name('student.list_room_owe');
   
    Route::get('/danh-sach/sinh-vien', [SinhVienController::class, 'listStudent'])->name('student.list');
    Route::get('/danh-sach/sinh-vien/datatable', [SinhVienController::class, 'listStudentDatatable'])->name('student.list.dt');

    Route::get('/danh-sach/nhan-vien', [NhanVienController::class, 'listEmployee'])->name('employee.list');
    Route::get('/danh-sach/nhan-vien/datatable', [NhanVienController::class, 'listEmployeeDatatable'])->name('employee.list.dt');
 
    Route::post('/doi-gio-lam/nhan-vien/{id}', [NhanVienController::class, 'changeTimeWork'])->name('employee.change-time-work');
   
    Route::get('/hop-dong', [SinhVienController::class, 'contractMe'])->name('student.contract');
    Route::post('/hop-dong', [SinhVienController::class, 'contractContinually'])->name('student.contract_post');
   
    Route::get('/ca-lam-viec/danh-sach', [NhanVienController::class, 'scheduleWork'])->name('employee.schedule_work');
    Route::get('/ca-lam-viec/danh-sach/datatable', [NhanVienController::class, 'scheduleWorkDataTable'])->name('employee.schedule_work_dt');
    
    Route::get('/dashboard', [AuthController::class, 'getMoneyRoom'])->name('dashboard');
    Route::get('/dashboard/room', [AuthController::class, 'getMoneyRoomStudent'])->name('dashboard.student');
});