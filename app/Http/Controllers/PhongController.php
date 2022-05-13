<?php

namespace App\Http\Controllers;

use App\Libraries\Ultilities;
use App\Models\HoaDon;
use App\Models\HoaDonSinhVien;
use App\Models\Phong;
use App\Models\SinhVien;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class PhongController extends Controller
{
    //

    public function list()
    {
        $rooms = Phong::all();
        return view('rooms.list', compact('rooms'));
    }

    public function show($maPhong)
    {
        $room = Phong::where('MaPhong', $maPhong)->first();
        $studentNotRoom = SinhVien::where('MaPhong', '')->get();
        return view("rooms.show", compact('room', 'studentNotRoom'));
    }

    public function kickStudent($maPhong, $maSv)
    {
        $student = SinhVien::where('MaSv', $maSv)->first();
        $student->update([
            'MaPhong' => ''
        ]);
        return response()->json(['success' => true, 'message' => 'Đuổi thành công']);
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_room' => 'required|max:10|unique:tblthongtinphong,MaPhong,' . $request->name_room,
            'type_room' => 'required|in:0,1',
            'price' => 'required|numeric|min:0|not_in:0',
            'number_people' => 'required|numeric|min:0|not_in:0',
            'avatars' => 'required|array',
            'avatars.*' => 'required|image|mimes:jpeg,jpg,gif,png|max:10240'
        ], [
            'name_room.required' => 'Tên phòng không được bỏ trống',
            'type_room.required' => 'Loại phòng không được bỏ trống',
            'price.required' => 'Giá phòng không được bỏ trống',
            'number_people.required' => 'Số người ở không được bỏ trống',
            'name_room.max' => 'Tên phòng không quá 10 kí tự',
            'name_room.unique' => 'Tên phòng đã tồn tại',

            'price.numeric' => 'Giá phòng phải là số',
            'price.min' => 'Giá phòng không hợp lệ',
            'price.not_in' => 'Giá phòng không hợp lệ',

            'number_people.numeric' => 'Số người ở phải là số',
            'number_people.min' => 'Số người ở không hợp lệ',
            'number_people.not_in' => 'Số người ở không hợp lệ',

            'avatars.required' => 'Ảnh không được bỏ trống',
            'avatars.*.mimes' => 'Ảnh không đúng định dạng jpeg,jpg,png,gif',
            'avatars.*.max' => 'Ảnh dung lượng không quá 10Mb',
        ]);

        $data = [
            'MaPhong' => Ultilities::clearXSS($request->name_room),
            'TinhTrang' => 1,
            'LoaiPhong' => Ultilities::clearXSS($request->type_room),
            'GiaPhong' => Ultilities::clearXSS($request->price),
            'SoNguoi' => Ultilities::clearXSS($request->number_people),
        ];

        DB::beginTransaction();
        try {
            $room = Phong::create($data);

            foreach ($request->avatars as $avatar) {
                $name = $this->saveImage($avatar);
                $room->media()->create([
                    'Ten' => $name
                ]);
            }
            DB::commit();
            return redirect()->route('rooms.list')->with(['alert-type' => 'success', 'message' => "Tạo phòng thành công "]);
        } catch (Exception $ex) {
            DB::rollback();
            throw new Exception($ex->getMessage());
        }
    }

    public function saveImage($image)
    {
        $imageName =  uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('rooms/', $imageName);
        return $imageName;
    }

    public function edit($maPhong)
    {
        $room = Phong::where('MaPhong', $maPhong)->first();
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $room = Phong::find($id);
        if ($room->MaPhong == $request->name_room) {
            $request->validate([
                'name_room' => 'required|max:10',
                'type_room' => 'required|in:0,1',
                'price' => 'required|numeric|min:0|not_in:0',
                'number_people' => 'required|numeric|min:0|not_in:0',
                'avatars' => 'array',
                'avatars.*' => 'image|mimes:jpeg,jpg,gif,png|max:10240'
            ], [
                'name_room.required' => 'Tên phòng không được bỏ trống',
                'type_room.required' => 'Loại phòng không được bỏ trống',
                'price.required' => 'Giá phòng không được bỏ trống',
                'number_people.required' => 'Số người ở không được bỏ trống',
                'name_room.max' => 'Tên phòng không quá 10 kí tự',

                'price.numeric' => 'Giá phòng phải là số',
                'price.min' => 'Giá phòng không hợp lệ',
                'price.not_in' => 'Giá phòng không hợp lệ',

                'number_people.numeric' => 'Số người ở phải là số',
                'number_people.min' => 'Số người ở không hợp lệ',
                'number_people.not_in' => 'Số người ở không hợp lệ',

                'avatars.*.mimes' => 'Ảnh không đúng định dạng jpeg,jpg,png,gif',
                'avatars.*.max' => 'Ảnh dung lượng không quá 10Mb',
            ]);
        } else {
            $request->validate([
                'name_room' => 'required|max:10|unique:tblthongtinphong,MaPhong,' . $request->name_room,
                'type_room' => 'required|in:0,1',
                'price' => 'required|numeric|min:0|not_in:0',
                'number_people' => 'required|numeric|min:0|not_in:0',
                'avatars' => 'array',
                'avatars.*' => 'image|mimes:jpeg,jpg,gif,png|max:10240'
            ], [
                'name_room.required' => 'Tên phòng không được bỏ trống',
                'type_room.required' => 'Loại phòng không được bỏ trống',
                'price.required' => 'Giá phòng không được bỏ trống',
                'number_people.required' => 'Số người ở không được bỏ trống',
                'name_room.max' => 'Tên phòng không quá 10 kí tự',
                'name_room.unique' => 'Tên phòng đã tồn tại',

                'price.numeric' => 'Giá phòng phải là số',
                'price.min' => 'Giá phòng không hợp lệ',
                'price.not_in' => 'Giá phòng không hợp lệ',

                'number_people.numeric' => 'Số người ở phải là số',
                'number_people.min' => 'Số người ở không hợp lệ',
                'number_people.not_in' => 'Số người ở không hợp lệ',

                'avatars.*.mimes' => 'Ảnh không đúng định dạng jpeg,jpg,png,gif',
                'avatars.*.max' => 'Ảnh dung lượng không quá 10Mb',
            ]);
        }

        $dataUpdate = [
            'MaPhong' => Ultilities::clearXSS($request->name_room),
            'TinhTrang' => 1,
            'LoaiPhong' => Ultilities::clearXSS($request->type_room),
            'GiaPhong' => Ultilities::clearXSS($request->price),
            'SoNguoi' => Ultilities::clearXSS($request->number_people),
        ];
        DB::beginTransaction();
        try {
            $room->update($dataUpdate);

            if ($request->avatars) {
                $room->media()->delete();
                foreach ($request->avatars as $avatar) {
                    $name = $this->saveImage($avatar);
                    $room->media()->create([
                        'Ten' => $name
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('rooms.list')->with(['alert-type' => 'success', 'message' => "Cập nhật phòng thành công "]);
        } catch (Exception $ex) {
            DB::rollback();
            throw new Exception($ex->getMessage());
        }
    }

    public function destroy($maPhong)
    {
        $room = Phong::where('MaPhong', $maPhong)->first();
        // dd($maPhong);
        DB::beginTransaction();
        try {
            $room->media()->delete();

            foreach ($room->students as $student) {
                $student->update([
                    'MaPhong' => ''
                ]);
            }

            $room->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Xóa phòng thành công']);
        } catch (Exception $ex) {
            DB::rollback();
            throw new Exception($ex->getMessage());
        }
    }

    public function addSinhVienRoom(Request $request, $maPhong)
    {
        $request->validate([
            'masv' => 'required'
        ], [
            'masv.required' => 'Trường này không được để trống'
        ]);

        $student = SinhVien::where('MaSV', $request->masv)->first();
        $student->update([
            'MaPhong' => $maPhong
        ]);

        return response()->json(['success' => true, 'message' => 'Thêm sinh viên vào phòng thành công']);

    }

    public function createBill($maPhong) {
        $room = Phong::where('MaPhong', $maPhong)->first();
        return view('rooms.create_bill', compact('room'));
    }

    public function storeBill(Request $request, $maPhong) {
        $request->validate([
            'date_year' => 'required',
            'price_electric' => 'required|numeric|min:0|not_in:0',
            'price_water' => 'required|numeric|min:0|not_in:0',
            'price_others' => 'nullable|numeric|min:0|not_in:0',
            'note' => 'max:200',
        ]);

        $data = [
            'MaHoaDon' => 'HDon'.substr(uniqid(), 0, 5),
            'TienDien' => Ultilities::clearXSS($request->price_electric),
            'TienNuoc' => Ultilities::clearXSS($request->price_water),
            'MaPhong' => $maPhong,
            'ThoiGian' => Ultilities::clearXSS($request->date_year).'-01',
        ];

        if ($request->price_others) {
            $data['TienPhatSinh'] = Ultilities::clearXSS($request->price_others);
        }

        if ($request->note) {
            $data['GhiChu'] = Ultilities::clearXSS($request->note);
        }

        DB::beginTransaction();
        try {
            $hoaDon = HoaDon::create($data);

            DB::commit();
            return redirect()->route('rooms.list')->with(['alert-type' => 'success', 'message' => "Tạo hóa đơn thành công "]);
        } catch (Exception $ex) {
            DB::rollback();
            throw new Exception($ex->getMessage());
        }
    }

    public function listBillByRoom($maPhong) {
        $room = Phong::where('MaPhong', $maPhong)->first();
        $bills = $room->bills->sortByDesc('ThoiGian');
        return view('rooms.list_bill', compact('bills', 'room'));
    }

    public function payment($maHoaDon) {
        $hoaDon = HoaDon::where('MaHoaDon', $maHoaDon)->first();
        DB::beginTransaction();
        try {
            $hoaDon->update([
                'DaThanhToan' => 1,
                'ThoiGianThanhToan' => Carbon::now()
            ]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Thanh toán hóa đơn thành công']);
        } catch (Exception $ex) {
            DB::rollback();
            throw new Exception($ex->getMessage());
        }
    }

    public function paymentRoom($id) {
        $hoaDonPhong = HoaDonSinhVien::find($id);
        DB::beginTransaction();
        try {
            $hoaDonPhong->update([
                'DaThanhToan' => 1,
                'ThoiGianThanhToan' => Carbon::now()
            ]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Thanh toán phòng thành công']);
        } catch (Exception $ex) {
            DB::rollback();
            throw new Exception($ex->getMessage());
        }
    }

    public function listDatatable(Request $request) {
        if ($request->ajax()) {
            $datas = Phong::all()->sortByDesc('MaPhong');
            return DataTables::of($datas)
            ->addIndexColumn()
            
            ->editColumn('TinhTrang', function($data) {
                if ($data->TinhTrang) {
                    return "<span class=\"badge bg-label-success me-1\">Còn trống</span>";
                } else {
                    return "<span class=\"badge bg-label-danger me-1\">Hết chỗ</span>";
                }
            })
            ->editColumn('LoaiPhong', function($data) {
                $img = asset('vip-card.png');
                if ($data->LoaiPhong) {
                    return "<img width=\"30px\" src=\"$img\"/>";
                } else {
                    return "Thường";
                }
            })
            ->editColumn('DanhSachNguoiThue', function($data) {
                $result = "";
                $result .= "<ul style=\"display: flex; justify-content: center\" class=\list-unstyled users-list m-0 avatar-group d-flex align-items-center\">";
                
                foreach ($data->students as $student) {
                    $result .= "
                    <li data-bs-toggle=\"tooltip\" data-popup=\"tooltip-custom\" data-bs-placement=\"top\"
                    class=\"avatar avatar-xs pull-up\" title=\"$student->HoTen\">
                    <img src=\"$student->Anh\" alt=\"Avatar\" class=\"rounded-circle\" />
                </li>
                    ";
                }
                $result .= "</ul>";
                return $result;
            })
            ->editColumn('action', function($data) {
                $routeShowRoom = route('rooms.show', $data->MaPhong);
                $routeEditRoom = route('rooms.edit', $data->MaPhong);
                $routeAddBillRoom = route('rooms.add_bill', $data->MaPhong);
                $routeBillListRoom = route('rooms.list_bill', $data->MaPhong);
                $routeDestroyRoom = route('rooms.destroy', $data->MaPhong);
                return "
                <div class='dropdown'>
                <button type='button' class='btn p-0 dropdown-toggle hide-arrow'
                    data-bs-toggle='dropdown'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                </button>
                <div class='dropdown-menu'>
                    <a class='dropdown-item' href='$routeShowRoom'><i
                        class='bx bx-edit-alt me-1'></i>Xem</a>
                    <a class='dropdown-item' href='$routeEditRoom'><i
                            class='bx bx-edit-alt me-1'></i>Sửa</a>
                    <a class='dropdown-item' href='$routeAddBillRoom'><i
                        class='bx bx-edit-alt me-1'></i>Tạo hóa đơn </a>
                        <a class='dropdown-item' href='$routeBillListRoom'><i
                            class='bx bx-edit-alt me-1'></i>Danh sách hóa đơn </a>
                    <a class='dropdown-item delete-btn' href='$routeDestroyRoom'><i
                            class='bx bx-trash me-1'></i>Xóa</a>
                </div>
            </div>
                ";
            })
            ->rawColumns(['action', 'DanhSachNguoiThue', 'TinhTrang', 'LoaiPhong'])
            ->make(true);
        }
    }

    public function showStudentDatatable(Request $request, $maPhong) {
        if ($request->ajax()) {
            $datas = Phong::where('MaPhong', $maPhong)->first()->students;
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
            ->editColumn('action', function($data) {
                $routeShowStudent = route('students.show', $data->MaSV);
                $routeListRoomOwe = route('student.list_room_owe', $data->MaSV);
                $routeKick = route('rooms.kick_student', [$data->MaPhong, $data->MaSV]);
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
            })
            ->rawColumns(['action', 'Anh', 'NgaySinh'])
            ->make(true);
        }
    }

    public function listBillByRoomDatatable(Request $request, $maPhong) {
        if ($request->ajax()) {
            $room = Phong::where('MaPhong', $maPhong)->first();
            $datas = $room->bills->sortByDesc('ThoiGian');
            return DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('TongTien', function($data) {
                $total = $data->TienDien + $data->TienNuoc + $data->TienPhatSinh;
                return "<div class='price-room'>$total</div>";
            })
            ->editColumn('HoaDonCho', function($data) {
                $timestamp = strtotime($data->ThoiGian);
                $new_date = date("m-Y", $timestamp);
                return "<div>$new_date</div>";
            })
            ->editColumn('TinhTrangThanhToan', function($data) {
                if ($data->DaThanhToan) {
                    return " <span class='badge bg-label-success me-1'>Đã thanh toán</span>";
                } else {
                    return "<span class='badge bg-label-danger me-1'>Chưa thanh toán</span>";
                }
            })
            ->editColumn('action', function($data) {
                $routePayment = route('bill_payment', $data->MaHoaDon);
                return " <a class='btn-payment' href='$routePayment'><button type='button' class='btn btn-success' aria-expanded='false'>Thanh toán</button></a>";
            })
            ->rawColumns(['action', 'HoaDonCho', 'TongTien', 'TinhTrangThanhToan'])
            ->make(true);
        }
    } 
}
