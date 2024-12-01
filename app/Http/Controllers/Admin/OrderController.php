<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Setting;
use App\Models\OrderProduct;
use App\Models\OrderProductVariant;
use App\Models\OrderAddress;
use App\Models\RefundRequest;
use App\Models\CompleteRequest;
use App\Models\ProviderClientReport;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;

use Illuminate\Pagination\Paginator;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        Paginator::useBootstrap();

        $orders = Order::with('client','provider')->orderBy('id','desc');

        if($request->provider){
            $orders = $orders->where('provider_id', $request->provider);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);
        $title = trans('admin_validation.All Bookings');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $providers = User::where(['status' => 1, 'is_provider' => 1])->orderBy('name','asc')->get();
        $clients = User::where(['status' => 1, 'is_provider' => 0])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','currency_icon','providers','clients'));
    }

    public function awaitingBooking(Request $request){
        Paginator::useBootstrap();
        $orders = Order::with('client','provider')->orderBy('id','desc')->where('order_status','awaiting_for_provider_approval');

        if($request->provider){
            $orders = $orders->where('provider_id', $request->provider);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('admin_validation.Awaiting for approval');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $providers = User::where(['status' => 1, 'is_provider' => 1])->orderBy('name','asc')->get();
        $clients = User::where(['status' => 1, 'is_provider' => 0])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','currency_icon','providers','clients'));
    }

    public function activeBooking(Request $request){
        Paginator::useBootstrap();
        $orders = Order::with('client','provider')->orderBy('id','desc')->where('order_status','approved_by_provider');

        if($request->provider){
            $orders = $orders->where('provider_id', $request->provider);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('admin_validation.Active Booking');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $providers = User::where(['status' => 1, 'is_provider' => 1])->orderBy('name','asc')->get();
        $clients = User::where(['status' => 1, 'is_provider' => 0])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','currency_icon','providers','clients'));
    }

    public function completeBooking(Request $request){
        Paginator::useBootstrap();
        $orders = Order::with('client','provider')->orderBy('id','desc')->where('order_status','complete');

        if($request->provider){
            $orders = $orders->where('provider_id', $request->provider);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('admin_validation.Complete Booking');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $providers = User::where(['status' => 1, 'is_provider' => 1])->orderBy('name','asc')->get();
        $clients = User::where(['status' => 1, 'is_provider' => 0])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','currency_icon','providers','clients'));
    }

    public function declineBooking(Request $request){
        Paginator::useBootstrap();
        $orders = Order::with('client','provider')->orderBy('id','desc')->where('order_status','order_decliened_by_provider')->orWhere('order_status', 'order_decliened_by_client');

        if($request->provider){
            $orders = $orders->where('provider_id', $request->provider);
        }

        if($request->client){
            $orders = $orders->where('client_id', $request->client);
        }

        if($request->booking_id){
            $orders = $orders->where('order_id', $request->booking_id);
        }

        $orders = $orders->paginate(15);

        $title = trans('admin_validation.Declined Booking');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $providers = User::where(['status' => 1, 'is_provider' => 1])->orderBy('name','asc')->get();
        $clients = User::where(['status' => 1, 'is_provider' => 0])->orderBy('name','asc')->get();

        return view('admin.order', compact('orders','title','currency_icon','providers','clients'));
    }

    public function show($id){
        $order = Order::with('client','provider','service','refundRequest','completeRequest')->orderBy('id','desc')->where('order_id',$id)->first();
        $title = trans('admin_validation.Booking Details');
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        $booking_address = json_decode($order->client_address);
        $package_features = json_decode($order->package_features);

        $additional_services = json_decode($order->additional_services);
        $client = $order->client;
        $provider = $order->provider;

        $refundRequest = $order->refundRequest;
        $completeRequest = $order->completeRequest;

        return view('admin.show_order',compact('order','currency_icon','booking_address','package_features','additional_services','client','provider','refundRequest','completeRequest'));
    }

    public function updateOrderStatus(Request $request , $id){
        $rules = [
            'order_status' => 'required',
            'payment_status' => 'required',
        ];
        $this->validate($request, $rules);

        $order = Order::find($id);
        if($request->order_status == 0){
            $order->order_status = 0;
            $order->save();
        }else if($request->order_status == 1){
            $order->order_status = 1;
            $order->order_approval_date = date('Y-m-d');
            $order->save();
        }else if($request->order_status == 2){
            $order->order_status = 2;
            $order->order_delivered_date = date('Y-m-d');
            $order->save();
        }else if($request->order_status == 3){
            $order->order_status = 3;
            $order->order_completed_date = date('Y-m-d');
            $order->save();
        }else if($request->order_status == 4){
            $order->order_status = 4;
            $order->order_declined_date = date('Y-m-d');
            $order->save();
        }

        if($request->payment_status == 0){
            $order->payment_status = 0;
            $order->save();
        }elseif($request->payment_status == 1){
            $order->payment_status = 1;
            $order->payment_approval_date = date('Y-m-d');
            $order->save();
        }

        $notification = trans('admin_validation.Order Status Updated successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function destroy($id){
        $order = Order::find($id);

        CompleteRequest::where('order_id',$order->id)->delete();
        ProviderClientReport::where('order_id',$order->id)->delete();
        RefundRequest::where('order_id',$id)->delete();
        $tickets = Ticket::where('order_id', $order->id)->get();

        foreach($tickets as $ticket){
            $messages = TicketMessage::where('ticket_id', $ticket->id)->delete();
            foreach($messages as $message){
                $doucments = MessageDocument::where('ticket_message_id', $message->id)->get();
                foreach($doucments as $doucment){
                    $document_file = $doucment->file_name;
                    if($document_file){
                        if(File::exists(public_path().'/'.$document_file))unlink(public_path().'/'.$document_file);
                    }
                    $doucment->delete();
                }
                $message->delete();
            }
            $ticket->delete();
        }
        $order->delete();


        $notification = trans('admin_validation.Delete successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.all-booking')->with($notification);
    }


    public function bookingDecilendRequest($id){
        $order = Order::find($id);
        $order->order_status = 'order_decliened_by_provider';
        $order->save();

        $notification= trans('admin_validation.Declined Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function bookingApprovedRequest($id){
        $order = Order::find($id);
        $order->order_status = 'approved_by_provider';
        $order->save();

        $notification= trans('admin_validation.Approved Successfully');
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




    public function bookingCompleteRequest($id){
        $order = Order::find($id);
        $order->order_status = 'complete';
        $order->complete_by_admin = 'Yes';
        $order->save();

        $notification= trans('admin_validation.Mark as complete successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function RefundRequestDecilend($id){
        $refund = RefundRequest::find($id);
        $refund->status = 'decliened_by_admin';
        $refund->save();

        $notification= trans('admin_validation.Declined Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function RefundRequestApproved($id){
        $refund = RefundRequest::find($id);
        $refund->status = 'complete';
        $refund->save();

        $notification= trans('admin_validation.Request approved Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function refundRequest(){
        $refundRequests = RefundRequest::with('order','client')->orderBy('id','desc')->get();
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        return view('admin.refund_request', compact('refundRequests','currency_icon'));
    }


    public function completeRequest(){
        $completeRequests = CompleteRequest::WhereHas('order', function($order){
            $order->where('order_status', '!=', 'complete');
        })->with('order','provider')->orderBy('id','desc')->get();

        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        return view('admin.complete_request', compact('completeRequests','currency_icon'));
    }


    public function providerClientReport(){
        $reports = ProviderClientReport::with('client','provider','order')->orderBy('id','desc')->get();
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        return view('admin.provider_client_report', compact('reports','currency_icon'));
    }

    public function deleteProviderClientReport($id){
        $report = ProviderClientReport::find($id);
        $report->delete();

        $notification= trans('admin_validation.Delete Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
}
