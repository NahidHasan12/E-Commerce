<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\category;
use App\Models\warehouse;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\Pickup_point;
use Illuminate\Http\Request;
use App\Models\Childcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class productController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $category = category::get();
        $brand = Brand::get();
        $warehouse = warehouse::get();
        return view('admin.product.index', compact('category','brand','warehouse'));
    }
    public function create(){
        $category = category::get();
        $brand = Brand::get();
        $pickup_point = Pickup_point::get();
        $warehouse = warehouse::get();
        return view('admin.product.create', compact('category','brand','pickup_point','warehouse'));
    }
    public function childCatSelect(Request $request) {
        if ($request->ajax()) {
            $childCat = Childcategory::where('subcategory_id', $request->data_id)->get();
            $options = '';
            foreach ($childCat as $item) {
                $options .= '<option value="'.$item->id.'">'.$item->childcategory_name.'</option>';
            }

            return response()->json($options);
        }
    }
    //get Data
    public function getData(Request $request){
        if ($request->ajax()) {
            $getData= "";
            $getData = Product::latest('id');
            // dd($getData);
            if ($request->category_id) {
                $getData->where('category_id',$request->category_id); // request coming from index page
            }
            if ($request->brand_id) {
                $getData->where('brand_id',$request->brand_id);  // request coming from index page
            }
            if ($request->warehouse_id) {
                $getData->where('warehouse',$request->warehouse_id); // request coming from index page
            }
            if ($request->status == 1) {
                $getData->where('status',$request->status); // request coming from index page
            }
            if ($request->status == 0) {
                $getData->where('status',$request->status); // request coming from index page
            }

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('thumbnail', function($product){
                $thumbnail='
                 <img src="admin/product_img/'.$product->thumbnail.'" class="w-50">
                ';
                return $thumbnail;
            })
            ->addColumn('action', function($product){
                $action='
                <div class="d-flex">
                <a href="" data-id="'.$product->id.'" id="view-btn" class="btn btn-info btn-sm m-1"><i class="fa fa-eye text-white"> </i></a>
                <a href="'.route('product.edit',$product->id).'" data-id="'.$product->id.'" id="edit-btn" class="btn btn-success btn-sm m-1"><i class="fa fa-edit text-white"> </i></a>
                <button  class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$product->id.'"> <i class="fa fa-trash"></i> </button>
                </div>
                ';
                return $action;
            })
            ->addColumn('category_id', function($product) {
                return $product->category->category_name;
            })
            ->addColumn('subcategory_id', function($product) {
                return $product->SubCategory->subcategory_name;
            })
            ->addColumn('brand_id', function($product) {
                return $product->Brand->brand_name;
            })
            ->addColumn('featured', function($product) {
                if ($product->featured == 1) {
                    return '<button class="deactive_featured" data-id="'.$product->id.'"> <i title="Click to Deactive" class="fa fa-thumbs-down text-danger"> </i> </button> <span class="badge badge-success"> Active </span>';
                }else {
                    return '<button class="active_featured" data-id="'.$product->id.'"> <i title="Click to Active" class="fa fa-thumbs-up text-success"> </i> </button> <span class="badge badge-warning"> Deactive </span>';
                }
            })
            ->addColumn('today_deal', function($product) {
                if ($product->today_deal == 1) {
                    return '<button class="deactive_todayDeal" data-id="'.$product->id.'"> <i title="Click to Deactive" class="fa fa-thumbs-down text-danger"> </i> </button> <span class="badge badge-success"> Active </span>';
                }else {
                    return '<button class="active_todayDeal" data-id="'.$product->id.'"> <i title="Click to Active" class="fa fa-thumbs-up text-success"> </i> </button> <span class="badge badge-warning"> Deactive </span>';
                }
            })
            ->addColumn('status', function($product) {
                if ($product->status == 1) {
                    return '<button class="deactive_status" data-id="'.$product->id.'"> <i title="Click to Deactive" class="fa fa-thumbs-down text-danger"> </i> </button> <span class="badge badge-success"> Active </span>';
                }else {
                    return '<button class="active_status" data-id="'.$product->id.'"> <i title="Click to Active" class="fa fa-thumbs-up text-success"> </i> </button> <span class="badge badge-warning"> Deactive </span>';
                }
            })
            ->addColumn('created_at', function($product){
                return $product->created_at->format('d-m-Y');
            })
            ->rawColumns(['action','thumbnail','category_id','subcategory_id','brand_id','featured','today_deal','status','created_at'])
            ->make(true);

        }
    }

    // featured active
    public function featuredActive(Request $request) {
        if ($request->ajax()) {
            Product::where('id',$request->data_id)->update(['featured'=>1]);
            $message = ['status'=>'success','message'=>'featured has been update - 1'];
            return response()->json($message);
        }
    }
    // featured Deactive
    public function featuredDeactivate(Request $request) {
        if ($request->ajax()) {
            Product::where('id',$request->data_id)->update(['featured'=>0]);
            $message = ['status'=>'success','message'=>'featured has been update - 0'];
            return response()->json($message);
        }
    }
    // Today Deal active
    public function todayDeal_active(Request $request) {
        if ($request->ajax()) {
            Product::where('id',$request->data_id)->update(['today_deal'=>1]);
            $message = ['status'=>'success','message'=>'Today Deal has been update - 1'];
            return response()->json($message);
        }
    }
    // Today Deal Deactive
    public function todayDeal_deactivate(Request $request) {
        if ($request->ajax()) {
            Product::where('id',$request->data_id)->update(['today_deal'=>0]);
            $message = ['status'=>'success','message'=>'Today Deal has been update - 0'];
            return response()->json($message);
        }
    }
    // Status active
    public function status_active(Request $request) {
        if ($request->ajax()) {
            Product::where('id',$request->data_id)->update(['status'=>1]);
            $message = ['status'=>'success','message'=>'Status has been update - 1'];
            return response()->json($message);
        }
    }
    // Status Deactive
    public function status_deactivate(Request $request) {
        if ($request->ajax()) {
            Product::where('id',$request->data_id)->update(['status'=>0]);
            $message = ['status'=>'success','message'=>'Status has been update - 0'];
            return response()->json($message);
        }
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required',
            'code'            => 'required|unique:products|max:55',
            'subcategory_id'  => 'required',
            'brand_id'        => 'required',
            'pickup_point_id' => 'required',
            'unit'            => 'required',
            'selling_price'   => 'required',
            'color'           => 'required',
            'description'     => 'required',
        ]);

        $subcategory = SubCategory::where('id',$request->subcategory_id)->first();


        $thumbnail_image = $this->file_upload($request->file('thumbnail_image'),'admin/product_img/');
        // $images = $this->file_upload($request->file('images'),'admin/product-images/');


        $product_imgs = $this->multiple_file_upload($request->file('images'),'admin/product_img/');

        $product = Product::create([
            'name'             => $request->name,
            'slug'             => Str::slug($request->name),
            'code'             => $request->code,
            'category_id'      => $subcategory->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'childcategory_id' => $request->child_category_id,
            'brand_id'         => $request->brand_id,
            'pickup_point_id'  => $request->pickup_point_id,
            'tags'             => $request->tags,
            'unit'             => $request->unit,
            'purchase_price'   => $request->purchase_price,
            'selling_price'    => $request->selling_price,
            'discount_price'   => $request->discount_price,
            'warehouse'        => $request->warehouse,
            'stock_quantity'   => $request->stock,
            'color'            => $request->color,
            'size'             => $request->size,
            'description'      => $request->description,
            'video'            => $request->video,
            'thumbnail'        => $thumbnail_image,
            // 'images'           => implode(",",$imageArray),
            'images'           => json_encode($product_imgs),
            'featured'         => $request->featured,
            'slider_show'      => $request->slider_show,
            'trendy'           => $request->trendy,
            'today_deal'       => $request->today_deal,
            'status'           => $request->status,
            'admin_id'         => Auth::id(),
            'date'             => date('d-m-Y'),
            'month'            => date('F'),
        ]);
        $notification = array('message'=>'Product Updated !','alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    //Edit product
    public function edit(string $id)
    {
        $category = category::get();
        $brand = Brand::get();
        $pickup_point = Pickup_point::get();
        $warehouse = warehouse::get();
        $product_edit = Product::findOrFail($id);
        return view('admin.product.edit',compact('category','brand','pickup_point','warehouse','product_edit'));
    }

     /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->slider_show);

        $product_update = Product::findOrFail($id);


         // $request->validate([
        //     'name'            => 'required',
        //     'code'            => 'required|max:55',
        //     'subcategory_id'  => 'required',
        //     'brand_id'        => 'required',
        //     'pickup_point_id' => 'required',
        //     'unit'            => 'required',
        //     'selling_price'   => 'required',
        //     'color'           => 'required',
        //     'description'     => 'required',
        // ]);


        if ($request->has('thumbnail_image')) {
            file_exists('admin/product_img/'.$product_update->thumbnail) ? unlink('admin/product_img/'.$product_update->thumbnail) : false;
            $file = $request->file('thumbnail_image');
            $extension = $file->getClientOriginalExtension();
            $imageName = uniqid(rand().time()).'.'.$extension;
            $file->move('admin/product_img/',$imageName);
        }else{
            $imageName = $product_update->thumbnail;
        }



        $imageArray = array();
        if ($request->hasFile('images')) {
            $imageArray = $this->multiple_file_update($request->file('images'),'admin/product_img/',$product_update->images);
        }else{
            $imageArray[] = $product_update->images;
        }

        $subcategory = Subcategory::where('id',$request->subcategory_id)->first();

        $product_update->update([
            'name'             => $request->name,
            'slug'             => Str::slug($request->name),
            'code'             => $request->code,
            'category_id'      => $subcategory->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'childcategory_id' => $request->child_category_id,
            'brand_id'         => $request->brand_id,
            'pickup_point_id'  => $request->pickup_point_id,
            'tags'             => $request->tags,
            'unit'             => $request->unit,
            'purchase_price'   => $request->purchase_price,
            'selling_price'    => $request->selling_price,
            'discount_price'   => $request->discount_price,
            'warehouse'        => $request->warehouse,
            'stock_quantity'   => $request->stock,
            'color'            => $request->color,
            'size'             => $request->size,
            'description'      => $request->description,
            'video'            => $request->video,
            'thumbnail'        => $imageName,
            'images'           => implode(",",$imageArray),
            'featured'         => $request->featured,
            'slider_show'      => $request->slider_show,
            'today_deal'       => $request->today_deal,
            'status'           => $request->status,
            'admin_id'         => Auth::id(),
            'date'             => date('d-m-Y'),
            'month'            => date('F'),
        ]);


        $notification = array('message'=>'Product Updated !','alert-type' => 'success');

        return redirect()->back()->with($notification);


    }


    //delete Product
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $product= Product::find($request->product_id);
            $product->delete();
            $message = ['status'=>'success','message'=>'Data has been update'];
            return response()->json($message);
        }
    }
}
