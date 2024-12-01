<?php

namespace Modules\Subscription\Http\Controllers\Provider;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Subscription\Entities\SubscriptionPlan;
use Modules\Subscription\Entities\PurchaseHistory;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\Gateway;
use App\Models\RazorpayPayment;
use App\Models\Flutterwave;
use App\Models\PaystackAndMollie;
use App\Models\InstamojoPayment;
use App\Models\CurrencyCountry;
use App\Models\Currency;
use App\Models\BankPayment;
use App\Models\StripePayment;
use App\Models\PaypalPayment;
use Stripe;
use Str;
use Razorpay\Api\Api;
use Exception;
use Redirect;
use Auth;
use Session;
use Mollie\Laravel\Facades\Mollie;

class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $auth_user = Auth::guard('web')->user();

        $histories = PurchaseHistory::with('provider')->orderBy('id','desc')->where('provider_id', $auth_user->id)->paginate(20);

        return view('subscription::provider.purchase_history', compact('histories'));
    }

    public function pending_payment()
    {
        $auth_user = Auth::guard('web')->user();

        $pageTitle = 'Pending Payment';

        $histories = PurchaseHistory::with('provider')->orderBy('id','desc')->where('payment_status','pending')->where('provider_id', $auth_user->id)->paginate(20);

        return view('subscription::provider.purchase_history', compact('histories'));
    }

    public function show($id)
    {
        $history = PurchaseHistory::with('provider')->where('id', $id)->first();

        return view('subscription::provider.purchase_history_show', compact('history'));
    }


    public function subscription_plan(){

        $plans = SubscriptionPlan::where('status', 1)->orderBy('serial','asc')->get();

        return view('subscription::provider.subscription_plan', compact('plans'));
    }

    public function subscription_payment($id){

        $user = Auth::guard('web')->user();

        $plan = SubscriptionPlan::where('status', 1)->orderBy('serial','asc')->where('id', $id)->first();

        $bank_payment = BankPayment::select('id','status','account_info','image')->first();
        $stripe = StripePayment::first();
        $paypal = PaypalPayment::first();

        $razorpay = RazorpayPayment::first();
        $flutterwave = Flutterwave::first();
        $mollie = PaystackAndMollie::first();
        $paystack = $mollie;
        $instamojo = InstamojoPayment::first();

        return view('subscription::provider.subscription_payment', compact('plan','stripe','paypal','razorpay','flutterwave','paystack','mollie','instamojo','bank_payment','user'));
    }

    public function free_enroll(Request $request, $id){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $user = Auth::guard('web')->user();

        $free_exist = PurchaseHistory::where('provider_id', $user->id)->where(['payment_method' => 'Free'])->count();

        if($free_exist == 0){
            $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();
            $this->store_subscription($user, $plan, 'Free', 'free_enroll', 'success');

            $notification = trans('user_validation.Enrolled Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('provider.purchase-history')->with($notification);

        }else{
            $notification = trans('user_validation.You have already enrolled trail version');

            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }


    }

    public function stripe_payment(Request $request, $id){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $stripe = StripePayment::first();

        $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();

        $payingAmount = (int)($plan->plan_price * $stripe->currency_rate);

        Stripe\Stripe::setApiKey($stripe->stripe_secret);

        $payment = Stripe\Charge::create([
            "amount" => $payingAmount * 100,
            "currency" => $stripe->currency_code,
            "source" => $request->stripeToken,
            "description" => "Payment For Subscription"
        ]);

        $responseData = $payment->jsonSerialize();
        $transaction = $responseData['balance_transaction'];

        $user = Auth::guard('web')->user();
        $this->store_subscription($user, $plan, 'Stripe', $transaction, 'success');

        $notification = trans('user_validation.Enrolled Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('provider.purchase-history')->with($notification);

    }

    public function razorpay_payment(Request $request, $id){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $razorpay = RazorpayPayment::first();

        $input = $request->all();
        $api = new Api($razorpay->key,$razorpay->secret_key);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $transaction = $request->razorpay_payment_id;

                $user=Auth::guard('web')->user();

                $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();

                $this->store_subscription($user, $plan, 'Razorpay', $transaction, 'success');

                $notification = trans('user_validation.Enrolled Successfully');
                $notification = array('messege'=>$notification,'alert-type'=>'success');
                return redirect()->route('provider.purchase-history')->with($notification);

            } catch (Exception $e) {
                $notification = trans('user_validation.Something went wrong');
                $notification = array('messege'=>$notification,'alert-type'=>'error');
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = trans('user_validation.Something went wrong');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

    }

    public function flutterwave_payment(Request $request){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

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
            $user=Auth::guard('web')->user();

            $plan = SubscriptionPlan::where('status', 1)->where('id', $request->plan_id)->first();

            $transaction = $request->tnx_id;

            $this->store_subscription($user, $plan, 'Flutterwave', $transaction, 'success');

            return response()->json(['status' => 'success', 'message' => trans('user_validation.Enrolled Successfully')]);
        }else{
            return response()->json(['status' => 'error', 'message' => trans('user_validation.Something went wrong')]);
        }
    }

    public function paystack_payment(Request $request){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $mollie = PaystackAndMollie::first();
        $paystack = $mollie;
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
            $user=Auth::guard('web')->user();

            $plan = SubscriptionPlan::where('status', 1)->where('id', $request->plan_id)->first();

            $this->store_subscription($user, $plan, 'Paystack', $transaction, 'success');

            return response()->json(['status' => 'success', 'message' => 'Enrolled Successfully']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Something Goes Wrong']);
        }

    }

    public function mollie_payment($id){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $mollie = PaystackAndMollie::first();
        $user=Auth::guard('web')->user();

        $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();
        $plan_price = $plan->plan_price;

        $payableAmount = round($plan_price * $mollie->mollie_currency_rate);
        $payableAmount= sprintf('%0.2f', $payableAmount);

        $mollie_api_key = $mollie->mollie_key;
        $currency = strtoupper($mollie->mollie_currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => ''.$payableAmount.'',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('provider.subscription.mollie-success-payment'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id',$payment->id);
        session()->put('plan_id',$id);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function mollie_success_payment(Request $request){
        $mollie = PaystackAndMollie::first();
        $mollie_api_key = $mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));
        if ($payment->isPaid()){

            $plan_id = Session::get('plan_id');
            $payment_id = Session::get('payment_id');

            $transaction = $payment_id;

            $user=Auth::guard('web')->user();

            $plan = SubscriptionPlan::where('status', 1)->where('id', $plan_id)->first();

            $this->store_subscription($user, $plan, 'Mollie', $transaction, 'success');

            $notification = trans('user_validation.Enrolled Successfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('provider.purchase-history')->with($notification);

        }else{
            $notification = trans('user_validation.Something went wrong');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('provider.subscription-payment', $plan_id)->with($notification);
        }
    }

    public function instamojo_payment($id){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $instamojoPayment = InstamojoPayment::first();
        $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();
        $user=Auth::guard('web')->user();
        $plan_price = $plan->plan_price;
        $payableAmount = round($plan_price * $instamojoPayment->currency_rate);
        $price = $payableAmount;
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
            'buyer_name' => $user->fname.' '.$user->lname,
            'redirect_url' => route('provider.subscription.instamojo-success-payment'),
            'send_email' => true,
            'webhook' => 'http://www.example.com/webhook/',
            'send_sms' => true,
            'email' => $user->email,
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        session()->put('plan_id',$id);
        return redirect($response->payment_request->longurl);
    }

    public function instamojo_success_payment(Request $request){
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
            $plan_id = Session::get('plan_id');

            $notification = trans('user_validation.Something went wrong');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('provider.subscription-payment', $plan_id)->with($notification);

        } else {
            $data = json_decode($response);
        }

        if($data->success == true) {
            if($data->payment->status == 'Credit') {
                $plan_id = Session::get('plan_id');
                $payment_id = $request->get('payment_id');
                $transaction = $payment_id;

                $user = Auth::guard('web')->user();

                $plan = SubscriptionPlan::where('status', 1)->where('id', $plan_id)->first();

                $this->store_subscription($user, $plan, 'Instamojo', $transaction, 'success');

                $notification = trans('user_validation.Enrolled Successfully');
                $notification = array('messege'=>$notification,'alert-type'=>'success');
                return redirect()->route('provider.purchase-history')->with($notification);

            }
        }else{
            $plan_id = Session::get('plan_id');
            $notification = trans('user_validation.Something went wrong');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->route('provider.subscription-payment', $plan_id)->with($notification);
        }

    }

    public function bank_payment(Request $request, $id){

        if(env('APP_MODE') == 'DEMO'){
            $notification = trans('This Is Demo Version. You Can Not Change Anything');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $transaction = $request->transaction;

        $user = Auth::guard('web')->user();

        $plan = SubscriptionPlan::where('status', 1)->where('id', $id)->first();

        $this->store_subscription($user, $plan, 'Bank Payment', $transaction, 'pending');

        $notification = trans('user_validation.Enrolled Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('provider.purchase-history')->with($notification);
    }

    public function store_subscription($user, $subscription_plan, $payment_gateway, $transaction, $payment_status, $bank_payment_proof = null){
        $purchase = new PurchaseHistory();

        if($subscription_plan->expiration_date == 'monthly'){
            $expiration_date = date('Y-m-d', strtotime('30 days'));
        }elseif($subscription_plan->expiration_date == 'yearly'){
            $expiration_date = date('Y-m-d', strtotime('365 days'));
        }elseif($subscription_plan->expiration_date == 'lifetime'){
            $expiration_date = 'lifetime';
        }

        if($payment_status == 'success'){
            PurchaseHistory::where('provider_id', $user->id)->update(['status' => 'expired']);
        }


        $purchase->provider_id = $user->id;
        $purchase->plan_id = $subscription_plan->id;
        $purchase->plan_name = $subscription_plan->plan_name;
        $purchase->plan_price = $subscription_plan->plan_price;
        $purchase->expiration = $subscription_plan->expiration_date;
        $purchase->expiration_date = $expiration_date;
        $purchase->maximum_service = $subscription_plan->maximum_service;
        if($payment_status == 'success'){
            $purchase->status = 'active';
        }else{
            $purchase->status = 'pending';
        }

        $purchase->payment_method = $payment_gateway;
        $purchase->payment_status = $payment_status;
        $purchase->transaction = $transaction;
        $purchase->save();

    }




}
