<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;

    protected $table = 'tblthongtinphong';
    protected $guarded = [];
    public $timestamps = false;

    public function students()
    {
        return $this->hasMany(SinhVien::class, 'MaPhong', 'MaPhong');
    }

    public function media()
    {
        return $this->hasMany(BoSuuTap::class, 'MaPhong', 'MaPhong');
    }
}
