<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\Customer_review;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class customer_reviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   

    // review for website
    public function write_review(){
        return view('frontend.user.write_review');
    }

    public function website_review_store(Request $request){
        $request->validate([
            'name' => 'required',
            'review' => 'required',
            'rating' => 'required'
        ]);
        $check_review = Customer_review::where('user_id',Auth::id())->first();
        if($check_review){
           $message = array('message'=>'Already exist your review', 'alert-type'=>'success');
           return redirect()->back()->with($message);
        }else{
            $customer = Customer_review::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'review' => $request->review,
                'rating' => $request->rating,
                'status' => $request->status
            ]);
            $message = array('message'=>'Review has been saved', 'alert-type'=>'success');
            return redirect()->back()->with($message);
        }
    }
}
