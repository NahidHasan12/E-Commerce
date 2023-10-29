<?php

namespace App\Http\Controllers\Admin;

use App\Models\campaing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class campaingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.Offer.campaing.index');
    }

    public function getData(Request $request){
        if ($request->ajax()) {

            $getData = campaing::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('image', function($campaign) {
                $image = '<img width="100" height="30" src="' . ($campaign->image != null ? asset('admin/campaing_img/'.$campaign->image) : 'https://via.placeholder.com/80') . '">';
                return $image;
            })
            ->addColumn('status', function($campaign) {
                if ($campaign->status ==1) {
                    return '<span class="badge badge-success"> Active </span>';
                }else {
                    return '<span class="badge badge-warning"> Inactive </span>';
                }
            })
            ->addColumn('action', function($campaign){
                $action='
                <button  class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$campaign->id.'"  data-toggle="modal" data-target="#campaing_edit"> <i class="fa fa-edit"></i> </button>
                <button  class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$campaign->id.'"> <i class="fa fa-trash"></i> </button>
                ';
                return $action;
            })
            ->rawColumns(['action','image','status'])
            ->make(true);

        }
    }

    public function Store(Request $request){
        //dd($request->all());
        if($request->ajax()){
            $image = $this->file_upload($request->file('image'),'admin/campaing_img/');
            $data = campaing::create([
                'title'      => $request->title,
                'start_date' => $request->start_date,
                'end_date'   => $request->end_date,
                'status'     => $request->status,
                'discount'   => $request->discount,
                'image'      => $image,
                'month'      => date('F'),
                'year'       => date('Y'),
            ]);

            if($data){
                $output = ['status'=>'success', 'message'=>'Campaing Data has been Saved'];
            }else{
                $output =['status'=>'error', 'message'=>'Something Error'];
            }
            return response()->json($output);
        }

    }

    public function edit(Request $request){
        if($request->ajax()){
            $student = campaing::findOrFail($request->data_id);
            return response()->json($student);
        }
    }

    public function select_campaingStatus(Request $request){
        if($request->ajax()){
            $campaing = campaing::findOrFail($request->campaing_id);
            // dd($student->all());
            $active = $campaing->status == 1 ? 'selected' : '';
            $inactive = $campaing->status == 0 ? 'selected' : '';
            $output = '';
            $output .='
                <label for="status"> Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1"'.$active.'>Active</option>
                    <option value="0"'.$inactive.'>Inactive</option>
                </select>
            ';
            return response()->json($output);
        }
    }

    public function update(Request $request){
        if($request->ajax()){
            $campaing = campaing::findOrFail($request->update);
            if($request->hasFile('image')){
                $image = $this->file_update($request->file('image'),'admin/campaing_img/', $campaing->image);
            }else{
                $image = $campaing->image;
            }

            $data = $campaing->update([
                'title'      => $request->title,
                'start_date' => $request->start_date,
                'end_date'   => $request->end_date,
                'status'     => $request->status,
                'discount'   => $request->discount,
                'image'      => $image,
            ]);

            if($data){
                $output = ['status'=>'success', 'message'=>'Campaing Data has been Updated'];
            }else{
                $output =['status'=>'error', 'message'=>'Something Error'];
            }
            return response()->json($output);
        }
    }

    public function delete(Request $request){
        if($request->ajax()){
            $campaing = campaing::findOrFail($request->campaing_id);
            if(file_exists('admin/campaing_img/'.$campaing->image)){
                unlink('admin/campaing_img/'.$campaing->image);
            }
            $campaing->delete();
            $output=['status'=>'success','message'=>'data deleted successfully'];
            return response()->json($output);
        }
    }

}
