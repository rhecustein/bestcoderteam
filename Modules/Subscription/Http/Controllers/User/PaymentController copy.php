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

class PaymentController extends Controller
{

    public function payment($booking_id)
    {

        $booking = Booking::find($booking_id);
        $service = Service::where('id', $booking->service_id)->first();
        $service_author_id = $service->user_id;

        $user = Auth::guard('web')->user();

        $pageTitle = "Payment";

        $stripe = Gateway::where('id', 3)->first();
        $paypal = Gateway::where('id', 2)->first();
        $bank_payment = Gateway::where('id', 4)->first();

        $razorpay = RazorpayPayment::first();
        $flutterwave = FlutterwavePayment::first();
        $paystack = PaystackPayment::first();
        $mollie = MolliePayment::first();
        $instamojo = InstamojoPayment::first();
        $handcash = $razorpay;

        $provider_stripe = ProviderStripe::where('provider_id', $service_author_id)->first();
        $provider_razorpay = ProviderRazorpay::where('provider_id', $service_author_id)->first();
        $provider_flutterwave = ProviderFlutterwave::where('provider_id', $service_author_id)->first();
        $provider_paystack = ProviderPaystack::where('provider_id', $service_author_id)->first();
        $provider_mollie = ProviderMollie::where('provider_id', $service_author_id)->first();
        $provider_instamojo = ProviderInstamojo::where('provider_id', $service_author_id)->first();
        $provider_ban_handcash = ProviderBankHandcash::where('provider_id', $service_author_id)->first();

        return view('subscription::user.payment', compact('pageTitle','booking','stripe','paypal','razorpay','flutterwave','paystack','mollie','instamojo','bank_payment','handcash','user','provider_stripe','provider_razorpay','provider_flutterwave','provider_paystack','provider_mollie','provider_instamojo','provider_ban_handcash'));
    }

    public function stripe_payment(Request $request, $booking_id){

        $booking = Booking::find($booking_id);
        if($booking->payment_confirmed == 1){
            $notify[] = ['error', 'Payment already done'];
            return redirect()->back()->withNotify($notify);
        }
        $service = Service::where('id', $booking->service_id)->first();
        $service_author_id = $service->user_id;

        $provider_stripe = ProviderStripe::where('provider_id', $service_author_id)->first();

        $stripe = Gateway::where('id', 3)->first();

        $payingAmount = (int)($booking->amount * $stripe->rate);

        Stripe\Stripe::setApiKey($provider_stripe->stripe_secret);

        $payment = Stripe\Charge::create([
            "amount" => $payingAmount * 100,
            "currency" => $stripe->gateway_parameters->gateway_currency,
            "source" => $request->stripeToken,
            "description" => "Paid for ".$service->name
        ]);

        $responseData = $payment->jsonSerialize();
        $transaction = $responseData['balance_transaction'];
        $fee_amount = $booking->amount;

        self::updateUserData($booking, $fee_amount, $transaction);

        $notify[] = ['success', 'Payment Successfully Done'];
        return redirect()->route('user.bookings')->withNotify($notify);

    }

