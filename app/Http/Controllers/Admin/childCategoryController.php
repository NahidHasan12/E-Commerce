<?php

namespace App\Http\Controllers\Admin;

use App\Models\category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Childcategory;
use PhpParser\Node\Stmt\Foreach_;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\childcategoryRequest;

class childCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $category = category::latest('id')->get();
        $sub_cat = SubCategory::latest('id')->get();
        return view('admin.category.child_cat.index',compact('category','sub_cat'));
    }

    // public function getData(Request $request){
    //     if($request->ajax()){
    //         $getData = Childcategory::findOrFail('id');
    //         return DataTables::eloquent($getData)
    //         ->addIndexColumn()
    //         ->addColumn('action', function($childCat){
    //             $action = '
    //             <button  class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$childCat->id.'"  data-toggle="modal" data-target="#subCategoryEdit"> <i class="fa fa-edit"></i> </button>
    //             <button  class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$childCat->id.'"> <i class="fa fa-trash"></i> </button>
    //             ';
    //             return $action;
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    //     }
    // }

    public function fatchData(Request $request){
        if($request->ajax()){
            $get_data = Childcategory::latest('id')->get();

            $code = '';
            foreach($get_data as $key=>$data){
                $serial = $key+1;
                $code.='
                <tr>
                    <td>'.$serial.'</td>
                    <td>'.$data->childcategory_name.'</td>
                    <td>'.$data->childcategory_slug.'</td>
                    <td>'.$data->category->category_name.'</td>
                    <td>'.$data->SubCategory->subcategory_name.'</td>
                    <td class="d-flex">
                        <button type="submit" class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$data->id.'"  data-toggle="modal" data-target="#childCategoryEdit"> <i class="fa fa-pencil-square-o"></i> </button>
                        <button type="submit" class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$data->id.'"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                    </td>
                </tr>
                ';
            }
            return response()->json($code);
        }
    }

    // Category wise Sub category Select
    public function getSubCat($cat_id){
       $sub_cat = SubCategory::where('category_id',$cat_id)->get();
       return response()->json($sub_cat);
    }

    public function store(childcategoryRequest $request){
        if($request->ajax()){
            $data = Childcategory::create([
                'childcategory_name'=>$request->child_cat_name,
                'childcategory_slug'=>Str::slug($request->child_cat_slug,'-'),
                'category_id'=>$request->category_id,
                'subcategory_id'=>$request->subcategory_id
            ]);
            if($data){
                $output = ['status'=>'success', 'message'=>'Child Category Saved'];
            }else{
                $output = ['status'=>'error', 'message'=>'Child Category can not Saved, Something Error'];
            }
            return response()->json($output);
        }
    }

    public function edit(Request $request){
        if($request->ajax()){
            $child_cat = Childcategory::findOrFail($request->data_id);
            return response()->json($child_cat);
        }
    }

    public function update(Request $request){
        if($request->ajax()){
            $child_cat = Childcategory::findOrFail($request->update);
            // $request->validate([
            //     'childcategory_name' => 'required',
            //     'childcategory_slug' => 'required',
            //     'subcategory_id' => 'nullable'
            // ]);
            $child_cat->update([
                'childcategory_name'=>$request->child_cat_name,
                'childcategory_slug'=>Str::slug($request->child_cat_slug,'-'),
                'subcategory_id'=>$request->subcategory_id
            ]);

            if($child_cat){
                $output = ['status'=>'success', 'message'=>'Child Category Updated'];
            }else{
                $output = ['status'=>'success', 'message'=>'Child Category Updated Faild'];
            }
            return response()->json($output);
        }
    }

    public function delete(Request $request){
        if($request->ajax()){
            //dd($request->cat_data);
            $child_cat = Childcategory::find($request->data_id);
            $child_cat->delete();
            $output=['status'=>'success', 'message' => 'Data Has Been Deleted'];
            return response()->json($output);
        }

    }
}
