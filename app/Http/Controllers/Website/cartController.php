<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    //wishList Code
    public function wishlistAdd($product_id){
        if (Auth::check()) {
            $check = Wishlist::where('product_id',$product_id)->where('user_id',auth::id())->first();

            if ($check) {
                $message = array('message'=>'Already have it on your wishlist !','alert-type'=>'error' );
                return redirect()->back()->with($message);
            }else{
                $addWishlist=Wishlist::create([
                    'user_id'    => Auth::id(),
                    'product_id' => $product_id,
                ]);
                $message = array('message'=>'Product Added on Wishlist !','alert-type'=>'success');
                return redirect()->back()->with($message);
            }
        }else{
            $message = array('message'=>'At first login to your account !','alert-type'=>'error');
            return redirect()->back()->with($message);
        }
    }
}
