<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'tblsinhvien';
    protected $guarded = [];
    protected $primaryKey = 'MaSV';
    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo(Phong::class, 'MaPhong', 'MaPhong');
    }

    public function getAnhAttribute() {
        return asset('/storage/employees').'/'.$this->attributes['Anh'];
    }
}
