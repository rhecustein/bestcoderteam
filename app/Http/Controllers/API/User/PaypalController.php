<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\PaymentExecution;

use App\Mail\OrderSuccessfully;
use App\Helpers\MailHelper;
use App\Models\EmailTemplate;
use App\Models\PaypalPayment;
use App\Models\BreadcrumbImage;
use App\Models\Service;
use App\Models\AdditionalService;
use App\Models\Order;
use App\Models\Setting;

use Str;
use Cart;
use Mail;
use Session;
use Auth;


class PaypalController extends Controller
{
    private $apiContext;
    public function __construct()
    {
        $account = PaypalPayment::first();
        $paypal_conf = \Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $account->client_id,
            $account->secret_id,
            )
        );

        $setting=array(
            'mode' => $account->account_mode,
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'ERROR'
        );
        $this->apiContext->setConfig($setting);
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

    public function payWithPaypal(Request $request){
        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');

            return response()->json(['message', $notification]);
        }


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

        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
        $user = Auth::guard('api')->user();

        $provider_id = $service->provider_id;
        $client_id = $user->id;

        $paypalSetting = PaypalPayment::first();
        $payableAmount = round($total_price * $paypalSetting->currency_rate,2);

        $name=env('APP_NAME');

        // set payer
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // set amount total
        $amount = new Amount();
        $amount->setCurrency($paypalSetting->currency_code)
            ->setTotal($payableAmount);

        // transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription(env('APP_NAME'));

        // redirect url
        $redirectUrls = new RedirectUrls();

        $root_url=url('/');
        $redirectUrls->setReturnUrl(route('paypal-payment-success-webview'))
            ->setCancelUrl(route('paypal-payment-cancled-webview'));

        // payment
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $ex) {

            return redirect()->route('webview-payment-faild');
        }

        // get paymentlink
        $approvalUrl = $payment->getApprovalLink();

        Session::put('service', $service);

        return redirect($approvalUrl);
    }

    public function paypalPaymentSuccess(Request $request){

        $service = Session::get('service');

        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            return redirect()->route('webview-payment-faild');
        }

        $payment_id=$request->get('paymentId');
        $payment = Payment::get($payment_id, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() == 'approved') {


            $service = Service::where(['slug' => $service->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
            $user = Session::get('user');
            $order_info = Session::get('order_info');
            $order_info = json_decode($order_info);
            $provider_id = $service->provider_id;
            $client_id = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Paypal', 'success', $payment_id);

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
        }
    }

    public function paypalPaymentCancled(){
        Session::forget('order_info');
        Session::forget('slug');
        Session::forget('request_from');
        Session::forget('user');
        Session::forget('frontend_success_url');
        Session::forget('frontend_faild_url');

        return redirect()->route('webview-payment-faild');
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

        $order = new Order();
        $order->order_id = substr(rand(0,time()),0,10);
        $order->booking_date = $order_info->date;
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


}
