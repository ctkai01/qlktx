<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;

    protected $table = 'tblnhanvien';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'MaNV';
    public $incrementing = FALSE;

    // public function taiKhoan()
    // {
    //     return $this->belongsTo(TaiKhoan::class, 'TaiKhoan_Id');
    // }

    public function getAnhAttribute() {
        return asset('/storage/employees').'/'.$this->attributes['Anh'];
    }
}
