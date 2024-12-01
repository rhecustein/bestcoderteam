<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Setting;
use App\Models\StripePayment;
use App\Models\PaypalPayment;
use App\Mail\OrderSuccessfully;
use App\Helpers\MailHelper;
use App\Models\EmailTemplate;
use App\Models\RazorpayPayment;
use App\Models\Flutterwave;
use App\Models\PaystackAndMollie;
use App\Models\InstamojoPayment;
use App\Models\PaymongoPayment;
use App\Models\BankPayment;


use Mail;
Use Stripe;
use Cart;
use Session;
use Str;
use Razorpay\Api\Api;
use Exception;
use Redirect;

use Mollie\Laravel\Facades\Mollie;


use App\Models\BreadcrumbImage;
use App\Models\Service;
use App\Models\AdditionalService;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\AppointmentSchedule;
use Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('webview_schedule_not_available','webview_payment_faild','webview_payment_success','mollie_payment_success','instamojo_response');
    }

    public function ready_to_booking($slug){
        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
        $service = Service::with('category','provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        if(!$service){
            return response()->json(['message' => trans('user.Service Not Found')],403);
        }

        $what_you_will_get = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_get [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $additional_services = AdditionalService::where('service_id', $service->id)->get();

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);

        return response()->json([
            'breadcrumb' => $breadcrumb,
            'service' => $service,
            'package_features' => $package_features,
            'benifits' => $benifits,
            'additional_services' => $additional_services,
            'currency_icon' => $currency_icon,
            'what_you_will_get' => $what_you_will_get
        ]);
    }

    public function get_available_schedule(Request $request){
        $rules = [
            'date'=>'required',
            'provider_id'=>'required'
        ];

        $this->validate($request, $rules);

        $day = date('l',strtotime($request->date));
        $appointment_schedules = AppointmentSchedule::where(['user_id' => $request->provider_id, 'day' => $day])->get();

        $available_schedule_arr = array();
        foreach($appointment_schedules as $appointment_schedule){
            $exist = Order::where(['provider_id' => $request->provider_id, 'appointment_schedule_id' => $appointment_schedule->id, 'booking_date' => $request->date])->count();
            if($exist == 0){
                $available_schedule_arr[] = $appointment_schedule->id;
            }
        }

        $available_schedules = AppointmentSchedule::whereIn('id', $available_schedule_arr)->orderBy('start_time','asc')->select('id','start_time','end_time')->get();

        $is_available = $available_schedules->count() > 0 ? true : false;

        return response()->json(['is_available' => $is_available, 'available_schedules' => $available_schedules]);
    }


    public function booking_information(Request $request, $slug){
        $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
        $service = Service::with('category','provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $service = Service::with('category','provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        if(!$service){
            return response()->json(['message' => trans('user.Service Not Found')],403);
        }

        $what_you_will_get = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_get [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);



        return response()->json([
            'breadcrumb' => $breadcrumb,
            'service' => $service,
            'package_features' => $package_features,
            'benifits' => $benifits,
            'what_you_will_get' => $what_you_will_get,
            'currency_icon' => $currency_icon,
        ]);
    }


    public function payment(Request $request ,$slug){
        $rules = [
            'extra_service_price'=>'required'
        ];

        $this->validate($request, $rules);

        $user = Auth::guard('api')->user();
        if($user->is_provider == 1){
            $notification = trans('user_validation.You are log-in as a provider, you can not book any service');
            return response()->json(['message' => $notification], 403);
        }



        if(Session::has('return_from_mollie')){
            $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
            $service = Service::with('category','provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

            if(!$service){
                abort(404);
            }

            $what_you_will_get = array();
            if($service->what_you_will_provide){
                $provides = json_decode($service->what_you_will_provide);
                foreach($provides as $provide){
                    $what_you_will_get [] = $provide;
                }
            }

            $benifits = array();
            if($service->benifit){
                $exist_benifits = json_decode($service->benifit);
                foreach($exist_benifits as $exist_benifit){
                    $benifits [] = $exist_benifit;
                }
            }

            $package_features = array();
            if($service->package_features){
                $features = json_decode($service->package_features);
                foreach($features as $feature){
                    $package_features [] = $feature;
                }
            }

            $setting = Setting::first();
            $currency_icon = (object) array('icon' => $setting->currency_icon);

            $order_info = Session::get('order_info');
            $customer = $order_info->customer;

            $extras = $order_info->extras;
            $extra_services = json_decode($extras);

            $extra_price = 0;
            if($extra_services->ids){
                foreach($extra_services->ids as $index => $extra_service){
                    $addition = AdditionalService::find($extra_services->ids[$index]);
                    $extra_price += ($extra_services->quantities[$index] * $addition->price);
                }
            }


            $total_price = $service->price + $extra_price;
            $total_price = round($total_price,2);

            $order_info = (object) array(
                'customer' => $customer,
                'extras' => $extras,
                'what_you_will_get' => $what_you_will_get,
                'benifits' => $benifits,
                'package_features' => $package_features,
                'extra_price' => $extra_price,
                'total_price' => $total_price,
                'package_price' => $service->price,
                'date' => $extra_services->date,
            );

            $user = Auth::guard('web')->user();
            $bankPayment = BankPayment::select('id','status','account_info','image')->first();
            $stripe = StripePayment::first();
            $paypal = PaypalPayment::first();
            $razorpay = RazorpayPayment::first();
            $flutterwave = Flutterwave::first();
            $mollie = PaystackAndMollie::first();
            $paystack = $mollie;
            $instamojoPayment = InstamojoPayment::first();

            $selected_theme = Session::get('selected_theme');
            if ($selected_theme == 'theme_one'){
                $active_theme = 'layout';
            }elseif($selected_theme == 'theme_two'){
                $active_theme = 'layout2';
            }elseif($selected_theme == 'theme_three'){
                $active_theme = 'layout3';
            }else{
                $active_theme = 'layout';
            }

            return view('payment')->with([
                'active_theme' => $active_theme,
                'breadcrumb' => $breadcrumb,
                'service' => $service,
                'customer' => $customer,
                'package_features' => $package_features,
                'benifits' => $benifits,
                'what_you_will_get' => $what_you_will_get,
                'extra_services' => $extra_services,
                'currency_icon' => $currency_icon,
                'bankPayment' => $bankPayment,
                'stripe' => $stripe,
                'paypal' => $paypal,
                'razorpay' => $razorpay,
                'total_price' => $total_price,
                'flutterwave' => $flutterwave,
                'user' => $user,
                'mollie' => $mollie,
                'instamojoPayment' => $instamojoPayment,
                'paystack' => $paystack,
            ]);
        }else{
            // $rules = [
            //     'name'=>'required',
            //     'email'=>'required',
            //     'phone'=>'required',
            //     'address'=>'required',
            // ];
            // $customMessages = [
            //     'name.required' => trans('user_validation.Name is required'),
            //     'email.required' => trans('user_validation.Email is required'),
            //     'phone.required' => trans('user_validation.Phone is required'),
            //     'address.required' => trans('user_validation.Address is required'),
            // ];
            // $this->validate($request, $rules,$customMessages);

            $breadcrumb = BreadcrumbImage::where(['id' => 8])->first();
            $service = Service::with('category','provider')->where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

            if(!$service){
                return response()->json(['message' => trans('user.Service Not Found')],403);
            }

            $what_you_will_get = array();
            if($service->what_you_will_provide){
                $provides = json_decode($service->what_you_will_provide);
                foreach($provides as $provide){
                    $what_you_will_get [] = $provide;
                }
            }

            $benifits = array();
            if($service->benifit){
                $exist_benifits = json_decode($service->benifit);
                foreach($exist_benifits as $exist_benifit){
                    $benifits [] = $exist_benifit;
                }
            }

            $package_features = array();
            if($service->package_features){
                $features = json_decode($service->package_features);
                foreach($features as $feature){
                    $package_features [] = $feature;
                }
            }

            $setting = Setting::first();
            $currency_icon = (object) array('icon' => $setting->currency_icon);

            // $customer = (object) array(
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'phone' => $request->phone,
            //     'address' => $request->address,
            //     'post_code' => $request->post_code,
            //     'order_note' => $request->order_note,
            // );

            // $extras = $request->extras;
            // $extra_services = json_decode($extras);

            // $extra_price = 0;
            // if($extra_services->ids){
            //     foreach($extra_services->ids as $index => $extra_service){
            //         $addition = AdditionalService::find($extra_services->ids[$index]);
            //         $extra_price += ($extra_services->quantities[$index] * $addition->price);
            //     }
            // }


            $total_price = $service->price + $request->extra_service_price;
            $total_price = round($total_price,2);

            $order_info = (object) array(
                'what_you_will_get' => $what_you_will_get,
                'benifits' => $benifits,
                'package_features' => $package_features,
                'total_price' => $total_price,
                'package_price' => $service->price,
            );

            $user = Auth::guard('api')->user();
            $bankPayment = BankPayment::select('id','status','account_info','image')->first();
            $stripe = StripePayment::first();
            $paypal = PaypalPayment::first();
            $razorpay = RazorpayPayment::first();
            $flutterwave = Flutterwave::first();
            $mollie = PaystackAndMollie::first();
            $paystack = $mollie;
            $instamojoPayment = InstamojoPayment::first();

            return response()->json([
                'breadcrumb' => $breadcrumb,
                'service' => $service,
                'package_features' => $package_features,
                'benifits' => $benifits,
                'what_you_will_get' => $what_you_will_get,
                'currency_icon' => $currency_icon,
                'total_price' => $total_price,
                'bankPayment' => $bankPayment,
                'stripe' => $stripe,
                'paypal' => $paypal,
                'razorpay' => $razorpay,
                'flutterwave' => $flutterwave,
                'user' => $user,
                'mollie' => $mollie,
                'paystack' => $paystack,
                'instamojoPayment' => $instamojoPayment,
            ]);
        }

    }


    public function check_schedule_during_payment($slug){
        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $order_info = Session::get('order_info');

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            $notification = trans('user_validation.This schedule already booked. please choose another schedule');
            return response()->json(['is_available' => false, 'message' => $notification]);
        }else{
            return response()->json(['is_available' => true]);
        }

    }
    public function checkAvaibalityBeforPayment($service, $date, $schedule_id){
        $exist = Order::where(['provider_id' => $service->provider_id, 'appointment_schedule_id' => $schedule_id, 'booking_date' => $date])->count();
        return $exist;
    }


    public function bankPayment(Request $request, $slug){



        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            return response()->json(['message' => $notification], 403);
        }

        $rules = [
            'tnx_info'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'date'=>'required',
            'schedule_time_slot'=>'required',
        ];

        $customMessages = [
            'tnx_info.required' => trans('user_validation.Transaction is required'),
            'name.required' => trans('user_validation.Name is required'),
            'phone.required' => trans('user_validation.Phone is required'),
            'address.required' => trans('user_validation.Address is required'),
            'date.required' => trans('user_validation.Date is required'),
            'schedule_time_slot.required' => trans('user_validation.Schedule is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $customer = (object) array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'order_note' => $request->order_note,
        );

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $what_you_will_get = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_get [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $extra_price = 0;
        if($request->ids){
            foreach($request->ids as $index => $extra_service){
                if($request->ids[$index] && $request->prices[$index] && $request->quantities[$index] && $request->names[$index]){
                    $extra_price += ($request->quantities[$index] * $request->prices[$index]);
                }
            }
        }

        $extras = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'quantities' => $request->quantities,
            'names' => $request->names,
        );

        $total_price = $service->price + $extra_price;

        $order_info = (object) array(
            'customer' => $customer,
            'extras' => $extras,
            'what_you_will_get' => $what_you_will_get,
            'benifits' => $benifits,
            'package_features' => $package_features,
            'extra_price' => $extra_price,
            'total_price' => $total_price,
            'package_price' => $service->price,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
        );

        $user = Auth::guard('api')->user();
        $provider_id = $service->provider_id;
        $client_id = $user->id;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            $notification = trans('user_validation.This schedule already booked. please choose another schedule');
            return response()->json(['message' => $notification], 403);
        }


        $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Bank Payment', 'pending', $request->tnx_info);

        $provider = $service->provider;
        $this->sendMailToClient($user, $order);
        $this->sendMailToProvider($provider, $order);

        Session::forget('order_info');

        $notification = trans('user_validation.Your order has been placed. please wait for admin payment approval');
        return response()->json(['message' => $notification]);
    }

    public function payWithStripe(Request $request, $slug){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            return response()->json(['message' => $notification], 403);
        }

        $rules = [
            'tnx_info'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'date'=>'required',
            'schedule_time_slot'=>'required',
            'card_number'=>'required',
            'year'=>'required',
            'month'=>'required',
            'cvc'=>'required',
        ];

        $customMessages = [
            'tnx_info.required' => trans('user_validation.Transaction is required'),
            'name.required' => trans('user_validation.Name is required'),
            'phone.required' => trans('user_validation.Phone is required'),
            'address.required' => trans('user_validation.Address is required'),
            'date.required' => trans('user_validation.Date is required'),
            'schedule_time_slot.required' => trans('user_validation.Schedule is required'),
            'card_number.required' => trans('user_validation.Card number is required'),
            'year.required' => trans('user_validation.Year is required'),
            'month.required' => trans('user_validation.Month is required'),
            'cvc.required' => trans('user_validation.Cvc is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $customer = (object) array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'order_note' => $request->order_note,
        );

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $what_you_will_get = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_get [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $extra_price = 0;
        if($request->ids){
            foreach($request->ids as $index => $extra_service){
                if($request->ids[$index] && $request->prices[$index] && $request->quantities[$index] && $request->names[$index]){
                    $extra_price += ($request->quantities[$index] * $request->prices[$index]);
                }
            }
        }

        $extras = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'quantities' => $request->quantities,
            'names' => $request->names,
        );

        $total_price = $service->price + $extra_price;

        $order_info = (object) array(
            'customer' => $customer,
            'extras' => $extras,
            'what_you_will_get' => $what_you_will_get,
            'benifits' => $benifits,
            'package_features' => $package_features,
            'extra_price' => $extra_price,
            'total_price' => $total_price,
            'package_price' => $service->price,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
        );

        $user = Auth::guard('api')->user();
        $provider_id = $service->provider_id;
        $client_id = $user->id;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            $notification = trans('user_validation.This schedule already booked. please choose another schedule');
            return response()->json(['message' => $notification], 403);
        }

        $stripe = StripePayment::first();
        $payableAmount = round($total_price * $stripe->currency_rate,2);
        Stripe\Stripe::setApiKey($stripe->stripe_secret);

        try{
            $token = Stripe\Token::create([
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->month,
                    'exp_year' => $request->year,
                    'cvc' => $request->cvc,
                ],
            ]);
        }catch (Exception $e) {
            return response()->json(['error' => 'Please provide valid card information'],403);
        }

        if (!isset($token['id'])) {
            return response()->json(['error' => 'Payment faild'],403);
        }

        $result = Stripe\Charge::create([
            'card' => $token['id'],
            'currency' => $stripe->currency_code,
            'amount' => $payableAmount * 100,
            'description' => env('APP_NAME'),
        ]);


        if($result['status'] != 'succeeded') {
            return response()->json(['error' => 'Payment faild'],403);
        }


        $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Stripe', 'success', $result['balance_transaction']);

        $provider = $service->provider;
        $this->sendMailToClient($user, $order);
        $this->sendMailToProvider($provider, $order);

        Session::forget('order_info');

        $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
        return response()->json(['message' => $notification]);

    }

    public function payWithInstamojo(Request $request, $slug){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $user = Auth::guard('web')->user();
        $order_info = Session::get('order_info');
        $provider_id = $service->provider_id;
        $client_id = $user->id;

        $total_price = $service->price + $order_info->extra_price;

        $instamojoPayment = InstamojoPayment::first();
        $price = $total_price * $instamojoPayment->currency_rate;
        $price = round($price,2);

        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

        if($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url.'payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"));
        $payload = Array(
            'purpose' => env("APP_NAME"),
            'amount' => $price,
            'phone' => '918160651749',
            'buyer_name' => Auth::user()->name,
            'redirect_url' => route('response-instamojo'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => Auth::user()->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        Session::put('service', $service);
        return redirect($response->payment_request->longurl);
    }

    public function instamojoResponse(Request $request){

        Session::put('return_from_mollie','payment_faild');
        $service = Session::get('service');

        $input = $request->all();
        $instamojoPayment = InstamojoPayment::first();
        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

        if($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.'payments/'.$request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"));
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            $notification = trans('user_validation.Payment Faild');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('payment', $service->slug)->with($notification);
        } else {
            $data = json_decode($response);
        }

        if($data->success == true) {
            if($data->payment->status == 'Credit') {

                $service = Service::where(['slug' => $service->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
                $user = Auth::guard('web')->user();
                $order_info = Session::get('order_info');
                $provider_id = $service->provider_id;
                $client_id = $user->id;

                $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Instamojo', 'success', $request->get('payment_id'));

                $provider = $service->provider;
                $this->sendMailToClient($user, $order);
                $this->sendMailToProvider($provider, $order);

                Session::forget('order_info');
                Session::forget('return_from_mollie');
                Session::forget('service');

                $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
                $notification = array('messege'=>$notification,'alert-type'=>'success');
                return redirect()->route('dashboard')->with($notification);
            }
        }else{
            $notification = trans('user_validation.Payment Faild');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('payment', $service->slug)->with($notification);
        }
    }



    public function createOrder($user, $service, $order_info, $provider_id, $client_id, $payment_method, $payment_status, $tnx_info){

        $extra_services = $order_info->extras;
        $additional_amount = $order_info->extra_price;
        $additional_services = array();
        if($extra_services->ids){
            foreach($extra_services->ids as $index => $extra_service){
                $addition = AdditionalService::find($extra_services->ids[$index]);
                $single_extra_service = array(
                    'service_name' => $extra_services->names[$index],
                    'qty' => $extra_services->quantities[$index],
                    'price' => ($extra_services->quantities[$index] * $addition->price),
                );
                $additional_services[] = $single_extra_service;
            }
        }

        $order_additional_services = json_encode($additional_services);
        $order_note = $order_info->customer->order_note;
        $client_address = $order_info->customer;

        $find_schedule = AppointmentSchedule::find($order_info->schedule_time_slot);
        $time_slot = '';
        if($find_schedule){
            $time_slot = strtoupper(date('h:i A', strtotime($find_schedule->start_time))).' - '.strtoupper(date('h:i A', strtotime($find_schedule->end_time)));
        }

        $order = new Order();
        $order->order_id = substr(rand(0,time()),0,10);
        $order->booking_date = $order_info->date;
        $order->appointment_schedule_id = $order_info->schedule_time_slot;
        $order->schedule_time_slot = $time_slot;
        $order->client_id = $client_id;
        $order->provider_id = $provider_id;
        $order->service_id = $service->id;
        $order->package_amount = $service->price;
        $order->additional_amount = $additional_amount;
        $order->total_amount = ($service->price + $additional_amount);
        $order->payment_method = $payment_method;
        $order->transection_id = $tnx_info;
        $order->payment_status = $payment_status;
        $order->order_status = 'awaiting_for_provider_approval';
        $order->package_features = $service->package_features;
        $order->additional_services = $order_additional_services;
        $order->order_note = $order_note;
        $order->client_address = json_encode($client_address);
        $order->save();

        return $order;
    }


    public function sendMailToClient($user, $order){
        MailHelper::setMailConfig();

        $setting = Setting::first();

        $template=EmailTemplate::where('id',8)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{name}}',$user->name,$message);
        $message = str_replace('{{amount}}',$setting->currency_icon.$order->total_amount,$message);
        $message = str_replace('{{schedule_date}}',$order->booking_date,$message);
        $message = str_replace('{{order_id}}',$order->order_id,$message);
        Mail::to($user->email)->send(new OrderSuccessfully($message,$subject));
    }

    public function sendMailToProvider($provider, $order){
        MailHelper::setMailConfig();

        $setting = Setting::first();

        $template=EmailTemplate::where('id',9)->first();
        $subject=$template->subject;
        $message=$template->description;
        $message = str_replace('{{name}}',$provider->name,$message);
        $message = str_replace('{{amount}}',$setting->currency_icon.$order->total_amount,$message);
        $message = str_replace('{{schedule_date}}',$order->booking_date,$message);
        $message = str_replace('{{order_id}}',$order->order_id,$message);
        Mail::to($provider->email)->send(new OrderSuccessfully($message,$subject));
    }


    public function razorpay_create_token(Request $request){

        $rules = [
            'slug'=>'required'
        ];
        $this->validate($request, $rules);

        $user = Auth::guard('api')->user();
        

        $service = Service::where(['slug' => $request->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $extra_price = 0;
        if($request->ids){
            foreach($request->ids as $index => $extra_service){
                if($request->ids[$index] && $request->prices[$index] && $request->quantities[$index] && $request->names[$index]){
                    $extra_price += ($request->quantities[$index] * $request->prices[$index]);
                }
            }
        }

        $total_price = $service->price + $extra_price;
        $razorpay = RazorpayPayment::first();
        $payable_amount = $total_price * $razorpay->currency_rate;

        $payable_amount = round($payable_amount, 2);
        $api = new Api($razorpay->key,$razorpay->secret_key);
        $order = $api->order->create(
            array('receipt' => '123', 'amount' => ($payable_amount * 100), 'currency' => $razorpay->currency_code)
        );

        $data = [
            "key"               => $razorpay->key,
            "amount"            => $payable_amount * 100,
            "order_id"          => $order->id,
          ];

        return response()->json($data, 200);
    }


    public function razorpay_web_view(Request $request){
        
        

        $rules = [
            'order_id'=>'required',
            'total_amount'=>'required',
            'slug'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'date'=>'required',
            'schedule_time_slot'=>'required',
            'request_from'=>'required',
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'phone.required' => trans('user_validation.Phone is required'),
            'address.required' => trans('user_validation.Address is required'),
            'date.required' => trans('user_validation.Date is required'),
            'schedule_time_slot.required' => trans('user_validation.Schedule is required'),
        ];
        $this->validate($request, $rules,$customMessages);


        $customer = (object) array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'order_note' => $request->order_note,
        );

        $service = Service::where(['slug' => $request->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $what_you_will_get = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_get [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $extra_price = 0;
        if($request->ids){
            foreach($request->ids as $index => $extra_service){
                if($request->ids[$index] && $request->prices[$index] && $request->quantities[$index] && $request->names[$index]){
                    $extra_price += ($request->quantities[$index] * $request->prices[$index]);
                }
            }
        }

        $extras = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'quantities' => $request->quantities,
            'names' => $request->names,
        );

        $total_price = $service->price + $extra_price;

        $order_info = (object) array(
            'customer' => $customer,
            'extras' => $extras,
            'what_you_will_get' => $what_you_will_get,
            'benifits' => $benifits,
            'package_features' => $package_features,
            'extra_price' => $extra_price,
            'total_price' => $total_price,
            'package_price' => $service->price,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
        );

        $user = Auth::guard('api')->user();
        $provider_id = $service->provider_id;
        $client_id = $user->id;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            return redirect()->route('webview-schedule-not-available');
        }

        $orderId = $request->order_id;
        $razorpay = RazorpayPayment::first();
        $payable_amount = $request->total_amount;
        $frontend_success_url = $request->frontend_success_url;
        $frontend_faild_url = $request->frontend_faild_url;

        $request_from = $request->request_from;
        $token = $request->token;

        $order_info = json_encode($order_info);
        Session::put('order_info', $order_info);
        $slug =  $request->slug;
        return view('razorpay_webview', compact('orderId','razorpay','payable_amount','frontend_success_url','frontend_faild_url','request_from','token','slug'));
    }

    public function webview_schedule_not_available(){
        $notification = trans('user_validation.This schedule already booked. please choose another schedule');
        return response()->json(['message' => $notification]);
    }

    public function webview_payment_faild(){
        $notification = trans('user_validation.Payment Faild');
        return response()->json(['message' => $notification]);
    }

    public function webview_payment_success(){
        $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
        return response()->json(['message' => $notification]);
    }

    public function webview_razorpay_payment_verify(Request $request){

        $razorpay = RazorpayPayment::first();
        $success = true;
        $error = "Payment Failed!";

        if (empty($request->razorpay_payment_id) === false) {
            $api = new Api($razorpay->key,$razorpay->secret_key);
            try {
                $attributes = [
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                ];
                $api->utility->verifyPaymentSignature($attributes);
            } catch (SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }

        if($success == true) {
            try {
                $payId = $request->razorpay_payment_id;

                $service = Service::where(['slug' => $request->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
                $user = Auth::guard('api')->user();
                $order_info = Session::get('order_info');
                $order_info = json_decode($order_info);
                $provider_id = $service->provider_id;
                $client_id = $user->id;

                $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Razorpay', 'success', $payId);

                $provider = $service->provider;
                $this->sendMailToClient($user, $order);
                $this->sendMailToProvider($provider, $order);

                return redirect()->route('webview-payment-success');

            }catch (Exception $e) {
                return redirect()->route('webview-payment-faild');
            }
        }else{
            return redirect()->route('webview-payment-faild');
        }
    }

    public function flutterwave_web_view(Request $request){
        $rules = [
            'slug'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'date'=>'required',
            'schedule_time_slot'=>'required',
            'request_from'=>'required',
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'phone.required' => trans('user_validation.Phone is required'),
            'address.required' => trans('user_validation.Address is required'),
            'date.required' => trans('user_validation.Date is required'),
            'schedule_time_slot.required' => trans('user_validation.Schedule is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $customer = (object) array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'order_note' => $request->order_note,
        );

        $service = Service::where(['slug' => $request->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $what_you_will_get = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_get [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $extra_price = 0;
        if($request->ids){
            foreach($request->ids as $index => $extra_service){
                if($request->ids[$index] && $request->prices[$index] && $request->quantities[$index] && $request->names[$index]){
                    $extra_price += ($request->quantities[$index] * $request->prices[$index]);
                }
            }
        }

        $extras = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'quantities' => $request->quantities,
            'names' => $request->names,
        );

        $total_price = $service->price + $extra_price;

        $order_info = (object) array(
            'customer' => $customer,
            'extras' => $extras,
            'what_you_will_get' => $what_you_will_get,
            'benifits' => $benifits,
            'package_features' => $package_features,
            'extra_price' => $extra_price,
            'total_price' => $total_price,
            'package_price' => $service->price,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
        );

        $user = Auth::guard('api')->user();
        $provider_id = $service->provider_id;
        $client_id = $user->id;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            return redirect()->route('webview-schedule-not-available');
        }

        $orderId = $request->order_id;
        $flutterwave = Flutterwave::first();
        $payable_amount = $total_price;
        $frontend_success_url = $request->frontend_success_url;
        $frontend_faild_url = $request->frontend_faild_url;

        $request_from = $request->request_from;
        $token = $request->token;

        $order_info = json_encode($order_info);
        Session::put('order_info', $order_info);
        $slug =  $request->slug;

        return view('flutterwave_webview', compact('flutterwave','payable_amount','frontend_success_url','frontend_faild_url','request_from','token','slug','user','total_price'));
    }


    public function pay_with_flutterwave_web_view(Request $request){
        $flutterwave = Flutterwave::first();
        $curl = curl_init();
        $tnx_id = $request->tnx_id;
        $url = "https://api.flutterwave.com/v3/transactions/$tnx_id/verify";
        $token = $flutterwave->secret_key;
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer $token"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);


        if($response->status == 'success'){
            $service = Service::where(['slug' => $request->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
            $user = Auth::guard('api')->user();
            $order_info = Session::get('order_info');
            $order_info = json_decode($order_info);
            $provider_id = $service->provider_id;
            $client_id = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Razorpay', 'success', $tnx_id);

            $provider = $service->provider;
            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);


            return response()->json(['status' => 'success' , 'message' => 'successfull'],200);
        }else{
            $notification = trans('user_validation.Payment Faild');
            return response()->json(['status' => 'faild' , 'message' => $notification],403);
        }
    }

    public function pay_with_mollie_webview(Request $request){
        $rules = [
            'slug'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'date'=>'required',
            'schedule_time_slot'=>'required',
            'request_from'=>'required',
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'phone.required' => trans('user_validation.Phone is required'),
            'address.required' => trans('user_validation.Address is required'),
            'date.required' => trans('user_validation.Date is required'),
            'schedule_time_slot.required' => trans('user_validation.Schedule is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $customer = (object) array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'order_note' => $request->order_note,
        );

        $service = Service::where(['slug' => $request->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $what_you_will_get = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_get [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $extra_price = 0;
        if($request->ids){
            foreach($request->ids as $index => $extra_service){
                if($request->ids[$index] && $request->prices[$index] && $request->quantities[$index] && $request->names[$index]){
                    $extra_price += ($request->quantities[$index] * $request->prices[$index]);
                }
            }
        }

        $extras = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'quantities' => $request->quantities,
            'names' => $request->names,
        );

        $total_price = $service->price + $extra_price;

        $order_info = (object) array(
            'customer' => $customer,
            'extras' => $extras,
            'what_you_will_get' => $what_you_will_get,
            'benifits' => $benifits,
            'package_features' => $package_features,
            'extra_price' => $extra_price,
            'total_price' => $total_price,
            'package_price' => $service->price,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
        );

        $user = Auth::guard('api')->user();
        $provider_id = $service->provider_id;
        $client_id = $user->id;
        $user = Auth::guard('api')->user();

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            return redirect()->route('webview-schedule-not-available');
        }

        $payable_amount = $total_price;
        $frontend_success_url = $request->frontend_success_url;
        $frontend_faild_url = $request->frontend_faild_url;

        $request_from = $request->request_from;
        $token = $request->token;

        $order_info = json_encode($order_info);
        Session::put('order_info', $order_info);
        $slug =  $request->slug;
        Session::put('slug', $slug);
        Session::put('request_from', $request_from);
        Session::put('user', $user);
        Session::put('frontend_success_url', $request->frontend_success_url);
        Session::put('frontend_faild_url', $request->frontend_faild_url);



        $mollie = PaystackAndMollie::first();
        $price = $total_price * $mollie->mollie_currency_rate;
        $price = round($price,2);
        $price = sprintf('%0.2f', $price);


        $mollie_api_key = $mollie->mollie_key;
        $currency = strtoupper($mollie->mollie_currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => ''.$price.'',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('mollie-payment-success-webview'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id',$payment->id);
        session()->put('service',$service);

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function mollie_payment_success(Request $request){

        $service = Session::get('service');

        $mollie = PaystackAndMollie::first();
        $mollie_api_key = $mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));
        if ($payment->isPaid()){

            $service = Service::where(['slug' => $service->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
            $user = Session::get('user');
            $order_info = Session::get('order_info');
            $order_info = json_decode($order_info);
            $provider_id = $service->provider_id;
            $client_id = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Mollie', 'success', session()->get('payment_id'));

            $provider = $service->provider;
            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);

            Session::forget('order_info');
            Session::forget('slug');
            Session::forget('request_from');
            Session::forget('user');
            Session::forget('frontend_success_url');
            Session::forget('frontend_faild_url');

            return redirect()->route('webview-payment-success');
        }else{
            return redirect()->route('webview-payment-faild');
        }


    }

    public function paystack_web_view(Request $request){
        $rules = [
            'slug'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'date'=>'required',
            'schedule_time_slot'=>'required',
            'request_from'=>'required',
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'phone.required' => trans('user_validation.Phone is required'),
            'address.required' => trans('user_validation.Address is required'),
            'date.required' => trans('user_validation.Date is required'),
            'schedule_time_slot.required' => trans('user_validation.Schedule is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $customer = (object) array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'order_note' => $request->order_note,
        );

        $service = Service::where(['slug' => $request->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $what_you_will_get = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_get [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $extra_price = 0;
        if($request->ids){
            foreach($request->ids as $index => $extra_service){
                if($request->ids[$index] && $request->prices[$index] && $request->quantities[$index] && $request->names[$index]){
                    $extra_price += ($request->quantities[$index] * $request->prices[$index]);
                }
            }
        }

        $extras = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'quantities' => $request->quantities,
            'names' => $request->names,
        );

        $total_price = $service->price + $extra_price;

        $order_info = (object) array(
            'customer' => $customer,
            'extras' => $extras,
            'what_you_will_get' => $what_you_will_get,
            'benifits' => $benifits,
            'package_features' => $package_features,
            'extra_price' => $extra_price,
            'total_price' => $total_price,
            'package_price' => $service->price,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
        );

        $user = Auth::guard('api')->user();
        $provider_id = $service->provider_id;
        $client_id = $user->id;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            return redirect()->route('webview-schedule-not-available');
        }

        $orderId = $request->order_id;
        $paystack = PaystackAndMollie::first();
        $payable_amount = $total_price;
        $frontend_success_url = $request->frontend_success_url;
        $frontend_faild_url = $request->frontend_faild_url;

        $request_from = $request->request_from;
        $token = $request->token;

        $order_info = json_encode($order_info);
        Session::put('order_info', $order_info);
        $slug =  $request->slug;

        return view('paystack_webview', compact('paystack','payable_amount','frontend_success_url','frontend_faild_url','request_from','token','slug','user','total_price'));
    }

    public function pay_with_paystack(Request $request){
        $paystack = PaystackAndMollie::first();

        $reference = $request->reference;
        $transaction = $request->tnx_id;
        $secret_key = $paystack->paystack_secret_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST =>0,
            CURLOPT_SSL_VERIFYPEER =>0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $secret_key",
                "Cache-Control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $final_data = json_decode($response);
        if($final_data->status == true) {
            $slug = $request->slug;
            $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

            $user = Auth::guard('api')->user();
            $order_info = Session::get('order_info');
            $order_info = json_decode($order_info);
            $provider_id = $service->provider_id;
            $client_id = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Paystack', 'success', $transaction);

            $provider = $service->provider;
            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);

            Session::forget('order_info');

            return response()->json(['status' => 'success' , 'message' => 'successfull']);
        }else{

            return response()->json(['status' => 'faild' , 'message' => 'faild']);
        }
    }

    public function pay_with_instamojo(Request $request){
        $rules = [
            'slug'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'date'=>'required',
            'schedule_time_slot'=>'required',
            'request_from'=>'required',
        ];

        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'phone.required' => trans('user_validation.Phone is required'),
            'address.required' => trans('user_validation.Address is required'),
            'date.required' => trans('user_validation.Date is required'),
            'schedule_time_slot.required' => trans('user_validation.Schedule is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $customer = (object) array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'order_note' => $request->order_note,
        );

        $service = Service::where(['slug' => $request->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $what_you_will_get = array();
        if($service->what_you_will_provide){
            $provides = json_decode($service->what_you_will_provide);
            foreach($provides as $provide){
                $what_you_will_get [] = $provide;
            }
        }

        $benifits = array();
        if($service->benifit){
            $exist_benifits = json_decode($service->benifit);
            foreach($exist_benifits as $exist_benifit){
                $benifits [] = $exist_benifit;
            }
        }

        $package_features = array();
        if($service->package_features){
            $features = json_decode($service->package_features);
            foreach($features as $feature){
                $package_features [] = $feature;
            }
        }

        $extra_price = 0;
        if($request->ids){
            foreach($request->ids as $index => $extra_service){
                if($request->ids[$index] && $request->prices[$index] && $request->quantities[$index] && $request->names[$index]){
                    $extra_price += ($request->quantities[$index] * $request->prices[$index]);
                }
            }
        }

        $extras = (object) array(
            'ids' => $request->ids,
            'prices' => $request->prices,
            'quantities' => $request->quantities,
            'names' => $request->names,
        );

        $total_price = $service->price + $extra_price;

        $order_info = (object) array(
            'customer' => $customer,
            'extras' => $extras,
            'what_you_will_get' => $what_you_will_get,
            'benifits' => $benifits,
            'package_features' => $package_features,
            'extra_price' => $extra_price,
            'total_price' => $total_price,
            'package_price' => $service->price,
            'date' => $request->date,
            'schedule_time_slot' => $request->schedule_time_slot,
        );

        $user = Auth::guard('api')->user();
        $provider_id = $service->provider_id;
        $client_id = $user->id;
        $user = Auth::guard('api')->user();

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            return redirect()->route('webview-schedule-not-available');
        }

        $payable_amount = $total_price;
        $frontend_success_url = $request->frontend_success_url;
        $frontend_faild_url = $request->frontend_faild_url;

        $request_from = $request->request_from;
        $token = $request->token;

        $order_info = json_encode($order_info);
        Session::put('order_info', $order_info);
        $slug =  $request->slug;
        Session::put('slug', $slug);
        Session::put('request_from', $request_from);
        Session::put('user', $user);
        Session::put('frontend_success_url', $request->frontend_success_url);
        Session::put('frontend_faild_url', $request->frontend_faild_url);



        $instamojoPayment = InstamojoPayment::first();
        $price = $total_price * $instamojoPayment->currency_rate;
        $price = round($price,2);

        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

        if($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url.'payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"));
        $payload = Array(
            'purpose' => env("APP_NAME"),
            'amount' => $price,
            'phone' => '918160651749',
            'buyer_name' => Auth::user()->name,
            'redirect_url' => route('instamojo-response-webview'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => Auth::user()->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        Session::put('service', $service);
        return redirect($response->payment_request->longurl);
    }

    public function instamojo_response(Request $request){
        $service = Session::get('service');

        $input = $request->all();
        $instamojoPayment = InstamojoPayment::first();
        $environment = $instamojoPayment->account_mode;
        $api_key = $instamojoPayment->api_key;
        $auth_token = $instamojoPayment->auth_token;

        if($environment == 'Sandbox') {
            $url = 'https://test.instamojo.com/api/1.1/';
        } else {
            $url = 'https://www.instamojo.com/api/1.1/';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url.'payments/'.$request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                "X-Auth-Token:$auth_token"));
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return redirect()->route('webview-payment-faild');
        } else {
            $data = json_decode($response);
        }

        if($data->success == true) {
            if($data->payment->status == 'Credit') {

                $service = Service::where(['slug' => $service->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
                $user = Session::get('user');
                $order_info = Session::get('order_info');
                $order_info = json_decode($order_info);
                $provider_id = $service->provider_id;
                $client_id = $user->id;

                $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Instamojo', 'success', $request->get('payment_id'));

                $provider = $service->provider;
                $this->sendMailToClient($user, $order);
                $this->sendMailToProvider($provider, $order);

                Session::forget('order_info');
                Session::forget('service');
                Session::forget('user');

                return redirect()->route('webview-payment-success');
            }
        }else{
            return redirect()->route('webview-payment-faild');
        }
    }


}

