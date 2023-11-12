<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
}
