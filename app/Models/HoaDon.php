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
    // public function getTenAttribute() {
    //     return asset('/storage/rooms').'/'.$this->attributes['Ten'];
    // }
}