    public function razorpay_payment(Request $request, $booking_id){

        $booking = Booking::find($booking_id);
        if($booking->payment_confirmed == 1){
            $notify[] = ['error', 'Payment already done'];
            return redirect()->back()->withNotify($notify);
        }
        $service = Service::where('id', $booking->service_id)->first();
        $service_author_id = $service->user_id;

        $provider_razorpay = ProviderRazorpay::where('provider_id', $service_author_id)->first();

        $razorpay=RazorpayPayment::first();
        $input = $request->all();
        $api = new Api($provider_razorpay->key,$provider_razorpay->secret_key);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $transaction = $request->razorpay_payment_id;

                $fee_amount = $booking->amount;

                self::updateUserData($booking, $fee_amount, $transaction);

                $notify[] = ['success', 'Payment Successfully Done'];
                return redirect()->route('user.bookings')->withNotify($notify);


            } catch (Exception $e) {
                $notify[] = ['error', 'Something Goes Wrong 2 '];
                return redirect()->back()->withNotify($notify);
            }
        }else{
            $notify[] = ['error', 'Something Goes Wrong 1'];
            return redirect()->back()->withNotify($notify);
        }

    }

    public function flutterwave_payment(Request $request){
        $booking_id = $request->booking_id;
        $booking = Booking::find($booking_id);
        if($booking->payment_confirmed == 1){
            return response()->json(['status' => 'error', 'message' => 'Something Goes Wrong']);
        }

        $service = Service::where('id', $booking->service_id)->first();
        $service_author_id = $service->user_id;

        $provider_flutterwave = ProviderFlutterwave::where('provider_id', $service_author_id)->first();

        $flutterwave=FlutterwavePayment::first();

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
            $user=Auth::guard('web')->user();

            $transaction = $request->tnx_id;

            $fee_amount = $booking->amount;

            self::updateUserData($booking, $fee_amount, $transaction);

            return response()->json(['status' => 'success', 'message' => 'Payment Successfully Done']);
        }else{
            return response()->json(['status' => 'error', 'message' => 'Something Goes Wrong']);
        }

    }

    public function paystack_payment(Request $request){
        $booking_id = $request->booking_id;
        $booking = Booking::find($booking_id);
        if($booking->payment_confirmed == 1){
            return response()->json(['status' => 'error', 'message' => 'Something Goes Wrong']);
        }

        $service = Service::where('id', $booking->service_id)->first();
        $service_author_id = $service->user_id;

        $provider_paystack = ProviderPaystack::where('provider_id', $service_author_id)->first();

        $paystack = PaystackPayment::first();
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

            $fee_amount = $booking->amount;

            self::updateUserData($booking, $fee_amount, $transaction);

            return response()->json(['status' => 'success', 'message' => 'Payment Successfully Done']);

        }else{
            return response()->json(['status' => 'error', 'message' => 'Something Goes Wrong']);
        }
    }


    public function mollie_payment($booking_id){

        if(env('APP_VERSION') == 'demo'){
            $notify[] = ['error','This Is Demo Version. You Can Not Change Anything'];

            return back()->withNotify($notify);
        }

        $booking = Booking::find($booking_id);
        if($booking->payment_confirmed == 1){
            $notify[] = ['error', 'Payment already done'];
            return redirect()->back()->withNotify($notify);
        }

        $service = Service::where('id', $booking->service_id)->first();
        $service_author_id = $service->user_id;

        $provider_mollie = ProviderMollie::where('provider_id', $service_author_id)->first();

        $mollie = MolliePayment::first();
        $user=Auth::guard('web')->user();

        $payableAmount = round($booking->amount * $mollie->currency_rate);
        $payableAmount= sprintf('%0.2f', $payableAmount);

        $mollie_api_key = $provider_mollie->mollie_key;
        $currency = strtoupper($mollie->currency_code);
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $currency,
                'value' => ''.$payableAmount.'',
            ],
            'description' => env('APP_NAME'),
            'redirectUrl' => route('user.sub.mollie-success-payment'),
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);
        session()->put('payment_id',$payment->id);
        session()->put('booking_id',$booking_id);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function mollie_payment_success(Request $request){

        $booking_id = Session::get('booking_id');
        $booking = Booking::find($booking_id);
        if($booking->payment_confirmed == 1){
            $notify[] = ['error', 'Payment already done'];
            return redirect()->route('user.sub.payment', $booking_id)->withNotify($notify);
        }

        $service = Service::where('id', $booking->service_id)->first();
        $service_author_id = $service->user_id;

        $provider_mollie = ProviderMollie::where('provider_id', $service_author_id)->first();

        $mollie = MolliePayment::first();
        $mollie_api_key = $provider_mollie->mollie_key;
        Mollie::api()->setApiKey($mollie_api_key);
        $payment = Mollie::api()->payments->get(session()->get('payment_id'));
        if ($payment->isPaid()){

            $payment_id = Session::get('payment_id');

            $transaction = $payment_id;

            $fee_amount = $booking->amount;

            self::updateUserData($booking, $fee_amount, $transaction);

            $notify[] = ['success', 'Payment Successfully Done'];
            return redirect()->route('user.bookings')->withNotify($notify);

        }else{
            $notify[] = ['error', 'Something Goes Wrong'];
            return redirect()->route('user.sub.payment', $booking_id)->withNotify($notify);
        }

    }

    public function instamojo_payment($booking_id){

        if(env('APP_VERSION') == 'demo'){
            $notify[] = ['error','This Is Demo Version. You Can Not Change Anything'];

            return back()->withNotify($notify);
        }

        $booking = Booking::find($booking_id);
        if($booking->payment_confirmed == 1){
            $notify[] = ['error', 'Payment already done'];
            return redirect()->back()->withNotify($notify);
        }

        $service = Service::where('id', $booking->service_id)->first();
        $service_author_id = $service->user_id;
        $provider_instamojo = ProviderInstamojo::where('provider_id', $service_author_id)->first();

        $instamojoPayment = InstamojoPayment::first();

        $user=Auth::guard('web')->user();
        $booking_amount = $booking->amount;
        $payableAmount = round($booking_amount * $instamojoPayment->currency_rate);
        $price = $payableAmount;
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
            'buyer_name' => $user->fname.' '.$user->lname,
            'redirect_url' => route('user.sub.instamojo-success-payment'),
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
        session()->put('booking_id',$booking_id);
        return redirect($response->payment_request->longurl);

    }

    public function instamojo_payment_success(Request $request){

        $booking_id = Session::get('booking_id');
        $booking = Booking::find($booking_id);
        if($booking->payment_confirmed == 1){
            $notify[] = ['error', 'Payment already done'];
            return redirect()->route('user.sub.payment', $booking_id)->withNotify($notify);
        }

        $service = Service::where('id', $booking->service_id)->first();
        $service_author_id = $service->user_id;

        $provider_instamojo = ProviderInstamojo::where('provider_id', $service_author_id)->first();

        $input = $request->all();
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

            $notify[] = ['error', 'Something Goes Wrong'];
            return redirect()->route('user.sub.payment', $booking_id)->withNotify($notify);
        } else {
            $data = json_decode($response);
        }

        if($data->success == true) {
            if($data->payment->status == 'Credit') {
                $payment_id = $request->get('payment_id');
                $transaction = $payment_id;

                $fee_amount = $booking->amount;

                self::updateUserData($booking, $fee_amount, $transaction);

                $notify[] = ['success', 'Payment Successfully Done'];
                return redirect()->route('user.bookings')->withNotify($notify);
            }
        }else{
            $notify[] = ['error', 'Something Goes Wrong'];
            return redirect()->route('user.sub.payment', $booking_id)->withNotify($notify);
        }

    }

    public function bank_payment(Request $request, $booking_id){

        $booking = Booking::find($booking_id);
        if($booking->payment_confirmed == 1){
            $notify[] = ['error', 'Payment already done'];
            return redirect()->back()->withNotify($notify);
        }

        $gateway = Gateway::where('id', 4)->first();

        $validation = [];
        if ($gateway->user_proof_param != null) {
            foreach ($gateway->user_proof_param as $params) {
                if ($params['type'] == 'text' || $params['type'] == 'textarea') {

                    $key = strtolower(str_replace(' ', '_', $params['field_name']));

                    $validationRules = $params['validation'] == 'required' ? 'required' : 'sometimes';

                    $validation[$key] = $validationRules;
                } else {

                    $key = strtolower(str_replace(' ', '_', $params['field_name']));

                    $validationRules = ($params['validation'] == 'required' ? 'required' : 'sometimes') . "|image|mimes:jpg,png,jpeg|max:2048";

                    $validation[$key] = $validationRules;
                }
            }
        }

        $data = $request->validate($validation);

        foreach ($data as $key => $upload) {

            if ($request->hasFile($key)) {

                $filename = uploadImage($upload, filePath('manual_payment'));

                $data[$key] = ['file' => $filename, 'type' => 'file'];
            }
        }

        $booking->payment_proof = $data;

        $booking->payment_type = 0;

        $booking->payment_confirmed = 2;

        $booking->charge = $booking->amount;

        $booking->save();


        $notify[] = ['success', 'Your payment request has been taken.'];
        return redirect()->route('user.bookings')->withNotify($notify);
    }


    public function handcash_payment(Request $request, $booking_id){

        if(env('APP_VERSION') == 'demo'){
            $notify[] = ['error','This Is Demo Version. You Can Not Change Anything'];

            return back()->withNotify($notify);
        }

        $booking = Booking::find($booking_id);
        if($booking->payment_confirmed == 1){
            $notify[] = ['error', 'Payment already done'];
            return redirect()->back()->withNotify($notify);
        }

        $data['Method'] = 'Hand Cash';

        $transaction = 'hand_cash';

        $booking->payment_proof = $data;

        $booking->payment_type = 0;

        $booking->payment_confirmed = 2;

        $booking->charge = $booking->amount;

        $booking->save();


        $notify[] = ['success', 'Your payment request has been taken.'];
        return redirect()->route('user.bookings')->withNotify($notify);

    }


    public function manualPayment()
    {
        $pageTitle = "Manual Payments";

        $manuals = Booking::where('payment_type',0)->whereHas('service',function($q){$q->where('user_id',auth()->id());})->latest()->with('service','user')->paginate();

        return view('subscription::provider.manual_payments',compact('pageTitle','manuals'));
    }

    public function manualPaymentDetails (Request $request)
    {
        $pageTitle = "Payment Details";

        $manual = Booking::where('trx',$request->trx)->firstOrFail();

        $bank_payment_proof = $manual->payment_proof;

        return view('subscription::provider.manual_payments_details',compact('pageTitle','manual','bank_payment_proof'));
    }

    public function manualPaymentAccept(Request $request)
    {
        $booking = Booking::where('trx', $request->trx)->firstOrFail();
        $general = GeneralSetting::first();
        $gateway = Gateway::where('gateway_name','bank')->first();

        $booking->payment_confirmed = 1;
        $booking->save();

        Transaction::create([
            'trx' => $booking->trx,
            'user_id' => $booking->user_id,
            'service_id' => $booking->service_id,
            'amount' => $booking->amount,
            'currency' => $general->site_currency,
            'details' => 'Payment Accepted for '.$booking->service->name,
            'charge' => $booking->amount,
            'type' => '-'
        ]);

        Transaction::create([
            'trx' => $booking->trx,
            'user_id' => $booking->service->user->id,
            'service_id' => $booking->service_id,
            'amount' => $booking->amount,
            'currency' => $general->site_currency,
            'details' => 'Paid for '.$booking->service->name,
            'charge' => $booking->amount,
            'type' => '+'
        ]);

        sendMail('PAYMENT_CONFIRMED',['trx'=>$booking->trx,'amount'=>$booking->amount,'charge' => number_format($booking->charge,4),'service'=>$booking->name,'currency' => $general->site_currency ], $booking->user);

        sendMail('PAYMENT_RECEIVED',['trx'=>$booking->trx,'amount'=>$userAmount,'charge' => number_format($booking->charge,4),'service'=>$booking->name,'currency' => $general->site_currency], $booking->service->user);


        $notify[] = ['success', "Payment Confirmed Successfully"];

        return redirect()->back()->withNotify($notify);

    }

    public function manualPaymentReject(Request $request)
    {
        $manual = Booking::where('trx', $request->trx)->firstOrFail();
        $general = GeneralSetting::first();

        $manual->payment_confirmed = 3;

        $manual->save();


        sendMail('PAYMENT_REJECTED',['trx'=>$manual->trx,'amount'=>$manual->amount,'charge' => $manual->charge,'service'=>$manual->name,'currency' => $general->site_currency ], $manual->user);

        $notify[] = ['success', "Payment Rejected Successfully"];

        return redirect()->back()->withNotify($notify);

    }



    public static function updateUserData($booking, $fee_amount, $transaction)
    {
        $general = GeneralSetting::first();

        $booking->payment_confirmed = 1;
        $booking->save();

        Transaction::create([
            'trx' => $booking->trx,
            'user_id' => $booking->user_id,
            'service_id' => $booking->service_id,
            'amount' => $booking->amount,
            'currency' => $general->site_currency,
            'details' => 'Payment Successfull for ' . $booking->service->name,
            'charge' => $fee_amount,
            'type' => '-',
            'commission' => 0.00,
            'gateway_transaction' => $transaction
        ]);

        Transaction::create([
            'trx' => $booking->trx,
            'user_id' => $booking->service->user->id,
            'service_id' => $booking->service_id,
            'amount' => $booking->amount,
            'currency' => $general->site_currency,
            'details' => 'Paid for ' . $booking->service->name,
            'charge' => $fee_amount,
            'type' => '+',
            'commission' => 0.00,
            'gateway_transaction' => $transaction
        ]);

        sendMail('PAYMENT_SUCCESSFULL', [
            'service' => $booking->service->name,
            'trx' => $transaction,
            'amount' => $booking->amount,
            'currency' =>    $general->site_currency
        ], $booking->user);

        sendMail('PAYMENT_RECEIVED', [
            'service' => $booking->service->name,
            'trx' => $transaction,
            'amount' => 0.0,
            'currency' =>    $general->site_currency
        ], $booking->service->user);
    }
}
