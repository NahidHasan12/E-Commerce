<?php

namespace App\Http\Controllers\Website;

use App\Models\Review;
use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function index(){
        $category = category::get();
        $slider_product = Product::where('status',1)->where('slider_show',1)->latest()->first();
        $featured = Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(16)->get();
        $popular_product = Product::where('status',1)->orderBy('product_views','DESC')->limit(16)->get();
        $trendy_product = Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(8)->get();
        $home_category = category::where('home_page',1)->orderBy('category_name','ASC')->get();
        return view('frontend.pages.index', compact('category','slider_product','featured','popular_product','trendy_product','home_category'));
    }

    public function product_details($slug){
        $product_details = Product::where('slug',$slug)->first();
                           Product::where('slug',$slug)->increment('product_views');//product veiw count
        $related_product = Product::where('subcategory_id',$product_details->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        $review = Review::where('product_id',$product_details->id)->get();
        return view('frontend/pages/product_details', compact('product_details','related_product','review'));
    }

    public function review(Request $request) {
        $request->validate([
            'rating'=>'required',
            'review'=>'required'
        ]);

        $review_check = Review::where('product_id',$request->product_id)->first();
        if ($review_check) {
            $message = array('message'=>'Already you have leave a review this product !','alert-type'=>'error' );
            return redirect()->back()->with($message);
        }


        $review = Review::create([
            'user_id'      => Auth::id(),
            'product_id'   => $request->product_id,
            'rating'       => $request->rating,
            'review'       => $request->review,
            'review_date'  => date('d-m-Y'),
            'review_month' => date('F'),
            'review_year'  => date('Y')
        ]);

        $message = array('message'=>'Thanks for your review !','alert-type'=>'success' );
        return redirect()->back()->with($message);

    }

    // Quick View Modal
    public function quickView(Request $request){
        if($request->ajax()){
            $product = Product::where('id',$request->button_id)->first();
            return view('frontend.modal.quick_view',compact('product'));
            //return response()->json();
        }
        // return response()->json($view);
    }
}
