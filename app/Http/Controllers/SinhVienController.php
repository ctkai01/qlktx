<?php

namespace App\Http\Controllers;

use App\Libraries\Ultilities;
use App\Models\HopDong;
use App\Models\Phong;
use App\Models\SinhVien;
use App\Models\TaiKhoan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class SinhVienController extends Controller
{
    //
    public function save(Request $request) {
        $request->validate([
            'rooms' => 'required',
            'masv' => 'required|max:11|unique:tblsinhvien,MaSV,'.$request->masv,
            'name' => 'required|max:50',
            'dateofbirth' => 'required|before:today',
            'gender' => 'required|in:0,1',
            'hometown' => 'required|max:100',
            'phone' => 'required|max:10',
            'class' => 'required|max:20',
            'khoa' => 'required|max:100',
            'account' => 'required|max:10|unique:tbltaikhoan,TaiKhoan,'.$request->account,
            'password' => 'required|max:15|min:4',
            'avatar' => 'required|image|mimes:jpeg,jpg,png,gif|max:10240'
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
            'TacVu' => TaiKhoan::SINH_VIEN
        ];
        $dataStudent = [
            'MaSV' => Ultilities::clearXSS($request->masv),
            'HoTen' => Ultilities::clearXSS($request->name),
            'NgaySinh' => Ultilities::clearXSS($request->dateofbirth),
            'GioiTinh' => Ultilities::clearXSS($request->gender),
            'QueQuan' => Ultilities::clearXSS($request->hometown),
            'DienThoai' => Ultilities::clearXSS($request->phone),
            'Lop' => Ultilities::clearXSS($request->class),
            'Khoa' => Ultilities::clearXSS($request->khoa),
            'Anh' => $this->saveImage($request->avatar),
            'MaPhong' => Ultilities::clearXSS($request->rooms),
        ];

        $dataContract = [
            'MaHopDong' => 'HD'. substr(uniqid(), 0, 5),
            'NgayDangKy' => $request->date_register,
            'NgayHetHan' => $request->exprired_date,
            'NgayKy' => $request->date_register,
        ];
        

        if ($request->chuthich) {
            $dataContract['ChuThich'] = $request->chuthich;
        }
        
        DB::beginTransaction();
        try {
            $account = TaiKhoan::create($dataAccount);
            $contract = HopDong::create($dataContract);
            $dataStudent['MaHopDong'] = $contract->MaHopDong;
            $account->owner()->create($dataStudent);

            $room = Phong::where('MaPhong', $request->rooms)->first();

            $timeString = $request->date_register;
            for ($i = 0; $i < (int) $request->aboutThue; $i++) {
                $time = strtotime($timeString);
                $account->owner->bills()->create([
                    'ThoiGian' => $timeString,
                    'TienPhong' => $room->GiaPhong,
                    'DaThanhToan' => 0,
                    'MaPhong' => $room->MaPhong,
                ]);
                $timeString = date("Y-m-d", strtotime("+1 month", $time));
            }

            if ($room->students->count() >= $room->SoNguoi) {
                $room->update([
                    'TinhTrang' => 0
                ]);
            }

            DB::commit();
            return redirect()->route('register.student')->with(['alert-type' => 'success', 'message' => "Tạo tài khoản thành công "]);

        } catch (Exception $ex) {
            DB::rollback();
            throw new Exception($ex->getMessage());
        }
    }

    public function show($masv) {
        $student = SinhVien::where('MaSV', $masv)->first();
        return view("students.show", compact('student'));
    }

    public function saveImage($image){
        $imageName =  uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('employees/', $imageName);
        return $imageName;
    }

    public function billOwe() {
        $billOwe = Auth::user()->owner->room->bills->where('DaThanhToan', 0)->sortByDesc('ThoiGian');
        return view('students.list_bill', compact('billOwe'));
    }

    public function roomOwe() {
        $roomOwe = Auth::user()->owner->bills->where('DaThanhToan', 0)->sortByDesc('ThoiGian');
        
        return view('students.list_room_bill', compact('roomOwe'));
    }


    public function roomOweDatatable(Request $request) {
        if ($request->ajax()) {
            $datas = Auth::user()->owner->bills->where('DaThanhToan', 0)->sortByDesc('ThoiGian');
            return DataTables::of($datas)
            ->addIndexColumn()
            
            // ->filter(function ($instance) use ($request) {
            //     if (!empty($request->get('search'))) {
            //         $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            //             if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
            //                 return true;
            //             }
            //             return false;
            //         });
            //     }
            // })
            ->editColumn('ThoiGian', function($data) {
                $timestamp = strtotime($data->ThoiGian);
                $new_date = date("d-m-Y", $timestamp);
                return "<div>$new_date</div>";
            })
            ->editColumn('DaThanhToan', function($data) {
                if ($data->DaThanhToan) {
                    return "<span class=\"badge bg-label-success me-1\">Đã thanh toán</span>";

                } else {
                    return "<span class=\"badge bg-label-danger me-1\">Chưa thanh toán</span>";
                }
            })
            ->editColumn('action', function($data) {
                $routePayment = route('room_payment', $data->id);
                return "<a class=\"btn-payment\" href=\"$routePayment\"><button type=\"button\" class=\"btn btn-success\" aria-expanded=\"false\">Thanh toán</button></a>";
            })
                    ->rawColumns(['action', 'ThoiGian', 'DaThanhToan'])
            ->make(true);
        }
    }
   
    public function billOweDatatable(Request $request) {
        if ($request->ajax()) {
            $datas = Auth::user()->owner->room->bills->where('DaThanhToan', 0)->sortByDesc('ThoiGian');
            return DataTables::of($datas)
            ->editColumn('TienDien', function($data) {
                return "<div class='price-room'>$data->TienDien</div>";
            })
            ->editColumn('HoaDonCho', function($data) {
                $timestamp = strtotime($data->ThoiGian);
                $new_date = date("m-Y", $timestamp);
                return "<div>$new_date</div>";
            })
            ->editColumn('DaThanhToan', function($data) {
                if ($data->DaThanhToan) {
                    return "<span class=\"badge bg-label-success me-1\">Đã thanh toán</span>";

                } else {
                    return "<span class=\"badge bg-label-danger me-1\">Chưa thanh toán</span>";
                }
            })
            ->editColumn('DaThanhToan', function($data) {
                if ($data->DaThanhToan) {
                    return "<span class=\"badge bg-label-success me-1\">Đã thanh toán</span>";

                } else {
                    return "<span class=\"badge bg-label-danger me-1\">Chưa thanh toán</span>";
                }
            })
            ->editColumn('TongTien', function($data) {
                $total = $data->TienDien + $data->TienNuoc + $data->TienPhatSinh;
                return "<div class='price-room'>$total</div>";
            })
            ->editColumn('TinhTrangThanhToan', function($data) {
                if ($data->DaThanhToan) {
                    return "<span class=\"badge bg-label-success me-1\">Đã thanh toán</span>";
                } else {
                    return "<span class=\"badge bg-label-danger me-1\">Chưa thanh toán</span>";
                }
            })
            ->editColumn('action', function($data) {
                // dd($data->id);
                $route = route('bill_payment', $data->MaHoaDon);
                return "<a class='btn-payment' href='$route'><button type='button' class='btn btn-success' aria-expanded='false\'>Thanh toán</button></a>";
            })
            ->rawColumns(['action', 'TinhTrangThanhToan', 'TongTien', 'HoaDonCho', 'ThoiGian', 'DaThanhToan', 'TienDien'])
            ->make(true);
        }
    }

    public function listStudent() {
        return view('students.list');
    }

    public function listStudentDatatable(Request $request) {
        if ($request->ajax()) {
            $datas = SinhVien::all()->sortByDesc('id');
            return DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('Anh', function($data) {
                return "<img width=\"200\" src=\"$data->Anh\" />";
            })
            ->editColumn('NgaySinh', function($data) {
                $timestamp = strtotime($data->NgaySinh);
                $new_date = date("d-m-Y", $timestamp);
                return "<div>$new_date</div>";
            })
            ->editColumn('Phong', function($data) {
                $maPhong = $data->room ? $data->room->MaPhong : 'Chưa có phòng';
                return "<div>$maPhong</div>";
            })
            ->editColumn('action', function($data) {
                $routeShowStudent = route('students.show', $data->MaSV);
                $routeListRoomOwe = route('student.list_room_owe', $data->MaSV);
                $routeKick = route('rooms.kick_student', [$data->MaPhong, $data->MaSV]);
                
                if (Auth::user()->TacVu == 1) {
                    return "
                        <div class='dropdown'>
                        <button type='button' class='btn p-0 dropdown-toggle hide-arrow'
                            data-bs-toggle='dropdown'>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </button>
                        <div class='dropdown-menu'>
                            <a class='dropdown-item'
                                href='$routeShowStudent'><i
                                    class='bx bx-edit-alt me-1'></i>Xem</a>
                    </div>
                        ";
                } else {
                    return "
                <div class='dropdown'>
                <button type='button' class='btn p-0 dropdown-toggle hide-arrow'
                    data-bs-toggle='dropdown'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                </button>
                <div class='dropdown-menu'>
                    <a class='dropdown-item'
                        href='$routeShowStudent'><i
                            class='bx bx-edit-alt me-1'></i>Xem</a>
                    <a class='dropdown-item'
                        href='$routeListRoomOwe'><i
                            class='bx bx-edit-alt me-1'></i>Danh sách nợ phòng</a>
                    <a class='dropdown-item kick-btn'
                        href='$routeKick'><i
                            class='bx bx-edit-alt me-1'></i>Đuổi</a>
                </div>
            </div>
                ";
                }
                
                
            })
            ->rawColumns(['action', 'Anh', 'NgaySinh', 'Phong'])
            ->make(true);
        }
    }

    public function contractMe() {
        $student = Auth::user()->owner;
        $contract = $student->contract;
        $roomStudent = $student->room;
        $rooms = Phong::all();
        if ($roomStudent) {
            $rooms = $rooms->filter(function ($room, $key) use($roomStudent)  {
                return $room->students->count() < $room->SoNguoi || $room->MaPhong == $roomStudent->MaPhong;
            });
        }
        return view('students.contract', compact('contract', 'rooms', 'roomStudent'));
    }

    public function contractContinually(Request $request) {
        $student = Auth::user()->owner;
        $contract = $student->contract;

        DB::beginTransaction();
        try {
            $contract->update([
                'NgayHetHan' => $request->exprired_date
            ]);
            $room = Phong::where('MaPhong', $request->rooms)->first();

            $timeString = $request->date_register;
            for ($i = 0; $i < (int) $request->aboutThue; $i++) {
                $time = strtotime($timeString);
                $student->bills()->create([
                    'ThoiGian' => $timeString,
                    'TienPhong' => $room->GiaPhong,
                    'DaThanhToan' => 0,
                    'MaPhong' => $room->MaPhong,
                ]);
                $timeString = date("Y-m-d", strtotime("+1 month", $time));
            }

            if ($room->students->count() >= $room->SoNguoi) {
                $room->update([
                    'TinhTrang' => 0
                ]);
            }

            DB::commit();
            return redirect()->route('student.contract')->with(['alert-type' => 'success', 'message' => "Gia hạn hợp đồng thành công"]);

        } catch (Exception $ex) {
            DB::rollback();
            throw new Exception($ex->getMessage());
        }
    }
}
