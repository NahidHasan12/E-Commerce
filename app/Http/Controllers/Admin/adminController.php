<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    //password Change
    public function passwordChange(){
        return view('admin.profile.password_change');
    }

    //password Update
    public function passwordUpdate(Request $request){
        $validated = $request->validate([
            'old_password'=>'required',
            'password'=>'required|min:5|confirmed|string'
        ]);

        $authPass = Auth::user();
        if(Hash::check($request->old_password, $authPass->password)){
            $authId = User::findOrFail($authPass->id);
            $authId->update([
                'password'=>Hash::make($request->password)
            ]);
            Auth::logout();
            $message = array('message'=>'You are Log Out','alert-type'=>'success');
            return redirect()->route('admin.login')->with($message);
        }else{
            $message = array('message'=>'Opps...! Old Password Not Match','alert-type'=>'error');
            return redirect()->back()->with($message);
        }
    }
}
