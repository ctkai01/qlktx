<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TaiKhoan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];
    const SINH_VIEN = 1;
    const NHAN_VIEN = 2;
    const QUAN_LY = 3;

    protected $table = 'tbltaikhoan';
    protected $hidden = [
        'MatKhau',
    ];

    public function owner() {
        if ($this->TacVu == self::SINH_VIEN) {
            return $this->hasOne(SinhVien::class, 'TaiKhoan_Id', 'id');
        } else {
            return $this->hasOne(NhanVien::class, 'TaiKhoan_Id', 'id');
        }
    }

    public function getTenTacVuAttribute() {
        if ($this->TacVu == self::SINH_VIEN) {
            return "Sinh viên";
        } else if ($this->TacVu == self::QUAN_LY) {
            return "Quản lý";
        } else {
            return "Nhân viên";
        }
    }

}
