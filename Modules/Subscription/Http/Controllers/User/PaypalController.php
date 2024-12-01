<?php

namespace Modules\Subscription\Http\Controllers\User;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Subscription\Entities\SubscriptionPlan;
use Modules\Subscription\Entities\PurchaseHistory;
use Modules\Subscription\Entities\ProviderPaypal;

use Auth;
use Session;

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

class PaypalController extends Controller
{

    private $apiContext;


    public function payWithPaypal($slug){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        $service = Service::where(['slug' => $slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();

        // setup config

        $provider_paypal = ProviderPaypal::where('provider_id', $service->provider_id)->first();

        $account = PaypalPayment::first();
        $paypal_conf = \Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $provider_paypal->client_id,
            $provider_paypal->secret_id,
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

        // setup config



        $user = Auth::guard('web')->user();
        $order_info = Session::get('order_info');
        $provider_id = $service->provider_id;
        $client_id = $user->id;
        $total_price = $service->price + $order_info->extra_price;

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
        $redirectUrls->setReturnUrl(route('user.sub.paypal-payment-success'))
            ->setCancelUrl(route('user.sub.paypal-payment-cancled'));

        // payment
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $ex) {

            $notification = trans('user_validation.Payment Faild');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        // get paymentlink
        $approvalUrl = $payment->getApprovalLink();

        Session::put('service', $service);

        return redirect($approvalUrl);
    }

    public function paypalPaymentSuccess(Request $request){

        Session::put('return_from_mollie','payment_faild');
        $service = Session::get('service');

        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            $notification = trans('user_validation.Payment Faild');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->route('payment', $service->slug)->with($notification);
        }

        // setup config

        $provider_paypal = ProviderPaypal::where('provider_id', $service->provider_id)->first();

        $account = PaypalPayment::first();
        $paypal_conf = \Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
            $provider_paypal->client_id,
            $provider_paypal->secret_id,
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

        // setup config


        $payment_id=$request->get('paymentId');
        $payment = Payment::get($payment_id, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() == 'approved') {

            $service = Service::where(['slug' => $service->slug, 'approve_by_admin' => 1, 'status' => 1, 'is_banned' => 0])->first();
            $user = Auth::guard('web')->user();
            $order_info = Session::get('order_info');
            $provider_id = $service->provider_id;
            $client_id = $user->id;

            $order = $this->createOrder($user, $service, $order_info, $provider_id, $client_id, 'Paypal', 'success', $payment_id);

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
    }

    public function paypalPaymentCancled(){
        Session::put('return_from_mollie','payment_faild');
        $service = Session::get('service');

        $notification = trans('user_validation.Payment Faild');
        $notification = array('messege'=>$notification,'alert-type'=>'error');
        return redirect()->route('payment', $service->slug)->with($notification);
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
