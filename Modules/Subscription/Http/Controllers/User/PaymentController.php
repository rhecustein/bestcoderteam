<?php

namespace Modules\Subscription\Http\Controllers\User;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Gateway;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\RazorpayPayment;
use App\Models\FlutterwavePayment;
use App\Models\InstamojoPayment;
use App\Models\MolliePayment;
use App\Models\PaystackPayment;
use App\Models\PaymongoPayment;
use App\Models\CurrencyCountry;
use App\Models\Currency;
use Stripe;
use Str;
use Razorpay\Api\Api;
use Exception;
use Redirect;
use Auth;
use Session;
use Mollie\Laravel\Facades\Mollie;

use Modules\Subscription\Entities\ProviderStripe;
use Modules\Subscription\Entities\ProviderRazorpay;
use Modules\Subscription\Entities\ProviderFlutterwave;
use Modules\Subscription\Entities\ProviderPaystack;
use Modules\Subscription\Entities\ProviderMollie;
use Modules\Subscription\Entities\ProviderInstamojo;
use Modules\Subscription\Entities\ProviderBankHandcash;
use Modules\Subscription\Entities\ProviderPaypal;



use App\Models\Setting;
use App\Models\StripePayment;
use App\Models\PaypalPayment;
use App\Mail\OrderSuccessfully;
use App\Helpers\MailHelper;
use App\Models\EmailTemplate;
use App\Models\MidtransPayment;

use App\Models\Flutterwave;
use App\Models\PaystackAndMollie;


use App\Models\BankPayment;
use App\Models\AppointmentSchedule;


use Mail;

use Cart;



use App\Models\BreadcrumbImage;

use App\Models\AdditionalService;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\Coupon;
use App\Models\CouponHistory;


class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function payment(Request $request ,$slug){
        $user = Auth::guard('web')->user();
        if($user->is_provider == 1){
            $notification = trans('user_validation.You are log-in as a provider, you can not book any service');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
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
                'schedule_time_slot' => $extra_services->schedule_time_slot,
            );

            $user = Auth::guard('web')->user();
            $bankPayment = BankPayment::select('id','status','account_info','image')->first();
            $stripe = StripePayment::first();
            $paypal = PaypalPayment::first();
            $midtrans = MidtransPayment::first();
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

            $service_author_id = $service->provider_id;

