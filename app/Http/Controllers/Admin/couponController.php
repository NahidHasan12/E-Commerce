<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class couponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
                <button class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$coupon->id.'"  data-toggle="modal" data-target="#coupon_edit"> <i class="fa fa-edit"></i> </button>
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

    public function edit(Request $request){
        if($request->ajax()){
            $coupon = Coupon::findOrFail($request->coupon_id);
            return response()->json($coupon);
        }
    }

    public function selectType(Request $request){
        if($request->ajax()){
            $type = Coupon::findOrFail($request->type);
            $fixed = $type->type == 1 ? 'selected' : '';
            $percentage = $type->type == 2 ? 'selected' : '';
            $output='';
            $output.='
                <label for="type" class="form-label">Coupon Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="1" '.$fixed.'>Fixed</option>
                    <option value="2" '.$percentage.'>Percentage</option>
                </select>
            ';
            return response()->json($output);
        }
    }
    public function selectStatus(Request $request){
        if($request->ajax()){
            $status = Coupon::findOrFail($request->status);
            $pending = $status->status == 0 ? 'selected' : '';
            $active = $status->status == 1 ? 'selected' : '';
            $output='';
            $output.='
                <label for="status" class="form-label">Coupon Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="0" '.$pending.'>Pending</option>
                    <option value="1" '.$active.'>Active</option>
                </select>
            ';
            return response()->json($output);
        }
    }

    public function update(Request $request){
        if($request->ajax()){
            $coupon = Coupon::findOrFail($request->update);
            $data = $coupon->update([
                'coupon_code' => $request->coupon_code,
                'valid_date' => $request->valid_date,
                'type' => $request->type,
                'coupon_amount' => $request->coupon_amount,
                'status' => $request->status
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
            $data= Coupon::findOrFail($request->data_id);
            $data->delete();
            $output=['status'=>'success','message'=>'Coupon Deleted'];
            return response()->json($output);
        }
    }
}
