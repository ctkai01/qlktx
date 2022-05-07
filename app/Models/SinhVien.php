<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'tblsinhvien';
    protected $guarded = [];
    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo(Phong::class, 'MaPhong', 'MaPhong');
    }

    public function getAnhAttribute() {
        return asset('/storage/employees').'/'.$this->attributes['Anh'];
    }

    public function getNgaySinhAttribute() {
        $timestamp = strtotime($this->attributes['NgaySinh']);
        return date("d-m-Y", $timestamp);
    }

    public function getGioiTinhAttribute() {
        if ($this->attributes['GioiTinh']) {
            return 'Nam';
        } else {
            return 'Nữ';
        }
    }
}
