<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    // Add to cart
    public function addToCartQv(Request $request){
        if($request->ajax()){
            $product = Product::findOrFail($request->id);
            Cart::Add([
                'id'     => $product->id,
                'name'   => $product->name,
                'qty'    => $request->qty,
                'price'  => $request->price,
                'weight' => '1',
                'options' => [
                    'size'      => $request->size,
                    'color'     => $request->color,
                    'thumbnail' => $product->thumbnail,
                ]
            ]);
            return response()->json("Cart added");
        }
    }

    public function myCart(){
        $content = Cart::content();
        return response()->json($content);
    }


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
