<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(){
        $category = category::get();
        $product = Product::where('slider_show',1)->latest()->first();
        return view('frontend.pages.index', compact('category','product'));
    }

    public function product_details($slug){
        $product_details = Product::where('slug',$slug)->first();
        $related_product = Product::where('subcategory_id',$product_details->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        return view('frontend/pages/product_details', compact('product_details','related_product'));
    }
}
