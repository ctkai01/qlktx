<?php

namespace App\Http\Controllers;

use App\Libraries\Ultilities;
use App\Models\NhanVien;
use App\Models\Phong;
use App\Models\SinhVien;
use App\Models\TaiKhoan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            return redirect(route('login'));
        }
    }

    public function logout() {
        Auth::logout();
        return redirect(route('auth.view_login'));
    }

    public function registerForStudent() {  
        $rooms = Phong::all();
        $rooms = $rooms->filter(function ($room, $key) {
            return $room->students->count() < $room->SoNguoi;
        });
        return view('register.for_sinhvien', compact('rooms'));
    }

    public function registerForEmployee() {
        return view('register.for_nhanvien');
    }

    public function profile() {
        $owner =  Auth::user()->owner;
        if ($owner instanceof SinhVien) {
            return view('profile.sinhvien', compact('owner'));
        } else {
            return view('profile.nhanvien', compact('owner'));
        }
    }

    public function profileUpdate(Request $request) {
        $owner = Auth::user()->owner;

        if ($owner instanceof SinhVien) {
            if ($request->masv == $owner->MaSV) {
                $request->validate([
                    'masv' => 'required|max:11',
                    'name' => 'required|max:50',
                    'dateofbirth' => 'required|before:today',
                    'gender' => 'required|in:0,1',
                    'hometown' => 'required|max:100',
                    'phone' => 'required|max:10',
                    'class' => 'required|max:20',
                    'khoa' => 'required|max:100',
                    'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240'
                ], [
                    'rooms.required' => 'Phòng không được bỏ trống',
                    'class.required' => 'Lớp không được bỏ trống',
                    'class.max' => 'Lớp không được quá 20 kí tự',
                    'khoa.required' => 'Khoa không được bỏ trống',
                    'khoa.max' => 'Khoa không được quá 100 kí tự',
                    'masv.required' => 'Mã sinh viên không được bỏ trống',
                    'masv.max' => 'Mã sinh viên không được quá 11 kí tự',
                    'name.required' => 'Họ và tên không được bỏ trống',
                    'name.max' => 'Họ và tên không được quá 50 kí tự',
                    'dateofbirth.required' => 'Ngày sinh không được bỏ trống',
                    'dateofbirth.before' => 'Ngày sinh phải trước ngày hôm nay',
                    'hometown.required' => 'Quê quán không được bỏ trống',
                    'hometown.max' => 'Quê quán không được quá 100 kí tự',
                    'phone.required' => 'Số điện thoại  không được bỏ trống',
                    'phone.max' => 'Số điện thoại không được quá 10 kí tự',
                    'avatar.max' => 'Ảnh đại diện không được quá 10Mb',
                ]);
            } else {
                $request->validate([
                    'masv' => 'required|max:11|unique:tblsinhvien,MaSV,'.$request->masv,
                    'name' => 'required|max:50',
                    'dateofbirth' => 'required|before:today',
                    'gender' => 'required|in:0,1',
                    'hometown' => 'required|max:100',
                    'phone' => 'required|max:10',
                    'class' => 'required|max:20',
                    'khoa' => 'required|max:100',
                    'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240'
                ], [
                    'rooms.required' => 'Phòng không được bỏ trống',
                    'class.required' => 'Lớp không được bỏ trống',
                    'class.max' => 'Lớp không được quá 20 kí tự',
                    'khoa.required' => 'Khoa không được bỏ trống',
                    'khoa.max' => 'Khoa không được quá 100 kí tự',
                    'masv.required' => 'Mã sinh viên không được bỏ trống',
                    'masv.max' => 'Mã sinh viên không được quá 11 kí tự',
                    'masv.unique' => 'Mã sinh viên đã tồn tại',
                    'name.required' => 'Họ và tên không được bỏ trống',
                    'name.max' => 'Họ và tên không được quá 50 kí tự',
                    'dateofbirth.required' => 'Ngày sinh không được bỏ trống',
                    'dateofbirth.before' => 'Ngày sinh phải trước ngày hôm nay',
                    'hometown.required' => 'Quê quán không được bỏ trống',
                    'hometown.max' => 'Quê quán không được quá 100 kí tự',
                    'phone.required' => 'Số điện thoại  không được bỏ trống',
                    'phone.max' => 'Số điện thoại không được quá 10 kí tự',
                    'avatar.max' => 'Ảnh đại diện không được quá 10Mb',
                ]);
            }
            $dataStudent = [
                'MaSV' => Ultilities::clearXSS($request->masv),
                'HoTen' => Ultilities::clearXSS($request->name),
                'NgaySinh' => Ultilities::clearXSS($request->dateofbirth),
                'GioiTinh' => Ultilities::clearXSS($request->gender),
                'QueQuan' => Ultilities::clearXSS($request->hometown),
                'DienThoai' => Ultilities::clearXSS($request->phone),
                'Lop' => Ultilities::clearXSS($request->class),
                'Khoa' => Ultilities::clearXSS($request->khoa),
            ];
    
            if ($request->avatar) {
                $dataStudent['Anh'] = $this->saveImage($request->avatar);
            }
    
            DB::beginTransaction();
            try {
                $owner->update($dataStudent);
                
                DB::commit();
                return redirect()->route('profile')->with(['alert-type' => 'success', 'message' => "Cập nhật tài khoản thành công "]);
            } catch (Exception $ex) {
                DB::rollback();
                throw new Exception($ex->getMessage());
            }
        } else {
            $request->validate([
                'name' => 'required|max:50',
                'dateofbirth' => 'required|before:today',
                'gender' => 'required|in:0,1',
                'hometown' => 'required|max:100',
                'phone' => 'required|max:10',
                'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240'
            ], [
                'name.required' => 'Họ và tên không được bỏ trống',
                'name.max' => 'Họ và tên không được quá 50 kí tự',
                'dateofbirth.required' => 'Ngày sinh không được bỏ trống',
                'dateofbirth.before' => 'Ngày sinh phải trước ngày hôm nay',
                'hometown.required' => 'Quê quán không được bỏ trống',
                'hometown.max' => 'Quê quán không được quá 100 kí tự',
                'phone.required' => 'Số điện thoại  không được bỏ trống',
                'phone.max' => 'Số điện thoại không được quá 10 kí tự',
                'avatar.max' => 'Ảnh đại diện không được quá 10Mb',
            ]);

            $dataEmployee = [
                'HoTen' => Ultilities::clearXSS($request->name),
                'NgaySinh' => Ultilities::clearXSS($request->dateofbirth),
                'GioiTinh' => Ultilities::clearXSS($request->gender),
                'QueQuan' => Ultilities::clearXSS($request->hometown),
                'DienThoai' => Ultilities::clearXSS($request->phone),
            ];
    
            if ($request->avatar) {
                $dataEmployee['Anh'] = $this->saveImage($request->avatar);
            }
            DB::beginTransaction();
            try {
                $owner->update($dataEmployee);
                
                DB::commit();
                return redirect()->route('profile')->with(['alert-type' => 'success', 'message' => "Cập nhật tài khoản thành công "]);
            } catch (Exception $ex) {
                DB::rollback();
                throw new Exception($ex->getMessage());
            }
        }
    }
}
