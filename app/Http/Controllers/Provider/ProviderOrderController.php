<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CompleteRequest;
use App\Models\Setting;
use Auth;

use Illuminate\Pagination\Paginator;

class ProviderOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(Request $request){
        Paginator::useBootstrap();
        $provider = Auth::guard('web')->user();
        $orders = Order::with('client','service')->orderBy('id','desc')->where('provider_id', $provider->id);

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('user_validation.All Bookings');
        $setting = Setting::first();

        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status','awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status','approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status','complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status','order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();


        return view('provider.order', compact('orders','title','currency_icon','decliened_booking','total_awaiting','active_booking','complete_booking'));
    }

    public function awaitingBooking(Request $request){
        Paginator::useBootstrap();
        $provider = Auth::guard('web')->user();
        $orders = Order::with('client','service')->orderBy('id','desc')->where('order_status','awaiting_for_provider_approval')->where('provider_id', $provider->id);

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('user_validation.Awaiting for approval');
        $setting = Setting::first();

        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status','awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status','approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status','complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status','order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return view('provider.order', compact('orders','title','currency_icon','decliened_booking','total_awaiting','active_booking','complete_booking'));
    }

    public function activeBooking(Request $request){
        Paginator::useBootstrap();
        $provider = Auth::guard('web')->user();
        $orders = Order::with('client','service')->orderBy('id','desc')->where('order_status','approved_by_provider')->where('provider_id', $provider->id);

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('user_validation.Active Booking');
        $setting = Setting::first();

        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status','awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status','approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status','complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status','order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return view('provider.order', compact('orders','title','currency_icon','decliened_booking','total_awaiting','active_booking','complete_booking'));
    }

    public function completeBooking(Request $request){
        Paginator::useBootstrap();
        $provider = Auth::guard('web')->user();
        $orders = Order::with('client','service')->orderBy('id','desc')->where('order_status','complete')->where('provider_id', $provider->id);

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('user_validation.Complete Booking');
        $setting = Setting::first();

        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status','awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status','approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status','complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status','order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return view('provider.order', compact('orders','title','currency_icon','decliened_booking','total_awaiting','active_booking','complete_booking'));
    }

    public function declineBooking(Request $request){
        Paginator::useBootstrap();
        $provider = Auth::guard('web')->user();
        $orders = Order::with('client','service')->orderBy('id','desc')->where('provider_id', $provider->id)->where('order_status','order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client');

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('user_validation.Declined Booking');
        $setting = Setting::first();

        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status','awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status','approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status','complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status','order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return view('provider.order', compact('orders','title','currency_icon','decliened_booking','total_awaiting','active_booking','complete_booking'));
    }





    public function show($id){
        $order = Order::with('client','service','completeRequest')->where('order_id',$id)->first();
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;
        $client = $order->client;
        $booking_address = json_decode($order->client_address);
        $package_features = json_decode($order->package_features);

        $additional_services = json_decode($order->additional_services);
        $completeRequest = $order->completeRequest;


        return view('provider.show_order',compact('order','currency_icon','client', 'booking_address','package_features','additional_services','completeRequest'));
    }


    public function bookingDecilendRequest($id){
        $order = Order::find($id);
        $order->order_status = 'order_decliened_by_provider';
        $order->save();

        $notification= trans('user_validation.Declined Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function bookingApprovedRequest($id){
        $order = Order::find($id);
        $order->order_status = 'approved_by_provider';
        $order->save();

        $notification= trans('user_validation.Approved Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function paymentApproved($id){
        $order = Order::find($id);
        $order->payment_status = 'success';
        $order->save();

        $notification= trans('admin_validation.Approved Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function completeRequest(Request $request){

        Paginator::useBootstrap();

        $provider = Auth::guard('web')->user();
        $completeRequests = CompleteRequest::where('provider_id', $provider->id)->get();
        $order_id_array = array();

        foreach($completeRequests as $completeRequest){
            $order_id_array[] = $completeRequest->order_id;
        }

        $orders = Order::with('client','service')->whereIn('id', $order_id_array)->orderBy('id','desc')->where('provider_id', $provider->id)->where('order_status', '!=', 'complete');

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('user_validation.Complete Request');
        $setting = Setting::first();

        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $total_awaiting = Order::where('order_status','awaiting_for_provider_approval')->where('provider_id', $provider->id)->count();

        $active_booking = Order::where('order_status','approved_by_provider')->where('provider_id', $provider->id)->count();

        $complete_booking = Order::where('order_status','complete')->where('provider_id', $provider->id)->count();

        $decliened_booking = Order::where('provider_id', $provider->id)->where('order_status','order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client')->count();

        return view('provider.order', compact('orders','title','currency_icon','decliened_booking','total_awaiting','active_booking','complete_booking'));
    }


    public function sendCompleteRequest(Request $request){
        $user = Auth::guard('web')->user();
        $rules = [
            'resone'=>'required',
            'order_id'=>'required',
        ];
        $customMessages = [
            'resone.required' => trans('user_validation.Resone is required'),
            'order_id.required' => trans('user_validation.Order id is required'),
        ];
        $this->validate($request, $rules,$customMessages);

        $data = new CompleteRequest();
        $data->provider_id = $user->id;
        $data->order_id = $request->order_id;
        $data->resone = $request->resone;
        $data->save();

        $notification= trans('user_validation.Request Send Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


}
