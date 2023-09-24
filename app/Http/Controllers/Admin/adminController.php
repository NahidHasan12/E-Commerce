<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    //Admin after login
    public function admin(){
        return view('admin.home');
    }

    //Admin after logout

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
