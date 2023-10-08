<?php

namespace App\Http\Controllers\Admin;

use App\Models\category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\subcategoryRequest;

class subCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $subcategory = SubCategory::get();
        $category = category::all();
        return view('admin.category.sub_cat.index', compact('subcategory','category'));
    }

    public function getData(Request $request){
        if($request->ajax()){
            $getData = SubCategory::latest('id');
            return DataTables::eloquent($getData)
            ->addIndexColumn()

            ->addColumn('category_id', function($subcategory){
                return $subcategory->category->category_name;
            })
            ->addColumn('action', function($subcategory){
                $action = '
                <button  class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$subcategory->id.'"  data-toggle="modal" data-target="#subCategoryEdit"> <i class="fa fa-edit"></i> </button>
                <button  class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$subcategory->id.'"> <i class="fa fa-trash"></i> </button>
                ';
                return $action;
            })

            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function store(subcategoryRequest $request){
        if($request->ajax()){
            $data = SubCategory::create([
                'subcategory_name' => $request->sub_cat_name,
                'subcategory_slug' => Str::slug($request->sub_cat_slug),
                'category_id' => $request->category_id
            ]);
            if($data){
                $output = ['status' => 'success', 'message'=> 'Data Has Been Saved'];
            }else{
                $output = ['status' => 'error', 'message'=> 'Something Error'];
            }
           return response()->json($output);
        }

    }

    public function edit(Request $request){
        if($request->ajax()){
            $data = SubCategory::findOrFail($request->data_id);
            return response()->json($data);
        }
    }

    public function selectCategory(Request $request){
        if ($request->ajax()) {
            $subcat_id = SubCategory::findOrFail($request->subcat_id);
            $cat = category::latest('id')->get();

            $output = '<label for="category_id" class="form-label">Category Select</label>
            <select name="category_id" class="form-control" id="category_id">
            <option value="">--select Please--</option>';

            foreach ($cat as $key => $data) {
                $selected = ($data->id == $subcat_id->category_id) ? 'selected' : '';

                $output .= '<option value="' . $data->id . '" ' . $selected . '>' . $data->category_name . '</option>';
            }

            $output .= '</select>';


            return response()->json($output);
        }

    }

    public function update(subcategoryRequest $request){
        if($request->ajax()){
            $cat = SubCategory::findOrFail($request->update);
            $data = $cat->update([
                'subcategory_name' => $request->sub_cat_name,
                'subcategory_slug' => Str::slug($request->sub_cat_slug),
                'category_id' => $request->category_id
            ]);
            if($data){
                $output = ['status'=>'success', 'message'=>'Data Has Been Updated'];
            }else{
                $output = ['status'=>'error', 'message'=>'Data Updated Failed'];
            }
            return response()->json($output);
        }
    }



    public function delete(Request $request){
        if($request->ajax()){
            //dd($request->cat_data);
            $cat_id = SubCategory::find($request->data_id);
            $cat_id->delete();
            $output=['status'=>'success', 'message' => 'Data Has Been Deleted'];
            return response()->json($output);
        }

    }

}
