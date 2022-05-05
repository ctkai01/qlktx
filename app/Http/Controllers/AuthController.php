<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\TaiKhoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function loginView() {
        if (Auth::check()) {
            return redirect(route('home'));
        } else {
            return view('login');
        }
    }

    public function login(Request $request) {
        $request->validate([
            'account' => 'required',
            'password' => 'required',
        ], [
            'account.required' => 'Tài khoản không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống',
        ]);

        $userData = array(
            'TaiKhoan' => $request->account,
            'MatKhau' => $request->password,
          );

        if (Auth::attempt($userData)) {
            // dd(Auth::user()->TacVu, $request->role, Auth::user()->TacVu != $request->role);
            if (Auth::user()->TacVu != $request->role) {
                Auth::logout();
                return redirect()->back()->withErrors(['role' => 'Vui lòng chọn đúng quyền!']);
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->back()->withErrors(['authenticate' => 'Tài khoản hoặc mật khẩu không chính xác']);
        }
    }

    public function index(Request $request) {
        if (Auth::check()) {
            return view('home');
        } else {
            return view('login');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect(route('auth.view_login'));
    }

    public function registerForStudent() {
        return view('register.for_sinhvien');
    }

    public function registerForEmployee() {
        return view('register.for_nhanvien');
    }
}
