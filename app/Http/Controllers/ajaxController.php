<?php

namespace App\Http\Controllers;

use App\Models\AjaxForm;
use Illuminate\Http\Request;

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
    public function Store(Request $request){
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
        if($request->ajax()){
            $get_data = AjaxForm::latest('id')->get();
            $code = '';
            foreach($get_data as $key=>$student){
                $serial = $key+1;
                $code .='
                <tr>
                    <td>'.$serial.'</td>
                    <td><img src="../ajax/img/'.$student->avater.'" alt="'.$student->name.'" width="60px" height="50px"></td>
                    <td>'.$student->name.'</td>
                    <td>'.$student->email.'</td>
                    <td>'.$student->phone.'</td>
                    <td>'.$student->roll.'</td>
                    <td>'.$student->reg.'</td>
                    <td>'.$student->board.'</td>
                    <td>'.$student->session.'</td>
                    <td>
                        <button type="submit" class="btn btn-sm btn-primary edit-btn" data-id="'.$student->id.'"> <i class="fa fa-pencil-square-o"></i> </button>
                        <button type="submit" class="btn btn-sm btn-danger delete-btn" data-id="'.$student->id.'"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                    </td>
                </tr>
                ';
            }
            return response()->json($code);

        }else{
            $output = ['status'=>'error', 'message'=>'Something Error!'];
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
