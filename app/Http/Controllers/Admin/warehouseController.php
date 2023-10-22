<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class warehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.warehouse.index');
    }

    public function fatch_warehouse(Request $request){
        if($request->ajax()){
            $getData = warehouse::latest('id');
            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('action', function($getData){
                $action='
                <button class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$getData->id.'"  data-toggle="modal" data-target="#warehouse_edit"> <i class="fa fa-edit"></i> </button>
                <button class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$getData->id.'"> <i class="fa fa-trash"></i> </button>
                ';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function store(Request $request){
        //dd($request->all());
        if($request->ajax()){
            $data = warehouse::create([
                'warehouse_name' => $request->warehouse_name,
                'warehouse_address' => $request->warehouse_address,
                'warehouse_phone' => $request->warehouse_phone
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
            $data = warehouse::findOrFail($request->data_id);
            return response()->json($data);
        }
    }

    public function update(Request $request){
        if($request->ajax()){
            $warehouse = warehouse::findOrFail($request->update);
            $data = $warehouse->update([
                'warehouse_name' => $request->warehouse_name,
                'warehouse_address' => $request->warehouse_address,
                'warehouse_phone' => $request->warehouse_phone
            ]);

            if($data){
                $output=['status'=>'success','message'=>'Warehouse Updateed'];
            }else{
                $output=['status'=>'error','message'=>'Warehouse do not Updateed, Something wrong'];

            }
            return response()->json($output);
        }
    }

    public function delete(Request $request){
        if($request->ajax()){
            $data= warehouse::findOrFail($request->data_id);
            $data->delete();
            $output=['status'=>'success','message'=>'Warehouse Deleted'];
            return response()->json($output);
        }
    }
}
