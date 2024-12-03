<?php 

namespace Modules\Subscription\Http\Controllers\User;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\MidtransPayment;
use App\Models\Service;
use Illuminate\Routing\Controller;
use Str;
use Auth;
use Session;
use Log;
use App\Models\AdditionalService;
use Illuminate\Http\Request;
use App\Models\Order;

class MidtransController extends Controller{
    private $serverKey;
    public function __construct(){
        $midtrans = MidtransPayment::first();
        $this->serverKey = $midtrans->server_key;
        Config::$serverKey = $midtrans->server_key;
        Config::$isProduction = $midtrans->account_mode == 'sandbox' ? false : true;
    }
    
    public function payWithMidtrans($slug)
    {
        if (env('APP_MODE') == 'DEMO') {
            $notification = trans('user_validation.This Is Demo Version. You Can Not Change Anything');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        // Find the service based on the slug
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

        // Generate order ID and fetch order details from session
        $order_id = Str::uuid();
        $user = Auth::guard('web')->user();
        $order_info =  Session::get('order_info');
        $extra_services = json_decode($order_info->extras, true); // Menggunakan '->' untuk properti objek
        $total_price = $service->price + $order_info->extra_price;

        // Set up parameters for the payment transaction
        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $total_price,
            ],
            'customer_details' => [
                'first_name' => $order_info->customer->name,  // Akses properti objek customer
                'email' => $order_info->customer->email,
                'phone' => $order_info->customer->phone,
                'notes' => $order_info->customer->order_note,
            ],
            'item_details' => [
                [
                    'id' => $service->id,
                    'price' => $service->price,
                    'quantity' => 1,
                    'name' => $service->name,
                ],
            ],
            'callbacks'=>[
                'finish'=>route('payment.midtrans.finish')
            ]
        ];

        try {
            // Generate Snap token
            $response = (array) Snap::createTransaction($params);
            $extra_services = json_decode($order_info->extras);
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
            // Save order details to database
            $order = new Order();
            $order->order_id = $order_id;
            $order->service_id = $service->id;
            $order->client_id = $user->id;
            $order->provider_id = $service->provider_id;
            $order->package_amount = $service->price;
            $order->total_amount = $total_price;
            $order->payment_status = 'pending';
            $order->payment_method = 'midtrans';
            $order->order_status = 'awaiting_for_provider_approval';
            $order->booking_date = $order_info->date;
            $order->schedule_time_slot = $order_info->schedule_time_slot;
            $order->additional_amount = $order_info->extra_price;
            $order->package_features = json_encode($order_info->package_features);
            $order->additional_services = $order_additional_services;
            $order->client_address = json_encode($order_info->customer);
            $order->order_note = $order_info->customer->order_note;
            $order->coupon_discount = $order_info->coupon_discount ?? 0;
            $order->created_at = now();
            $order->updated_at = now();
            $order->save();

            // Redirect to Midtrans payment page
            Session::put('service', $service);
            return redirect($response['redirect_url']);
        } catch (\Exception $e) {
            // Handle payment failure
            Log::info($e->getMessage());
            $notification = trans('user_validation.Payment Faild');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    public function payFinish(Request $request)
    {
        $service = Session::get('service');
        if(!$service){
            return abort(404);
        }
        if($request->has('order_id') && $request->has('transaction_status')){
            $order = Order::where('order_id',$request->input('order_id'))->first();
            if(!$order) return abort(404);
        }else{
            return abort(404);
        }
        if($request -> input('transaction_status') == 'settlement'){ 
            $notification = trans('user_validation.Your order has been placed. Thanks for your new order');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
        }else{
            $notification = trans('user_validation.Payment Faild');
            $notification = array('messege'=>$notification,'alert-type'=>'error');
        }
        Session::forget('order_info');
        if(!empty(session('return_from_mollie'))){
            Session::forget('return_from_mollie');
        } 
        Session::forget('service');
        return redirect()->route('dashboard')->with($notification);
    }


    public function webhook(Request $request)
    {
        $json = $request->getContent();
        $data = json_decode($json, true);

        // Verify the signature key
        if ($data['signature_key'] != hash('sha512', $data['order_id'] . $data['status_code'].$data['gross_amount']. $this -> serverKey)) {
            return response()->json(['status' => 'invalid'], 400);
        }

        // Handle the payment status (success/fail)
        $order = Order::where('order_id', $data['order_id'])->first();
        if ($order) {
            $order->payment_status = $data['transaction_status'] == 'settlement' ? 'success' : 'failed';
            $order->save();
        }

        return response()->json(['status' => 'ok']);
    }
}