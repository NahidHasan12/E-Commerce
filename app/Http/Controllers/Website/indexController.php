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
}
