<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    public function Logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','Successfully logged out!');
    }
}
