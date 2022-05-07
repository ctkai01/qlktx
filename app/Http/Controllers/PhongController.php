<?php

namespace App\Http\Controllers;

use App\Models\Phong;
use Illuminate\Http\Request;

class PhongController extends Controller
{
    //
    
    public function list() {
        $rooms = Phong::all();
        return view('rooms.list', compact('rooms'));
    }
}
