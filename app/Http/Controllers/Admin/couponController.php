<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class couponController extends Controller
{
    public function index(){
        return view('admin.Offer.coupon.index');
    }

    public function fatch_coupon(Request $request){
        if($request->ajax()){
            $getData = Coupon::latest('id');
            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('status', function($coupon){
                if($coupon->status == 1) {
                    return '<span class=" badge badge-success"> Active </span>';
                } else {
                    return '<span class="badge badge-warning"> Inactive </span>';
                }
            })
            ->addColumn('type', function($coupon){
                if($coupon->type == 1) {
                    return '<span class=" badge badge-success"> Fixed </span>';
                } else {
                    return '<span class="badge badge-warning"> Percentage </span>';
                }
            })
            ->addColumn('action', function($coupon){
                $action='
                <button class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$coupon->id.'"  data-toggle="modal" data-target="#warehouse_edit"> <i class="fa fa-edit"></i> </button>
                <button class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$coupon->id.'"> <i class="fa fa-trash"></i> </button>
                ';
                return $action;
            })
            ->rawColumns(['action','status','type'])
            ->make(true);
        }
    }

    public function store(Request $request){
        //dd($request->all());
        if($request->ajax()){
            $data = Coupon::create([
                'coupon_code' => $request->coupon_code,
                'valid_date' => $request->valid_date,
                'type' => $request->type,
                'coupon_amount' => $request->coupon_amount,
                'status' => $request->status
            ]);
            if($data){
                $output = ['status' => 'success', 'message'=> 'Data Has Been Saved'];
            }else{
                $output = ['status' => 'error', 'message'=> 'Something Error'];
            }
           return response()->json($output);
        }
    }

    public function delete(Request $request){
        if($request->ajax()){
            $data= Coupon::findOrFail($request->data_id);
            $data->delete();
            $output=['status'=>'success','message'=>'Coupon Deleted'];
            return response()->json($output);
        }
    }
}
