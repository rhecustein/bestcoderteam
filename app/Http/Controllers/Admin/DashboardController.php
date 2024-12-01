<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Setting;
use App\Models\ProviderWithdraw;
use App\Models\RefundRequest;
use App\Models\User;

use App\Models\Service;
use App\Models\Blog;
use App\Models\Subscriber;



class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashobard(){

        $todayOrders = Order::orderBy('id','desc')->whereDay('created_at', now()->day)->get();

        $today_total_order = $todayOrders->count();
        $today_total_awating_order = $todayOrders->where('order_status','awaiting_for_provider_approval')->count();
        $today_approved_order = $todayOrders->where('order_status','approved_by_provider')->count();
        $today_complete_order = $todayOrders->where('order_status','complete')->count();
        $today_declined_order = $todayOrders->where('order_status','order_decliened_by_provider')->count();

        $today_total_earning = $todayOrders->where('payment_status','success')->sum('total_amount');

        $today_withdraws = ProviderWithdraw::whereDay('created_at', now()->day)->get();
        $today_withdraw_request = $today_withdraws->sum('total_amount');

        $refundRequests = RefundRequest::with('order')->whereDay('created_at', now()->day)->get();
        $today_total_refund = 0;
        foreach($refundRequests as $refundRequest){
            $today_total_refund += $refundRequest->order->total_amount;
        }

        $today_users = User::whereDay('created_at', now()->day)->count();

        // end today

        // start this month

        $monthlyOrders = Order::orderBy('id','desc')->whereMonth('created_at', now()->month)->get();

        $monthly_total_order = $monthlyOrders->count();
        $monthly_total_awating_order = $monthlyOrders->where('order_status','awaiting_for_provider_approval')->count();
        $monthly_approved_order = $monthlyOrders->where('order_status','approved_by_provider')->count();
        $monthly_complete_order = $monthlyOrders->where('order_status','complete')->count();
        $monthly_declined_order = $monthlyOrders->where('order_status','order_decliened_by_provider')->count();

        $monthly_total_earning = $monthlyOrders->where('payment_status','success')->sum('total_amount');

        $monthly_withdraws = ProviderWithdraw::whereMonth('created_at', now()->month)->get();
        $monthly_withdraw_request = $today_withdraws->sum('total_amount');

        $refundRequests = RefundRequest::with('order')->whereMonth('created_at', now()->month)->get();

        $monthly_total_refund = 0;
        foreach($refundRequests as $refundRequest){
            $monthly_total_refund += $refundRequest->order->total_amount;
        }

        $monthly_users = User::whereMonth('created_at', now()->month)->count();

        // end monthly

        // start yearly

        $yearlyOrders = Order::orderBy('id','desc')->whereYear('created_at', now()->year)->get();

        $yearly_total_order = $yearlyOrders->count();
        $yearly_total_awating_order = $yearlyOrders->where('order_status','awaiting_for_provider_approval')->count();
        $yearly_approved_order = $yearlyOrders->where('order_status','approved_by_provider')->count();
        $yearly_complete_order = $yearlyOrders->where('order_status','complete')->count();
        $yearly_declined_order = $yearlyOrders->where('order_status','order_decliened_by_provider')->count();

        $yearly_total_earning = $yearlyOrders->where('payment_status','success')->sum('total_amount');

        $yearly_withdraws = ProviderWithdraw::whereYear('created_at', now()->year)->get();
        $yearly_withdraw_request = $today_withdraws->sum('total_amount');

        $refundRequests = RefundRequest::with('order')->whereYear('created_at', now()->year)->get();

        $yearly_total_refund = 0;
        foreach($refundRequests as $refundRequest){
            $yearly_total_refund += $refundRequest->order->total_amount;
        }

        $yearly_users = User::whereYear('created_at', now()->year)->count();

        // end yarly


        // start total
        $totalOrders = Order::orderBy('id','desc')->get();
        $total_total_order = $totalOrders->count();
        $total_total_awating_order = $totalOrders->where('order_status','awaiting_for_provider_approval')->count();
        $total_approved_order = $totalOrders->where('order_status','approved_by_provider')->count();
        $total_complete_order = $totalOrders->where('order_status','complete')->count();
        $total_declined_order = $totalOrders->where('order_status','order_decliened_by_provider')->count();

        $total_total_earning = $totalOrders->where('payment_status','success')->sum('total_amount');

        $total_withdraws = ProviderWithdraw::all();
        $total_withdraw_request = $today_withdraws->sum('total_amount');

        $refundRequests = RefundRequest::with('order')->get();

        $total_total_refund = 0;
        foreach($refundRequests as $refundRequest){
            $total_total_refund += $refundRequest->order->total_amount;
        }

        $total_users = User::count();

        $total_service = Service::count();
        $total_blog = Blog::count();
        $total_subscriber = Subscriber::where('is_verified',1)->count();
        $total_providers = User::where(['status' => 1, 'is_provider' => 1])->orderBy('name','asc')->count();
        $total_clients = User::where(['status' => 1, 'is_provider' => 0])->orderBy('name','asc')->count();
        // end total

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);

        return view('admin.dashboard', compact('currency_icon','today_total_order','today_total_awating_order','today_approved_order','today_complete_order','today_declined_order','today_total_earning','today_withdraw_request','today_total_refund','today_users','monthly_total_order','monthly_total_awating_order','monthly_approved_order','monthly_complete_order','monthly_declined_order','monthly_total_earning','monthly_withdraw_request','monthly_total_refund','monthly_users','yearly_total_order','yearly_total_awating_order','yearly_approved_order','yearly_complete_order','yearly_declined_order','yearly_total_earning','yearly_withdraw_request','yearly_total_refund','yearly_users','total_total_order','total_total_awating_order','total_approved_order','total_complete_order','total_declined_order','total_total_earning','total_withdraw_request','total_total_refund','total_users','total_service','total_blog','total_subscriber','total_providers','total_clients'));
    }




}
