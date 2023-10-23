<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\category;
use App\Models\Pickup_point;
use App\Models\warehouse;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.product.index');
    }
    public function create(){
        $category = category::get();
        $brand = Brand::get();
        $pickup_point = Pickup_point::get();
        $warehouse = warehouse::get();
        return view('admin.product.create', compact('category','brand','pickup_point','warehouse'));
    }
}
