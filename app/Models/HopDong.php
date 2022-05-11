<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HopDong extends Model
{
    use HasFactory;

    protected $table = 'tblhopdong';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'MaHopDong';
    
}
