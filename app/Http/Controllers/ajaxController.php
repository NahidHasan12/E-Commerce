<?php

namespace App\Http\Controllers;

use App\Http\Requests\ajaxCurdRequest;
use App\Models\AjaxForm;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ajaxController extends Controller
{

    public function ajaxRequest(Request $request){

        //dd($request->para_text);
        $data = "Nahid Hasan";
        $data2 = "Shamoli Akter";
        return response()->json(['data'=>$data, 'data2'=>$data2]);

    }

 //============={Ajax Curd Start}===============//
//=============================================//
    // Student Data Insert
    public function Store(ajaxCurdRequest $request){
        //dd($request->all());
        $profile = $this->file_upload($request->file('avater'),'ajax/img/');
        $data = AjaxForm::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'roll'=>$request->roll,
            'reg'=>$request->reg,
            'board'=>$request->board,
            'session'=>$request->session,
            'avater'=>$profile
        ]);

        if($data){
            $output = ['status'=>'success', 'message'=>'Data has been Saved'];
        }else{
            $output =['status'=>'error', 'message'=>'Something Error'];
        }
        return response()->json($output);
    }

    //Student Data Fatch
    public function getData(Request $request){
        if ($request->ajax()) {

            $getData = AjaxForm::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()

            ->addColumn('avater', function($data) {
                $image = '<img width="60" height="50" src="' . asset('ajax/img/'.$data->avater).'">';
                return $image;
            })

            ->addColumn('action', function($data) {
                $action = '
                <button type="submit" class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$data->id.'"> <i class="fa fa-pencil-square-o"></i> </button>
                <button type="submit" class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$data->id.'"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                ';
                return $action;
            })

            ->rawColumns(['avater','action'])
            ->make(true);


        }
    }

    // Student data Edit
    public function editData(Request $request){
        if($request->ajax()){
            $student = AjaxForm::findOrFail($request->student_id);
            return response()->json($student);
        }
    }

    public function selectBoard(Request $request){
        if($request->ajax()){
            $student = AjaxForm::findOrFail($request->student_id);


            // dd($student->all());
            $dhaka = $student->board == 'dhaka' ? 'selected' : '';
            $rajshahi = $student->board == 'rajshahi' ? 'selected' : '';
            $rangpur = $student->board == 'rangpur' ? 'selected' : '';
            //dd($rajshahi);
            $output = '';
            $output .='
            <label for="board" class="form-label">Board</label>
            <select name="board" class="form-control form-control-sm">
                <option value="">Select Please</option>
                <option value="dhaka" '.$dhaka.'>Dhaka</option>
                <option value="rajshahi" '.$rajshahi.'>Rajshahi</option>
                <option value="rangpur" '.$rangpur.'>Rangpur</option>
            </select>
            ';
            return response()->json($output);
        }
    }

    public function updateData(ajaxCurdRequest $request){
        if($request->ajax()){
            $student = AjaxForm::findOrFail($request->update);
            if($request->hasFile('avater')){
                $profile = $this->file_update($request->file('avater'),'ajax/img/', $student->avater);
            }else{
                $profile = $student->avater;
            }

            $data = $student->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'roll'=>$request->roll,
                'reg'=>$request->reg,
                'board'=>$request->board,
                'session'=>$request->session,
                'avater'=>$profile
            ]);

            if($data){
                $output = ['status'=>'success', 'message'=>'Data has been Updated'];
            }else{
                $output =['status'=>'error', 'message'=>'Something Error'];
            }
            return response()->json($output);
        }
    }


    // Student Data Delete
    public function deleteData(Request $request){
        if($request->ajax()){
            $student = AjaxForm::findOrFail($request->student_id);
            if(file_exists('../ajax/img/'.$student->avater)){
                unlink('../ajax/img/'.$student->avater);
            }
            $student->delete();
            $output=['status'=>'success','message'=>'data deleted successfully'];
            return response()->json($output);
        }
    }
}
