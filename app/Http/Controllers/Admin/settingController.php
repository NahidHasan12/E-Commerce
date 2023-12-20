<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use App\Models\Page;
use App\Models\Smtp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment_Getway;
use App\Models\Web_setting;
use Yajra\DataTables\Facades\DataTables;

class settingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //start seo setting method
    public function seo(){
        $seoData = Seo::first();
        return view('admin.setting.seo',['seoData'=>$seoData]);
    }
    public function seoUpdate(Request $request, $id){
        $seoData = Seo::find($id);

        if($seoData){
            $seoData->update($request->except('_token'));
            $message = array('message' => 'Seo Data Update Success', 'alert-type' => 'success');
        }else{
            $message = array('message' => 'Seo Update Not Update', 'alert-type' => 'error');
        }
        return redirect()->back()->with($message);
    }
    // end seo setting method

    //start smtp setting method
    public function smtp(){
        $smtpData = Smtp::first();
        return view('admin.setting.smtp',['smtpData'=>$smtpData]);
    }
    public function smtpUpdate(Request $request, $id){
        $smtpData = Smtp::find($id);

        if($smtpData){
            $smtpData->update($request->except('_token'));
            $message = array('message' => 'SMTP Data Update Success', 'alert-type' => 'success');
        }else{
            $message = array('message' => 'SMTP Update Not Update', 'alert-type' => 'error');
        }
        return redirect()->back()->with($message);
    }
    //end smtp setting method

    //start website setting method
    public function web_setting(){
        $web_setting = Web_setting::first();
        return view('admin.setting.website_setting',compact('web_setting'));
    }

    public function web_settingUpdate(Request $request, $id){
        //dd($request->logo);
        $web_Setting = Web_setting::findOrFail($id);


            if($request->hasFile('logo')){
                $logo = $this->file_update($request->file('logo'),'admin/logo_favicon/', $web_Setting->logo);
            }else{
                $logo = $web_Setting->logo;
            }

            if($request->hasFile('favicon')){
                $favicon = $this->file_update($request->file('favicon'),'admin/logo_favicon/',$web_Setting->favicon);
            }else{
                $favicon = $web_Setting->favicon;
            }

            $data = $web_Setting->update([
                'currency'     => $request->currency,
                'phone_one'    => $request->phone_one,
                'phone_two'    => $request->phone_two,
                'main_email'   => $request->main_email,
                'support_mail' => $request->support_mail,
                'logo'         => $logo,
                'favicon'      => $favicon,
                'address'      => $request->address,
                'facebook'     => $request->facebook,
                'twitter'      => $request->twitter,
                'linkedin'     => $request->linkedin,
                'youtube'      => $request->youtube
            ]);
            if ($data) {
                $message = array('message'=>'Data Update Success','alert-type'=>'success' );
            }else {
                $message = array('message'=>'Data Not Update','alert-type'=>'error' );
            }

            return redirect()->back()->with($message);
    }
    //end Website Setting methods

    // Start Website Setting methods
    public function pages(){
        return view('admin.setting.pages.index');
    }
    public function fatch_pages(Request $request){
        if ($request->ajax()) {

            $getData = Page::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action='
                <button  class="btn btn-sm btn-primary m-1 edit-btn" data-id="'.$data->id.'"  data-toggle="modal" data-target="#pageEditeModal"> <i class="fa fa-edit"></i> </button>
                <button  class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$data->id.'"> <i class="fa fa-trash"></i> </button>
                ';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);

        }
    }
    public function store_pages(Request $request){
        if($request->ajax()){
            $data = Page::create([
                'page_position' => $request->page_position,
                'page_name' => $request->page_name,
                'page_slug' => Str::slug($request->page_name,'-'),
                'page_title' => $request->page_title,
                'page_description' => $request->page_description,
            ]);
            if($data){
                $output = ['status' => 'success', 'message'=> 'Data Has Been Saved'];
            }else{
                $output = ['status' => 'error', 'message'=> 'Something Error'];
            }
           return response()->json($output);
        }

    }

    public function edit_pages(Request $request){
        if($request->ajax()){
            $data = Page::findOrFail($request->data_id);
            return response()->json($data);
        }
    }
    // select page position
    public function select_page_position(Request $request){
        if($request->ajax()){
            $pageData = Page::findOrFail($request->page_id);
            $line1 = $pageData->page_position == 1 ? 'selected' : '';
            $line2 = $pageData->page_position == 2 ? 'selected' : '';
            $output='';
            $output.='
            <label for="page_position" class="form-label">Page Position</label>
            <select name="page_position" class="form-control" id="page_position">
                <option value="1"'.$line1.'>Line One</option>
                <option value="2"'.$line2.'>Line Two</option>
            </select>
            ';
            return response()->json($output);
        }
    }
    // Pages Update code
    public function update_page(Request $request){
        if($request->ajax()){
            $page = Page::findOrFail($request->update);
            $data = $page->update([
                'page_position' => $request->page_position,
                'page_name' => $request->page_name,
                'page_slug' => Str::slug($request->page_name,'-'),
                'page_title' => $request->page_title,
                'page_description' => $request->page_description,
            ]);
            if($data){
                $output = ['status'=>'success', 'message'=>'Data Has Been Updated'];
            }else{
                $output = ['status'=>'error', 'message'=>'Data Updated Failed'];
            }
            return response()->json($output);
        }
    }
    // pages delete
    public function pages_delete(Request $request){
        if($request->ajax()){
            $brand = Page::findOrFail($request->brand_id);
            $brand->delete();
            $output=['status'=>'success','message'=>'data deleted successfully'];
            return response()->json($output);
        }
    }

    // Payment Gateway
    public function payment_gateway(){
        $aamarpay = Payment_Getway::first();
        $shurjopay = Payment_Getway::skip(1)->first();
        $ssl = Payment_Getway::skip(2)->first();
        return view('admin.setting.payment_gateway.edit', compact('aamarpay','shurjopay','ssl'));
    }

    // Aamarpay Update
    public function update_aamarpay(Request $request){
        $aamarpay_id = Payment_Getway::findOrFail($request->id);
        $aamarpay = $aamarpay_id->update([
            'store_id'      => $request->store_id,
            'signature_key' => $request->signature_key,
            'status'        => $request->status
        ]);
        $message = array('message'=>'Amarpay Payment gateway updated','alert-type'=>'success' );
        return redirect()->back()->with($message);
    }

    // Shurjopay Update
    public function update_shurjopay(Request $request){
        $shurjopay_id = Payment_Getway::findOrFail($request->id);
        $shurjopay = $shurjopay_id->update([
            'store_id'      => $request->store_id,
            'signature_key' => $request->signature_key,
            'status'        => $request->status
        ]);
        $message = array('message'=>'Shurjopay Payment gateway updated','alert-type'=>'success' );
        return redirect()->back()->with($message);
    }

}
