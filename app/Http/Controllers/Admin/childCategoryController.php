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
        $subCategory = SubCategory::latest('id')->get();
        return view('admin.category.child_cat.index',compact('category','subCategory'));
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
                    <td>'.$data->category_id.'</td>
                    <td>'.$data->subcategory_id.'</td>
                    <td class="d-flex">
                        <button type="submit" class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$data->id.'"> <i class="fa fa-pencil-square-o"></i> </button>
                        <button type="submit" class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$data->id.'"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                    </td>
                </tr>
                ';
            }
            return response()->json($code);
        }
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
}
