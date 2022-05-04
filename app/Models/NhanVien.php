<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;

    protected $table = 'tblnhanvien';
    protected $guarded = [];

    // public function taiKhoan()
    // {
    //     return $this->belongsTo(TaiKhoan::class, 'TaiKhoan_Id');
    // }
}
