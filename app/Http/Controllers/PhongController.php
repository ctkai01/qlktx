<?php

namespace App\Http\Controllers;

use App\Models\Phong;
use App\Models\SinhVien;
use Illuminate\Http\Request;

class PhongController extends Controller
{
    //
    
    public function list() {
        $rooms = Phong::all();
        return view('rooms.list', compact('rooms'));
    }

    public function show($maPhong) {
        $room = Phong::where('MaPhong', $maPhong)->first();
        return view("rooms.show", compact('room'));
    }

    public function kickStudent($maPhong, $maSv) {
        $student = SinhVien::where('MaSv', $maSv)->first();
        $student->update([
            'MaPhong' => ''
        ]);
        return response()->json(['success' => true, 'message' => 'Đuổi thành công']);
    }
}
