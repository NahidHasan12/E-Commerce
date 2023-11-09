<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function customer(){
        return view('frontend.user.dashboard');
    }

    public function profile_setting(){
        $shipping = Shipping::first();
        return view('frontend.user.setting', compact('shipping'));

    }

    public function profile_shipping_store(Request $request, $shipping_id){

        $shipping = Shipping::where('id', $shipping_id);
        $shipping->update([
            'user_id' => Auth::id(),
            'shipping_name' => $request->shipping_name,
            'shipping_phone' => $request->shipping_phone,
            'shipping_email' => $request->shipping_email,
            'shipping_address' => $request->shipping_address,
            'shipping_country' => $request->shipping_country,
            'shipping_city' => $request->shipping_city,
            'shipping_zipcode' => $request->shipping_zipcode,
        ]);
        $message = array('message'=>'Shipping details Update','alert-type'=>'success' );
        return redirect()->back()->with($message);

    }

    public function customer_pass_change(Request $request){

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
