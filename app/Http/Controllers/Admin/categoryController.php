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
            ->addColumn('icon', function($data) {
                $icon = '<img width="100" height="30" src="' . ($data->icon != null ? asset('admin/category_icon/'.$data->icon) : 'https://via.placeholder.com/80') . '">';
                return $icon;
            })
            ->addColumn('home_page', function($data) {
                if ($data->home_page ==1) {
                    return '<span class="badge badge-success"> YES </span>';
                }else {
                    return '<span class="badge badge-danger"> No </span>';
                }
            })
            ->addColumn('action', function($data){
                $action='
                <button  class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$data->id.'"  data-toggle="modal" data-target="#catEditModal"> <i class="fa fa-edit"></i> </button>
                <button  class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$data->id.'"> <i class="fa fa-trash"></i> </button>
                ';
                return $action;
            })
            ->rawColumns(['action','icon','home_page'])
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

    // Select Home Page Status
    public function select_home(Request $request){
        if($request->ajax()){
            $home_page = category::findOrFail($request->cat_id);
            // dd($student->all());
            $yes = $home_page->home_page == 1 ? 'selected' : '';
            $no = $home_page->home_page == 0 ? 'selected' : '';
            $output = '';
            $output .='
                <label for="home_page" class="form-label">Category Show Home Page</label>
                <select name="home_page" id="home_page" class="form-control">
                    <option value="1" '.$yes.'>YES</option>
                    <option value="0" '.$no.'>NO</option>
                </select>
            ';
            return response()->json($output);
        }
    }

    //Update Cat Data
    public function update(categoryRequest $request){
        if($request->ajax()){
            $cat = category::findOrFail($request->update);

            if($request->hasFile('icon')){
                $icon = $this->file_update($request->file('icon'),'admin/category_icon/', $cat->icon);
            }else{
                $icon = $cat->icon;
            }

            $data = $cat->update([
                'icon' => $icon,
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
