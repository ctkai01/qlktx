<?php

namespace App\Http\Controllers;

use App\Libraries\Ultilities;
use App\Models\TaiKhoan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NhanVienController extends Controller
{
    //
    public function save(Request $request) {
        $date = Carbon::now();
        
        $request->validate([
            'name' => 'required|max:50',
            'dateofbirth' => 'required|before:today',
            'gender' => 'required|in:0,1',
            'hometown' => 'required|max:100',
            'phone' => 'required|max:10',
            'account' => 'required|max:10|unique:tbltaikhoan,TaiKhoan,'.$request->account,
            'password' => 'required|max:15|min:4',
            'avatar' => 'required|image|mimes:jpeg,jpg,png,gif|max:10240'
        ], [
            'name.required' => 'Họ và tên không được bỏ trống',
            'name.max' => 'Họ và tên không được quá 50 kí tự',
            'dateofbirth.required' => 'Ngày sinh không được bỏ trống',
            'dateofbirth.before' => 'Ngày sinh phải trước ngày hôm nay',
            'hometown.required' => 'Quê quán không được bỏ trống',
            'hometown.max' => 'Quê quán không được quá 100 kí tự',
            'phone.required' => 'Số điện thoại  không được bỏ trống',
            'phone.max' => 'Số điện thoại không được quá 10 kí tự',
            'account.required' => 'Tài khoản không được bỏ trống',
            'account.max' => 'Tài khoản không được quá 10 kí tự',
            'account.unique' => 'Tài khoản đã tồn tại',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.max' => 'Mật khẩu không được quá 15 kí tự',
            'password.min' => 'Mật khẩu phải lớn hơn 4 kí tự',
            'avatar.required' => 'Ảnh đại diện không được bỏ trống',
            'avatar.max' => 'Ảnh đại diện không được quá 10Mb',
        ]);

        $dataAccount = [
            'TaiKhoan' =>  Ultilities::clearXSS($request->account),
            'MatKhau' =>  Hash::make(Ultilities::clearXSS($request->password)),
            'TacVu' => TaiKhoan::NHAN_VIEN
        ];

        $dataEmployee = [
            'MaNV' => substr(uniqid(), 0, 5),
            'HoTen' => Ultilities::clearXSS($request->name),
            'NgaySinh' => Ultilities::clearXSS($request->dateofbirth),
            'GioiTinh' => Ultilities::clearXSS($request->gender),
            'QueQuan' => Ultilities::clearXSS($request->hometown),
            'DienThoai' => Ultilities::clearXSS($request->phone),
            'NgayLam' => Ultilities::clearXSS($date->toDateString()),
            'CaLam' => "0",
            'Anh' => $this->saveImage($request->avatar),
        ];
        
        DB::beginTransaction();
        try {
            $account = TaiKhoan::create($dataAccount);

            $account->owner()->create($dataEmployee);
            DB::commit();
            return redirect()->route('register.employee')->with(['alert-type' => 'success', 'message' => "Tạo tài khoản thành công "]);

        } catch (Exception $ex) {
            DB::rollback();
            throw new Exception($ex->getMessage());
        }
    }

    public function saveImage($image){
        $imageName =  uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('employees/', $imageName);
        return $imageName;
    }
}
