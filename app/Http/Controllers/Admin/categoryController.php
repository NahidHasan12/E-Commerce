<?php

namespace App\Http\Controllers\Admin;

use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\categoryRequest;
use Yajra\DataTables\Facades\DataTables;

class categoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //all catergory showing method
    public function index(){
        return view('admin.category.cat.index');
    }
    public function getData(Request $request){
        if ($request->ajax()) {

            $getData = category::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action='
                <button  class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$data->id.'"  data-toggle="modal" data-target="#catEditModal"> <i class="fa fa-edit"></i> </button>
                <button  class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$data->id.'"> <i class="fa fa-trash"></i> </button>
                ';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);

        }


    }

    // Store Data
    public function store(categoryRequest $request){
        if($request->ajax()){
            $image = $this->file_upload($request->file('icon'),'admin/category_icon/');
            $data = category::create([
                'icon' => $image,
                'category_name' => $request->category_name,
                'category_slug' => Str::slug($request->category_slug,'-'),
                'home_page' => $request->home_page
            ]);
            if($data){
                $output = ['status' => 'success', 'message'=> 'Data Has Been Saved'];
            }else{
                $output = ['status' => 'error', 'message'=> 'Something Error'];
            }
           return response()->json($output);
        }

    }

    //Edit Cat Data
    public function edit(Request $request){
        if($request->ajax()){
            $data = category::findOrFail($request->data_id);
            return response()->json($data);
        }
    }

    //Update Cat Data
    public function update(categoryRequest $request){
        if($request->ajax()){
            $cat = category::findOrFail($request->update);

            if($request->hasFile('icon')){
                $image = $this->file_update($request->file('image'),'admin/category_icon/', $cat->image);
            }else{
                $image = $cat->icon;
            }

            $data = $cat->update([
                'icon' => $image,
                'category_name' => $request->category_name,
                'category_slug' => Str::slug($request->category_slug,'-'),
                'home_page' => $request->home_page
            ]);
            if($data){
                $output = ['status'=>'success', 'message'=>'Data Has Been Updated'];
            }else{
                $output = ['status'=>'error', 'message'=>'Data Updated Failed'];
            }
            return response()->json($output);
        }
        // if($request->ajax()){
        //     $cat = category::findOrFail($request->)
        // }
    }


    // Delete Cat Data
    public function delete(Request $request){
        if($request->ajax()){
            //dd($request->cat_data);
            $cat_id = category::find($request->data_id);
            $cat_id->delete();
            $output=['status'=>'success', 'message' => 'Data Had Been Deleted'];
            return response()->json($output);
        }

    }



}