            $provider_stripe = ProviderStripe::where('provider_id', $service_author_id)->first();
            $provider_paypal = ProviderPaypal::where('provider_id', $service_author_id)->first();
            $provider_razorpay = ProviderRazorpay::where('provider_id', $service_author_id)->first();
            $provider_flutterwave = ProviderFlutterwave::where('provider_id', $service_author_id)->first();
            $provider_paystack = ProviderPaystack::where('provider_id', $service_author_id)->first();
            $provider_mollie = ProviderMollie::where('provider_id', $service_author_id)->first();
            $provider_instamojo = ProviderInstamojo::where('provider_id', $service_author_id)->first();
            $provider_bank_handcash = ProviderBankHandcash::where('provider_id', $service_author_id)->first();
            return view('subscription::user.payment')->with([
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
                'midtrans'=> $midtrans,
                'razorpay' => $razorpay,
                'total_price' => $total_price,
                'flutterwave' => $flutterwave,
                'user' => $user,
                'mollie' => $mollie,
                'instamojoPayment' => $instamojoPayment,
                'paystack' => $paystack,

                'provider_stripe' => $provider_stripe,
                'provider_paypal' => $provider_paypal,
                'provider_razorpay' => $provider_razorpay,
                'provider_flutterwave' => $provider_flutterwave,
                'provider_mollie' => $provider_mollie,
                'provider_paystack' => $provider_paystack,
                'provider_instamojo' => $provider_instamojo,
                'provider_bank_handcash' => $provider_bank_handcash,
            ]);
        }else{

            $request->validate([
                'name'=>'required',
                'phone'=>'required',
                'address'=>'required',
                'agree_with'=>'required',
            ],[
                'name.required' => trans('user_validation.Name is required'),
                'email.required' => trans('user_validation.Email is required'),
                'phone.required' => trans('user_validation.Phone is required'),
                'address.required' => trans('user_validation.Address is required'),
                'agree_with.required' => trans('user_validation.Agree with terms and conditions is required'),
            ]);

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

            $customer = (object) array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'post_code' => $request->post_code,
                'order_note' => $request->order_note,
            );

            $extras = html_decode($request->extras);
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
                'schedule_time_slot' => $extra_services->schedule_time_slot,
            );



            Session::put('order_info', $order_info);
            $user = Auth::guard('web')->user();
            $bankPayment = BankPayment::first();
            $stripe = StripePayment::first();
            $paypal = PaypalPayment::first();
            $midtrans = MidtransPayment::first();
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

            $service_author_id = $service->provider_id;

            $provider_stripe = ProviderStripe::where('provider_id', $service_author_id)->first();
            $provider_paypal = ProviderPaypal::where('provider_id', $service_author_id)->first();
            $provider_razorpay = ProviderRazorpay::where('provider_id', $service_author_id)->first();
            $provider_flutterwave = ProviderFlutterwave::where('provider_id', $service_author_id)->first();
            $provider_paystack = ProviderPaystack::where('provider_id', $service_author_id)->first();
            $provider_mollie = ProviderMollie::where('provider_id', $service_author_id)->first();
            $provider_instamojo = ProviderInstamojo::where('provider_id', $service_author_id)->first();
            $provider_bank_handcash = ProviderBankHandcash::where('provider_id', $service_author_id)->first();

            return view('subscription::user.payment')->with([
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
                'midtrans'=>$midtrans,
                'razorpay' => $razorpay,
                'total_price' => $total_price,
                'flutterwave' => $flutterwave,
                'user' => $user,
                'mollie' => $mollie,
                'paystack' => $paystack,
                'instamojoPayment' => $instamojoPayment,

                'provider_stripe' => $provider_stripe,
                'provider_paypal' => $provider_paypal,
                'provider_razorpay' => $provider_razorpay,
                'provider_flutterwave' => $provider_flutterwave,
                'provider_mollie' => $provider_mollie,
                'provider_paystack' => $provider_paystack,
                'provider_instamojo' => $provider_instamojo,
                'provider_bank_handcash' => $provider_bank_handcash,
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

    public function handcash_payment($slug){
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

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            $notification = trans('user_validation.This schedule already booked. please choose another schedule');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Handcash', 'pending', 'handcash_payment');

        $provider = $service->provider;
        $this->sendMailToClient($user, $order);
        $this->sendMailToProvider($provider, $order);

        Session::forget('order_info');

        $notification = trans('user_validation.Your order has been placed. please wait for admin payment approval');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('dashboard')->with($notification);
    }


    public function bankPayment(Request $request, $slug){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $request->validate([
            'tnx_info'=>'required',
        ],[
            'tnx_info.required' => trans('user_validation.Transaction is required'),
        ]);

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $user = Auth::guard('web')->user();
        $order_info = Session::get('order_info');
        $provider_id = $service->provider_id;
        $client_id = $user->id;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            $notification = trans('user_validation.This schedule already booked. please choose another schedule');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Bank Payment', 'pending', $request->tnx_info);

        $provider = $service->provider;
        $this->sendMailToClient($user, $order);
        $this->sendMailToProvider($provider, $order);

        Session::forget('order_info');

        $notification = trans('user_validation.Your order has been placed. please wait for admin payment approval');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('dashboard')->with($notification);
    }

    public function payWithMidtrans($slug){
        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        if (!$service) {
            $notification = [
                'messege' => trans('user_validation.Service Not Found'),
                'alert-type' => 'error',
            ];

            session()->flash('messege', $notification['messege']);
            session()->flash('alert-type', $notification['alert-type']);
            return abort(404);
        }
    }

    public function payWithStripe(Request $request, $slug){

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

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            $notification = trans('user_validation.This schedule already booked. please choose another schedule');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $total_price = $service->price + $order_info->extra_price;

        $coupon_discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount = ($offer_percentage / 100) * $total_price;
        }

        $provider_stripe = ProviderStripe::where('provider_id', $provider_id)->first();

        $stripe = StripePayment::first();
        $payableAmount = round(($total_price - $coupon_discount) * $stripe->currency_rate,2);
        Stripe\Stripe::setApiKey($provider_stripe->stripe_secret);

        $result = Stripe\Charge::create ([
                "amount" => $payableAmount * 100,
                "currency" => $stripe->currency_code,
                "source" => $request->stripeToken,
                "description" => env('APP_NAME')
            ]);

        $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Stripe', 'success', $result->balance_transaction);

        $provider = $service->provider;
        $this->sendMailToClient($user, $order);
        $this->sendMailToProvider($provider, $order);

        Session::forget('order_info');

        $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('dashboard')->with($notification);

    }

    public function payWithRazorpay(Request $request, $slug){
        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $razorpay = RazorpayPayment::first();
        $provider_razorpay = ProviderRazorpay::where('provider_id', $service->provider_id)->first();
        $input = $request->all();
        $api = new Api($provider_razorpay->key,$provider_razorpay->secret_key);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $payId = $response->id;


                $user = Auth::guard('web')->user();
                $order_info = Session::get('order_info');
                $provider_id = $service->provider_id;
                $client_id = $user->id;

                $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

                if($exist > 0){
                    $notification = trans('user_validation.This schedule already booked. please choose another schedule');
                    $notification = array('messege'=>$notification,'alert-type'=>'error');
                    return redirect()->route('ready-to-booking', $service->slug)->with($notification);
                }

                $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Razorpay', 'success', $payId);

                $provider = $service->provider;
                $this->sendMailToClient($user, $order);
                $this->sendMailToProvider($provider, $order);

                Session::forget('order_info');

                $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
                $notification = array('messege'=>$notification,'alert-type'=>'success');
                return redirect()->route('dashboard')->with($notification);

            }catch (Exception $e) {
                $notification = trans('user_validation.Payment Faild');
                $notification = array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = trans('user_validation.Payment Faild');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
    }

    public function payWithFlutterwave(Request $request, $slug){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $flutterwave = Flutterwave::first();
        $provider_flutterwave = ProviderFlutterwave::where('provider_id', $service->provider_id)->first();

        $curl = curl_init();
        $tnx_id = $request->tnx_id;
        $url = "https://api.flutterwave.com/v3/transactions/$tnx_id/verify";
        $token = $provider_flutterwave->secret_key;
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

            $user = Auth::guard('web')->user();
            $order_info = Session::get('order_info');
            $provider_id = $service->provider_id;
            $client_id = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Flutterwave', 'success', $tnx_id);

            $provider = $service->provider;
            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);

            Session::forget('order_info');

            $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
            return response()->json(['status' => 'success' , 'message' => $notification]);
        }else{
            $notification = trans('user_validation.Payment Faild');
            return response()->json(['status' => 'faild' , 'message' => $notification]);
        }
    }

    public function payWithMollie(Request $request, $slug){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $user = Auth::guard('web')->user();
        $order_info = Session::get('order_info');
        $total_price = $service->price + $order_info->extra_price;

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            $notification = trans('user_validation.This schedule already booked. please choose another schedule');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $coupon_discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount = ($offer_percentage / 100) * $total_price;
        }

        $provider_mollie = ProviderMollie::where('provider_id', $service->provider_id)->first();
        $mollie = PaystackAndMollie::first();
        $price = ($total_price - $coupon_discount) * $mollie->mollie_currency_rate;
        $price = round($price,2);
        $price = sprintf('%0.2f', $price);

        $mollie_api_key = $provider_mollie->mollie_key;
        $currency = strtoupper($mollie->mollie_currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => ''.$price.'',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('user.sub.mollie-payment-success'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id',$payment->id);
        session()->put('service',$service);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function molliePaymentSuccess(Request $request){


        $service = Session::get('service');
        Session::put('return_from_mollie','payment_faild');
        $order_info = Session::get('order_info');

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            $notification = trans('user_validation.This schedule already booked. please choose another schedule');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $provider_mollie = ProviderMollie::where('provider_id', $service->provider_id)->first();
        $mollie = PaystackAndMollie::first();
        $mollie_api_key = $provider_mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));
        if ($payment->isPaid()){
            $service = Service::where(['slug' => $service->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
            $user = Auth::guard('web')->user();
            $order_info = Session::get('order_info');
            $provider_id = $service->provider_id;
            $client_id = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Mollie', 'success', session()->get('payment_id'));

            $provider = $service->provider;
            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);

            Session::forget('order_info');
            Session::forget('return_from_mollie');

            $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('dashboard')->with($notification);
        }else{
            $notification = trans('user_validation.Payment Faild');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('payment', $service->slug)->with($notification);
        }
    }

    public function payWithPayStack(Request $request, $slug){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        $provider_paystack = ProviderPaystack::where('provider_id', $service->provider_id)->first();

        $paystack = PaystackAndMollie::first();

        $reference = $request->reference;
        $transaction = $request->tnx_id;
        $secret_key = $provider_paystack->secret_key;
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

            $user = Auth::guard('web')->user();
            $order_info = Session::get('order_info');
            $provider_id = $service->provider_id;
            $client_id = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Paystack', 'success', $transaction);

            $provider = $service->provider;
            $this->sendMailToClient($user, $order);
            $this->sendMailToProvider($provider, $order);

            Session::forget('order_info');

            $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
            return response()->json(['status' => 'success' , 'message' => $notification]);
        }else{
            $notification = trans('user_validation.Payment Faild');
            return response()->json(['status' => 'faild' , 'message' => $notification]);
        }
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

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            $notification = trans('user_validation.This schedule already booked. please choose another schedule');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $total_price = $service->price + $order_info->extra_price;

        $coupon_discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount = ($offer_percentage / 100) * $total_price;
        }

        $provider_instamojo = ProviderInstamojo::where('provider_id', $service->provider_id)->first();

        $instamojoPayment = InstamojoPayment::first();
        $price = ($total_price - $coupon_discount) * $instamojoPayment->currency_rate;
        $price = round($price,2);

        $environment = $provider_instamojo->account_mode;
        $api_key = $provider_instamojo->api_key;
        $auth_token = $provider_instamojo->auth_token;

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
            'redirect_url' => route('user.sub.response-instamojo'),
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

        $order_info = Session::get('order_info');

        $exist = $this->checkAvaibalityBeforPayment($service, $order_info->date, $order_info->schedule_time_slot);

        if($exist > 0){
            $notification = trans('user_validation.This schedule already booked. please choose another schedule');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('ready-to-booking', $service->slug)->with($notification);
        }

        $input = $request->all();

        $provider_instamojo = ProviderInstamojo::where('provider_id', $service->provider_id)->first();
        $instamojoPayment = InstamojoPayment::first();
        $environment = $provider_instamojo->account_mode;
        $api_key = $provider_instamojo->api_key;
        $auth_token = $provider_instamojo->auth_token;

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

        $extra_services = json_decode($order_info->extras);
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

        $coupon_discount = 0.00;
        if(Session::get('coupon_code') && Session::get('offer_percentage')) {
            $offer_percentage = Session::get('offer_percentage');
            $coupon_discount = ($offer_percentage / 100) * ($service->price + $additional_amount);

            $coupon = Coupon::where(['coupon_code' => Session::get('coupon_code')])->first();

            if($coupon){
                $history = new CouponHistory();
                $history->user_id = $client_id;
                $history->provider_id = $coupon->provider_id;
                $history->coupon_code = $coupon->coupon_code;
                $history->coupon_id = $coupon->id;
                $history->discount_amount = $coupon_discount;
                $history->save();
            }

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
        $order->coupon_discount  = $coupon_discount;
        $order->total_amount = (($service->price + $additional_amount) - $coupon_discount);
        $order->payment_method = $payment_method;
        $order->transection_id = $tnx_info;
        $order->payment_status = $payment_status;
        $order->order_status = 'awaiting_for_provider_approval';
        $order->package_features = $service->package_features;
        $order->additional_services = $order_additional_services;
        $order->order_note = $order_note;
        $order->client_address = json_encode($client_address);
        $order->save();

        Session::forget('coupon_code');
        Session::forget('offer_percentage');

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
}
