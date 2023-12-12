<?php

namespace App\Http\Controllers\Website;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Payment_Getway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class checkoutController extends Controller
{
    public function checkout(){
        if(!Auth::check()){
            $message = array('message'=>'Login your account first', 'alert-type'=>'error');
            return redirect()->back()->with($message);
        }else{
            $cart_content = Cart::content();
            return view('frontend.cart.checkout', compact('cart_content'));
        }

    }

    // Coupon Apply
    public function apply_coupon(Request $request){
        $coupon_code_check = Coupon::where('coupon_code', $request->cupon_apply)->first();
        if($coupon_code_check){

            if(date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($coupon_code_check->valid_date))){

                Session::put('coupon',[
                    'name' => $coupon_code_check->coupon_code,
                    'discount' => $coupon_code_check->coupon_amount,
                    'main_balance' => Cart::subtotal() - $coupon_code_check->coupon_amount,
                ]);

                $message = array('message'=>'Coupon Applied, Try Again', 'alert-type'=>'success');
                return redirect()->back()->with($message);

            }else{
                $message = array('message'=>'Expired Coupon Code, Try Again', 'alert-type'=>'error');
                return redirect()->back()->with($message);
            }

        }else{
            $message = array('message'=>'Invalid Coupon Code, Try Again', 'alert-type'=>'error');
            return redirect()->back()->with($message);
        }
    }

    // Remove coupon
    public function remove_coupon(){
        Session::forget('coupon');
        $message = array('message'=>'Coupon Removed', 'alert-type'=>'success');
        return redirect()->back()->with($message);
    }

    //Order Place
    Public function order_place(Request $request){
        if($request->payment_type == "Hand Cash"){
            $data = [
                'user_id' => Auth::id(),
                'order_id' => rand(10000,90000),
                'c_name' => $request->c_name,
                'c_phone' => $request->c_phone,
                'c_country' => $request->c_country,
                'c_city' => $request->c_city,
                'c_address' => $request->c_address,
                'c_email' => $request->c_email,
                'c_zipCode' => $request->c_zipCode,
                'date' => date('d-m-y'),
                'payment_type' => $request->payment_type,
                'tax' => 0,
                'shipping_charge' => 0,
                'status' => 0
            ];

            if(Session::has('coupon')){
                $data['subtotal'] = Cart::subtotal();
                $data['total'] = Cart::total();
                $data['coupon_code'] = Session::get('coupon')['name'];
                $data['coupon_discount'] = Session::get('coupon')['discount'];
                $data['main_balance'] = Session::get('coupon')['main_balance'];
                $data['tax'] = 0;
                $data['shipping_charge'] = 0;
                $data['status'] = 0;
            }else{
                $data['subtotal'] = Cart::subtotal();
                $data['total'] = Cart::total();
            }
            // dd($data);

            $order_id = Order::create($data)->id;
            // Send mail to order placed gmail
            Mail::to($request->c_email)->send(new InvoiceMail($data));

            // Order Details
            $cart_content = Cart::content();
            $details = array();

            foreach($cart_content as $item){
                $details['order_id'] = $order_id;
                $details['product_id'] = $item->id;
                $details['product_name'] = $item->name;
                $details['color'] = $item->options->color;
                $details['size'] = $item->options->size;
                $details['quantity'] = $item->qty;
                $details['single_price'] = $item->price;
                $details['subtotal_price'] = $item->price*$item->qty;
                OrderDetail::create($details);
            }
            Cart::destroy();
            if(Session::has('coupon')){
                Session::forget('coupon');
            }
            $message = array('message'=>'Successfully Order Placed', 'alert-type'=>'success');
            return redirect()->back()->with($message);

        // Aamarpay Payment Gateway
        }elseif($request->payment_type == "amarpay"){

            $amarpay = Payment_Getway::first();
            if($amarpay->store_id == null){
                $message = array('message'=>'Please Setting your payment gateway', 'alert-type'=>'error');
                return redirect()->back()->with($message);
            }else{
                if($amarpay->status == 1){
                    $url = "https://secure.aamarpay.com/jsonpost.php"; // for live
                }else{
                    $url = "https://​sandbox​.aamarpay.com/jsonpost.php";
                }
                $tran_id = "test".rand(1111111,9999999);//unique transection id for every transection

                $currency= "BDT"; //aamarPay support Two type of currency USD & BDT

                $amount = "10";   //10 taka is the minimum amount for show card option in aamarPay payment gateway

                //For live Store Id & Signature Key please mail to support@aamarpay.com
                $store_id = $amarpay->store_id;

                $signature_key = $amarpay->signature_key;


                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "store_id": "'.$store_id.'",
                    "tran_id": "'.$tran_id.'",
                    "success_url": "'.route('success').'",
                    "fail_url": "'.route('fail').'",
                    "cancel_url": "'.route('cancel').'",
                    "amount": "'.$amount.'",
                    "currency": "'.$currency.'",
                    "signature_key": "'.$signature_key.'",
                    "desc": "Merchant Registration Payment",
                    "cus_name": "Name",
                    "cus_email": "payer@merchantcusomter.com",
                    "cus_add1": "House B-158 Road 22",
                    "cus_add2": "Mohakhali DOHS",
                    "cus_city": "Dhaka",
                    "cus_state": "Dhaka",
                    "cus_postcode": "1206",
                    "cus_country": "Bangladesh",
                    "cus_phone": "+8801704",
                    "type": "json"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                // dd($response);

                $responseObj = json_decode($response);

                if(isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

                    $paymentUrl = $responseObj->payment_url;
                    // dd($paymentUrl);
                    return redirect()->away($paymentUrl);

                }else{
                    echo $response;
                }
            }
        }
    }



    //==========Aamarpay Extra Methods============//
   //--------------------------------------------//
    public function success(Request $request){

        $request_id= $request->mer_txnid;

        //verify the transection using Search Transection API

        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=aamarpaytest&signature_key=dbb74894e82415a2f7ff0ec3a97e4183&type=json";

        //For Live Transection Use "http://secure.aamarpay.com/api/v1/trxcheck/request.php"

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function fail(Request $request){
        return $request;
    }

    public function cancel(){
        return 'Canceled';
    }
}
