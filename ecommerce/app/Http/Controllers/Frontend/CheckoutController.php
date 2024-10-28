<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invoice;

class CheckoutController extends Controller
{
    // checkout method 
    function Checkout()
    {
        if (Cart::count() == 0) {
            $notification = array('message' => 'At first you have to added product into cart!', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        } else {
            if (Auth::check()) {
                $shipping_details = DB::table('shippings')->where('user_id', auth()->id())->first();
                $cart_item = Cart::content();
                return view('frontend.checkout', compact('cart_item', 'shipping_details'));
            } else {
                $notification = array('message' => 'At first you have to login!', 'alert-type' => 'warning');
                return redirect()->back()->with($notification);
            }
        }
    }

    //coupon apply method
    function CouponApply(Request $request)
    {
        $check = DB::table('coupons')->where('coupon_code', $request->coupon)->first();

        if ($check) {
            if (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($check->date))) {
                Session::put('coupon', [
                    'name' => $check->coupon_code,
                    'discount' => $check->amount,
                    'after_discount_price' => Cart::subtotal() - $check->amount,
                ]);
                $notification = array('message' => 'Coupon Applied!', 'alert-type' => 'success');
                return redirect()->back()->with($notification);
            } else {
                $notification = array('message' => 'Expaired coupon code!', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = array('message' => 'Invalid coupon code! Try agin', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    //order placed method
    function OrderPlaced(Request $request)
    {
        if ($request->payment_type == "cash on delivery") {
            $order = array();
            $order['user_id'] = Auth::user()->id;
            $order['f_name'] = $request->f_name;
            $order['l_name'] = $request->l_name;
            $order['company'] = $request->company;
            $order['phone'] = $request->phone;
            $order['email'] = $request->email;
            $order['country'] = $request->country;
            $order['address'] = $request->address;
            $order['city'] = $request->city;
            $order['district'] = $request->district;
            $order['zip'] = $request->zip;
            $order['subtotal'] = Cart::subtotal();


            if (Session::has('coupon')) {
                $order['discount'] = Session::get('coupon')['discount'];
                $order['total'] = Session::get('coupon')['after_discount_price'];
                $order['coupon_code'] = Session::get('coupon')['name'];
            } else {
                $order['total'] = Cart::total();
            }

            $order['tax'] = 00;
            $order['shipping_charge'] = 00;
            $order['order_id'] = uniqid();;
            $order['status'] = 0;
            $order['date'] = date('d-m-y');
            $order['month'] = date('F');
            $order['year'] = date('Y');

            //insert data and get last data id
            $order_id = DB::table('orders')->insertGetId($order);

            //send invoice mail to customer
            Mail::to($request->email)->send(new Invoice($order));

            $content = Cart::content();

            $details = array();

            foreach ($content as $row) {
                $details['order_id'] = $order_id;
                $details['product_id'] = $row->id;
                $details['product_name'] = $row->name;
                $details['color'] = $row->options->color;
                $details['size'] = $row->options->color;
                $details['quantity'] = $row->qty;
                $details['single_price'] = $row->price;
                $details['subtotal_price'] = $row->price * $row->qty;

                DB::table('orders_details')->insert($details);
            }

            Cart::destroy();
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            $notification = array('message' => 'Successfully order placed', 'alert-type' => 'success');
            return redirect()->route('user.dashboard')->with($notification);
        } elseif ($request->payment_type == "mobile banking") {
            $tran_id = "test" . rand(1111111, 9999999); //unique transection id for every transection 

            $currency = "BDT"; //aamarPay support Two type of currency USD & BDT  
            if (Session::has('coupon')) {
                $payable_tk = Session::get('coupon')['after_discount_price'];
            } else {
                $payable_tk = Cart::subtotal();
            }
            $amount = $payable_tk;   //10 taka is the minimum amount for show card option in aamarPay payment gateway

            //For live Store Id & Signature Key please mail to support@aamarpay.com
            $store_id = "aamarpaytest";

            $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";

            $url = "https://​sandbox​.aamarpay.com/jsonpost.php"; // for Live Transection use "https://secure.aamarpay.com/jsonpost.php"

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
                CURLOPT_POSTFIELDS => '{
                "store_id": "' . $store_id . '",
                "tran_id": "' . $tran_id . '",
                "success_url": "' . route('success') . '",
                "fail_url": "' . route('fail') . '",
                "cancel_url": "' . route('cancel') . '",
                "amount": "' . $amount . '",
                "currency": "' . $currency . '",
                "signature_key": "' . $signature_key . '",
                "desc": "Merchant Registration Payment",
                "cus_name": "' . $request->f_name . '",
                "cus_email": "' . $request->email . '",
                "cus_add1": "' . $request->address . '",
                "cus_city": "' . $request->city . '",
                "cus_country": "' . $request->country . '",
                "cus_phone": "' . $request->number . '",
                "opt_a": "' . $request->company . '",
                "opt_b": "' . $request->l_name . '",
                "opt_c": "' . $request->district . '",
                "opt_d": "' . $request->payment_type . '",
                "opt_e": "' . $request->zip . '",
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

            if (isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

                $paymentUrl = $responseObj->payment_url;
                // dd($paymentUrl);
                return redirect()->away($paymentUrl);
            } else {
                echo $response;
            }
        } else {
            $notification = array('message' => 'Please select a payment type', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }
    }

    public function success(Request $request)
    {
        $request_id = $request->mer_txnid;

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
        $data = json_decode($response, true);


        $order = array();
        $order['user_id'] = Auth::user()->id;
        $order['f_name'] = $request->cus_name;
        $order['l_name'] = $request->opt_b;
        $order['company'] = $request->opt_a;
        $order['phone'] = $request->cus_phone;
        $order['email'] = $request->cus_email;
        $order['country'] = $data['cus_country'];
        $order['address'] = $data['cus_add1'];
        $order['city'] = $data['cus_city'];
        $order['district'] = $request->opt_c;
        $order['zip'] = $request->opt_e;
        $order['subtotal'] = Cart::subtotal();

        if (Session::has('coupon')) {
            $order['coupon_code'] = Session::get('coupon')['name'];
            $order['discount'] = Session::get('coupon')['discount'];
            $order['total'] = Session::get('coupon')['after_discount'];
        } else {
            $order['total'] = Cart::subtotal();
        }

        $order['tax'] = 0;
        $order['payment_type'] = $request->opt_d;
        $order['shipping_charge'] = 0;
        $order['order_id'] = uniqid();
        $order['status'] = 1;
        $order['date'] = date('d-m-y');
        $order['month'] = date('F');
        $order['year'] = date('Y');

        $order_id = DB::table('orders')->insertGetId($order);

        //send invoice mail to customer
        Mail::to($request->cus_email)->send(new Invoice($order));

        $content = Cart::content();
        $details = array();

        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['single_price'] = $row->price;
            $details['subtotal_price'] = $row->price * $row->qty;

            DB::table('orders_details')->insert($details);
        }

        Cart::destroy();

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }



        $notification = array('message' => 'Successfully order placed', 'alert-type' => 'success');
        return redirect()->route('user.dashboard')->with($notification);
    }


    public function fail(Request $request)
    {
        return $request;
    }
}
