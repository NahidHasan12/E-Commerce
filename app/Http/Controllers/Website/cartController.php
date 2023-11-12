<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\category;
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
        $cart_content = Cart::content();
        return view('frontend.cart.cart', compact('cart_content'));
    }

    public function cartReload(Request $request) {
        if ($request->ajax()) {
            $cartLoad = Cart::total();
            $cartCount = Cart::count();
            return response()->json([
                'cartLoad'=>$cartLoad,
                'cartCount'=>$cartCount,
            ]);
        }
    }

    public function cartUpdateQty(Request $request){
        // dd($request->all());
        $cartId = $request->cartId;
        $qty = $request->qty;
        Cart::update($cartId, ['qty' => $qty ]);
        return response()->json("Cart quantity Update");
    }

    public function cartUpdateColor(Request $request){
        $cartId = $request->cartId;
        $color = $request->color;
        $cart_color = Cart::get($cartId);
        $thumbnail = $cart_color->options->thumbnail;
        $size = $cart_color->options->size;
        Cart::update($cartId, ['options'=> ['color' => $color, 'thumbnail'=>$thumbnail, 'size'=>$size]]);
        return response()->json("Cart color Update");
    }

    public function cartUpdateSize(Request $request){
        $cartId = $request->cartId;
        $size = $request->size;

        $cart_size = Cart::get($cartId);
        $thumbnail = $cart_size->options->thumbnail;
        $color = $cart_size->options->color;
        Cart::update($cartId, ['options'=> ['size'=>$size,'thumbnail'=>$thumbnail,'color' => $color]]);
        return response()->json("Cart Size Update");
    }

    public function cartDestroy(){
        Cart::destroy();
        $alert = array('message'=>'Cart item clear', 'alert-type'=>'success');
        return redirect('/')->with($alert);
    }

    public function cartRemove(Request $request) {
        Cart::remove($request->button_id);
        return response()->json("Cart removed !");

    }



    //wishList Code

    public function wishlist() {
        if (Auth::check()) {
            $category = category::all();
            $products = Wishlist::where('user_id',auth::id())->get();
            return view('frontend.pages.wishlist',compact('category','products'));
        }
        $alert = array('message'=>'at first login your account', 'alert-type'=>'success');
        return redirect('/')->with($alert);
    }

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
                    'date' => date('d, m y'),
                ]);
                $message = array('message'=>'Product Added on Wishlist !','alert-type'=>'success');
                return redirect()->back()->with($message);
            }
        }else{
            $message = array('message'=>'At first login to your account !','alert-type'=>'error');
            return redirect()->back()->with($message);
        }
    }

    public function wishlistProduct_remove($id){
        Wishlist::where('id',$id)->delete();
        $message = array('message'=>'Product remove successfully!','alert-type'=>'success');
        return redirect()->back()->with($message);
    }

    public function empty_wishlist(){
        Wishlist::where('user_id',Auth::id())->delete();
        $message = array('message'=>'Wishlist clear !','alert-type'=>'success');
        return redirect()->back()->with($message);
    }
}
