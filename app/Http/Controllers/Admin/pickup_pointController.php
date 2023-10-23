<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pickup_point;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class pickup_pointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.Offer.pickup_point.index');
    }
    public function getData(Request $request){
        if($request->ajax()){
            $getData = Pickup_point::latest('id');
            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action='
                <button class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$data->id.'"  data-toggle="modal" data-target="#pickup_point_edit"> <i class="fa fa-edit"></i> </button>
                <button class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$data->id.'"> <i class="fa fa-trash"></i> </button>
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
            $data = Pickup_point::create([
                'pickup_point_name' => $request->pickup_point_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'another_phone' => $request->another_phone
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
            $pickup = Pickup_point::findOrFail($request->pickup_id);
            return response()->json($pickup);
        }
    }
    public function update(Request $request){
        if($request->ajax()){
            $pickup = Pickup_point::findOrFail($request->update);
            $data = $pickup->update([
                'pickup_point_name' => $request->pickup_point_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'another_phone' => $request->another_phone
            ]);

            if($data){
                $output = ['status'=>'success', 'message'=>'Data has been Updated'];
            }else{
                $output =['status'=>'error', 'message'=>'Something Error'];
            }
            return response()->json($output);
        }
    }
    public function delete(Request $request){
        if($request->ajax()){
            $data= Pickup_point::findOrFail($request->data_id);
            $data->delete();
            $output=['status'=>'success','message'=>'Coupon Deleted'];
            return response()->json($output);
        }
    }
}
