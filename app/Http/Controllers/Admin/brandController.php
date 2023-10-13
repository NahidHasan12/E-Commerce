<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\brandRequest;

class brandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.category.brand.index');
    }
    public function fatch(Request $request){
        if ($request->ajax()) {

            $getData = Brand::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('brand_logo', function($data){
                $brand_logo='
                 <img src="admin/brand_img/'.$data->brand_logo.'" class="w-50">
                ';
                return $brand_logo;
            })
            ->addColumn('action', function($data){
                $action='
                <button  class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$data->id.'"  data-toggle="modal" data-target="#edit_brand"> <i class="fa fa-edit"></i> </button>
                <button  class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$data->id.'"> <i class="fa fa-trash"></i> </button>
                ';
                return $action;
            })
            ->rawColumns(['action','brand_logo'])
            ->make(true);

        }
    }

    //Brand GetData
    // public function getData(Request $request){
    //     if($request->ajax()){
    //         $get_data = Brand::latest('id')->get();
    //         $code = '';
    //         foreach($get_data as $key=>$brand){
    //             $serial = $key+1;
    //             $code .='
    //             <tr>
    //                 <td>'.$serial.'</td>
    //                 <td><img src="admin/brand_img/'.$brand->brand_logo.'" alt="'.$brand->brand_name.'" width="60px" height="50px"></td>
    //                 <td>'.$brand->brand_name.'</td>
    //                 <td>'.$brand->brand_slug.'</td>
    //                 <td class="d-flex">
    //                     <button type="submit" class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$brand->id.'" data-toggle="modal" data-target="#edit_brand"> <i class="fa fa-pencil-square-o"></i> </button>
    //                     <button type="submit" class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$brand->id.'"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
    //                 </td>
    //             </tr>
    //             ';
    //         }
    //         return response()->json($code);

    //     }else{
    //         $output = ['status'=>'error', 'message'=>'Something Error!'];
    //     }

    // }
    //Brand Store
    public function store(brandRequest $request){
        $brand_logo = $this->file_upload($request->file('brand_logo'),'admin/brand_img/');
        $data = Brand::create([
            'brand_name'=>$request->brand_name,
            'brand_slug'=>Str::slug($request->brand_slug,'-'),
            'brand_logo'=>$brand_logo
        ]);

        if($data){
            $output = ['status'=>'success', 'message'=>'Data has been Saved'];
        }else{
            $output =['status'=>'error', 'message'=>'Something Error'];
        }
        return response()->json($output);

    }
    //Brand Update
    public function update(brandRequest $request){
        if($request->ajax()){
            $brand = Brand::findOrFail($request->update);
            if($request->hasFile('brand_logo')){
                $brand_logo = $this->file_update($request->file('brand_logo'),'admin/brand_img/', $brand->brand_logo);
            }else{
                $brand_logo = $brand->brand_logo;
            }

            $data = $brand->update([
                'brand_name'=>$request->brand_name,
                'brand_slug'=>Str::slug($request->brand_slug,'-'),
                'brand_logo'=>$brand_logo
            ]);

            if($data){
                $output = ['status'=>'success', 'message'=>'Data has been Updated'];
            }else{
                $output =['status'=>'error', 'message'=>'Something Error'];
            }
            return response()->json($output);
        }
    }
    //Brand Edit
    public function edit(Request $request){
        if($request->ajax()){
            $brand = Brand::findOrFail($request->brand_id);
            return response()->json($brand);
        }
    }
    //Brand Delete
    public function delete(Request $request){
        if($request->ajax()){
            $brand = Brand::findOrFail($request->brand_id);
            if(file_exists('admin/brand_img/'.$brand->brand_logo)){
                unlink('admin/brand_img/'.$brand->brand_logo);
            }
            $brand->delete();
            $output=['status'=>'success','message'=>'data deleted successfully'];
            return response()->json($output);
        }
    }
}
