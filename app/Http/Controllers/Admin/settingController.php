<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\Smtp;
use Illuminate\Http\Request;

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
        return view('admin.setting.website_setting');
    }
}
