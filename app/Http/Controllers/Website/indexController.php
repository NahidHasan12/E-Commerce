<?php

namespace App\Http\Controllers\Website;

use App\Models\Page;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Product;
use App\Models\category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Childcategory;
use App\Models\Customer_review;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{


    public function index(){
        $category = category::get();
        $brand = Brand::inRandomOrder()->limit(12)->get();
        $slider_product = Product::where('status',1)->where('slider_show',1)->latest()->first();
        $featured = Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(16)->get();
        $popular_product = Product::where('status',1)->orderBy('product_views','DESC')->limit(16)->get();
        $today_deal = Product::where('status',1)->where('today_deal',1)->orderBy('id','DESC')->limit(6)->get();
        $trendy_product = Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(8)->get();
        $home_category = category::where('home_page',1)->orderBy('category_name','ASC')->get();
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $website_review = Customer_review::where('status',1)->orderBy('id','DESC')->limit(12)->get();
        return view('frontend.pages.index', compact(
            'category','slider_product','featured','popular_product','trendy_product',
            'home_category','brand','random_product','today_deal','website_review'
        ));
    }

    public function product_details($slug){
        $product_details = Product::where('slug',$slug)->first();
                           Product::where('slug',$slug)->increment('product_views');//product veiw count
        $related_product = Product::where('subcategory_id',$product_details->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        $review = Review::where('product_id',$product_details->id)->get();
        return view('frontend/pages/product_details', compact('product_details','related_product','review'));
    }

    // product review

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

    // Category Wise Product
    public function categoryWise_product($id){
        $categoryItem = category::where('id',$id)->first();
        $subcategory = SubCategory::where('category_id',$id)->get();
        $brands = Brand::get();
        $products = Product::where('category_id',$id)->paginate(20);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(12)->get();
        $category = category::get(); //for navbar

        return  view('frontend.pages.category_product',compact(
            'subcategory',
            'products',
            'brands',
            'category',
            'random_product',
            'categoryItem'
        ));
    }

    public function subCategoryWise_product($id){
        $sub_category = SubCategory::where('id',$id)->first();
        $child_category = Childcategory::where('subcategory_id',$id)->get();
        $brands = Brand::get();
        $products = Product::where('subcategory_id',$id)->paginate(20);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(12)->get();
        $category = category::get();
        return view('frontend.pages.subcategory_product', compact(
            'sub_category',
            'child_category',
            'brands',
            'products',
            'random_product',
            'category'
        ));
    }

    public function childCategoryWise_product($id){
        $child_category = Childcategory::where('id',$id)->first();
        $brands = Brand::get();
        $products = Product::where('childcategory_id',$id)->paginate(4);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(12)->get();
        $category = category::get();
        return view('frontend.pages.childcategory_product', compact(
            'child_category',
            'brands',
            'products',
            'random_product',
            'category'
        ));
    }

    public function brandWise_product($id){
        $brand_item = Brand::where('id',$id)->first();
        $brands = Brand::get();
        $products = Product::where('brand_id',$id)->paginate(20);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(12)->get();
        $category = category::get();
        return view('frontend.pages.brand_product', compact(
            'brand_item',
            'brands',
            'products',
            'random_product',
            'category'
        ));
    }

    // Dynamic page show on website
    public function viwe_pages($page_slug){
        $page = Page::where('page_slug',$page_slug)->first();
        return view('frontend.pages.page', compact('page'));
    }

    // store Newsletter from website home page
    public function store_newsletter(Request $request){
        $email = DB::table('newsletters')->where('email',$request->email)->first();
        if ($email) {
            $message = array('message'=>'Email already exist','alert-type'=>'error');
            return redirect()->back()->with($message);
        }else {
            DB::table('newsletters')->insert([
                'email' => $request->email
            ]);
            $message = array('message'=>'Thanks For Subscription','alert-type'=>'success');
            return redirect()->back()->with($message);
        }
    }
}
