<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDonSinhVien extends Model
{
    use HasFactory;

    protected $table = 'tbl_hoadonsinhvien';
    protected $guarded = [];
    public $timestamps = false;
    
    // public function getTenAttribute() {
    //     return asset('/storage/rooms').'/'.$this->attributes['Ten'];
    // }

    
}
