<?php

namespace App\Http\Controllers\Website;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class checkoutController extends Controller
{
    public function checkout(){
        if(!Auth::check()){
            $message = array('message'=>'Login your account first', 'alert-type'=>'error');
            return redirect()->back()->with($message);
        }else{
            $cart_content = Cart::content();
            return view('frontend.cart.checkout', compact('cart_content'));
        }

    }

    // Coupon Apply
    public function apply_coupon(Request $request){
        $coupon_code_check = Coupon::where('coupon_code', $request->cupon_apply)->first();
        if($coupon_code_check){

            if(date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($coupon_code_check->valid_date))){

                Session::put('coupon',[
                    'name' => $coupon_code_check->coupon_code,
                    'discount' => $coupon_code_check->coupon_amount,
                    'main_balance' => Cart::subtotal() - $coupon_code_check->coupon_amount,
                ]);

                $message = array('message'=>'Coupon Applied, Try Again', 'alert-type'=>'success');
                return redirect()->back()->with($message);

            }else{
                $message = array('message'=>'Expired Coupon Code, Try Again', 'alert-type'=>'error');
                return redirect()->back()->with($message);
            }

        }else{
            $message = array('message'=>'Invalid Coupon Code, Try Again', 'alert-type'=>'error');
            return redirect()->back()->with($message);
        }
    }

    // Remove coupon
    public function remove_coupon(){
        Session::forget('coupon');
        $message = array('message'=>'Coupon Removed', 'alert-type'=>'success');
        return redirect()->back()->with($message);
    }

    //Order Place
    Public function order_place(Request $request){
        $data = [
            'user_id' => Auth::id(),
            'order_id' => rand(10000,90000),
            'c_name' => $request->c_name,
            'c_phone' => $request->c_phone,
            'c_country' => $request->c_country,
            'c_city' => $request->c_city,
            'c_address' => $request->c_address,
            'c_email' => $request->c_email,
            'c_zipCode' => $request->c_zipCode,
            'date' => date('d-m-y'),
            'payment_type' => $request->payment_type,
            'tax' => 0,
            'shipping_charge' => 0,
            'status' => 0
        ];

        if(Session::has('coupon')){
            $data['subtotal'] = Cart::subtotal();
            $data['total'] = Cart::total();
            $data['coupon_code'] = Session::get('coupon')['name'];
            $data['coupon_discount'] = Session::get('coupon')['discount'];
            $data['main_balance'] = Session::get('coupon')['main_balance'];
            $data['tax'] = 0;
            $data['shipping_charge'] = 0;
            $data['status'] = 0;
        }else{
            $data['subtotal'] = Cart::subtotal();
            $data['total'] = Cart::total();
        }

        dd($data);
    }
}
