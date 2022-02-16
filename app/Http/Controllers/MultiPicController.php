<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multipic;

class MultiPicController extends Controller
{
    public function Multipic(){
        $images = Multipic::all();
        return view('admin.multipic.index',compact('images'));
    }
}
