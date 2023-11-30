<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function customer(){
        $order = Order::where('user_id',Auth::id())->orderBy('id','DESC')->take(10)->get();
        // Total Order
        $total_order = Order::where('user_id',Auth::id())->count();
        // Complete Order
        $complete_order = Order::where('user_id',Auth::id())->where('status',3)->count();
        // Return Order
        $return_order = Order::where('user_id',Auth::id())->where('status',4)->count();
        // Cancel Order
        $cancel_order = Order::where('user_id',Auth::id())->where('status',5)->count();
        return view('frontend.user.dashboard', compact('order','total_order','complete_order','return_order','cancel_order'));
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

    // My Orders
    public function my_order(){
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->take(10)->get();
        return view('frontend.user.my_order', compact('orders'));
    }

    // View Order
    public function view_order($id){
        $order = Order::findOrFail($id);
        $order_details = OrderDetail::where('order_id',$id)->get();
        return view('frontend.user.order_details', compact('order','order_details'));
    }


}
