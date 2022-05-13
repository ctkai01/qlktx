<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;

    protected $table = 'tblchitiethoadon';
    protected $guarded = [];
    protected $primaryKey = 'MaHoaDon';
    public $timestamps = false;
    public $incrementing = false;

    public function getTotalMoneyAttribute() {
        if ($this->TienPhatSinh) {
            return $this->TienDien + $this->TienNuoc + $this->TienPhatSinh;
        } else {
            return $this->TienDien + $this->TienNuoc;
        }
    }
}
