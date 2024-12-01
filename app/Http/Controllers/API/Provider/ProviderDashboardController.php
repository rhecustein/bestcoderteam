<?php

namespace App\Http\Controllers\API\Provider;

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
use Auth;
class ProviderDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){

        $provider = Auth::guard('api')->user();

        $todayOrders = Order::orderBy('id','desc')->where('provider_id', $provider->id)->whereDay('created_at', now()->day)->get();

        $today_total_order = $todayOrders->count();
        $today_total_awating_order = $todayOrders->where('order_status','awaiting_for_provider_approval')->count();
        $today_approved_order = $todayOrders->where('order_status','approved_by_provider')->count();
        $today_complete_order = $todayOrders->where('order_status','complete')->count();
        $today_declined_order = $todayOrders->where('order_status','order_decliened_by_provider')->count();

        $today_total_earning = $todayOrders->where('payment_status','success')->sum('total_amount');

        $today_withdraws = ProviderWithdraw::whereDay('created_at', now()->day)->where('status',1)->where('user_id', $provider->id)->get();
        $today_withdraw_request = $today_withdraws->sum('total_amount');

        // end today

        // start this month

        $monthlyOrders = Order::orderBy('id','desc')->where('provider_id', $provider->id)->whereMonth('created_at', now()->month)->get();

        $monthly_total_order = $monthlyOrders->count();
        $monthly_total_awating_order = $monthlyOrders->where('order_status','awaiting_for_provider_approval')->count();
        $monthly_approved_order = $monthlyOrders->where('order_status','approved_by_provider')->count();
        $monthly_complete_order = $monthlyOrders->where('order_status','complete')->count();
        $monthly_declined_order = $monthlyOrders->where('order_status','order_decliened_by_provider')->count();

        $monthly_total_earning = $monthlyOrders->where('payment_status','success')->sum('total_amount');

        $monthly_withdraws = ProviderWithdraw::whereMonth('created_at', now()->month)->where('status',1)->where('user_id', $provider->id)->get();
        $monthly_withdraw_request = $today_withdraws->sum('total_amount');

        // end monthly

        // start yearly

        $yearlyOrders = Order::orderBy('id','desc')->where('provider_id', $provider->id)->whereYear('created_at', now()->year)->get();

        $yearly_total_order = $yearlyOrders->count();
        $yearly_total_awating_order = $yearlyOrders->where('order_status','awaiting_for_provider_approval')->count();
        $yearly_approved_order = $yearlyOrders->where('order_status','approved_by_provider')->count();
        $yearly_complete_order = $yearlyOrders->where('order_status','complete')->count();
        $yearly_declined_order = $yearlyOrders->where('order_status','order_decliened_by_provider')->count();

        $yearly_total_earning = $yearlyOrders->where('payment_status','success')->sum('total_amount');

        $yearly_withdraws = ProviderWithdraw::whereYear('created_at', now()->year)->where('status',1)->where('user_id', $provider->id)->get();
        $yearly_withdraw_request = $today_withdraws->sum('total_amount');
        // end yarly


        // start total
        $totalOrders = Order::orderBy('id','desc')->get();
        $total_total_order = $totalOrders->count();
        $total_total_awating_order = $totalOrders->where('order_status','awaiting_for_provider_approval')->count();
        $total_approved_order = $totalOrders->where('order_status','approved_by_provider')->count();
        $total_complete_order = $totalOrders->where('order_status','complete')->count();
        $total_declined_order = $totalOrders->where('order_status','order_decliened_by_provider')->count();

        $total_total_earning = $totalOrders->where('payment_status','success')->sum('total_amount');

        $total_withdraws = ProviderWithdraw::where('status',1)->where('user_id', $provider->id)->get();
        $total_withdraw_request = $today_withdraws->sum('total_amount');

        $total_service = Service::where('provider_id', $provider->id)->count();
        // end total

        $setting = Setting::first();
        $currency_icon = (object) array('icon' => $setting->currency_icon);


        return response()->json([
            'currency_icon' => $currency_icon,
            'today_total_order' => $today_total_order,
            'today_total_awating_order' => $today_total_awating_order,
            'today_approved_order' => $today_approved_order,
            'today_complete_order' => $today_complete_order,
            'today_declined_order' => $today_declined_order,
            'today_total_earning' => $today_total_earning,
            'today_withdraw_request' => $today_withdraw_request,
            'monthly_total_order' => $monthly_total_order,
            'monthly_total_awating_order' => $monthly_total_awating_order,
            'monthly_approved_order' => $monthly_approved_order,
            'monthly_complete_order' => $monthly_complete_order,
            'monthly_declined_order' => $monthly_declined_order,
            'monthly_total_earning' => $monthly_total_earning,
            'monthly_withdraw_request' => $monthly_withdraw_request,
            'yearly_total_awating_order' => $yearly_total_awating_order,
            'yearly_approved_order' => $yearly_approved_order,
            'yearly_complete_order' => $yearly_complete_order,
            'yearly_total_order' => $yearly_total_order,
            'yearly_declined_order' => $yearly_declined_order,
            'yearly_total_earning' => $yearly_total_earning,
            'yearly_withdraw_request' => $yearly_withdraw_request,
            'total_total_order' => $total_total_order,
            'total_total_awating_order' => $total_total_awating_order,
            'total_approved_order' => $total_approved_order,
            'total_complete_order' => $total_complete_order,
            'total_declined_order' => $total_declined_order,
            'total_total_earning' => $total_total_earning,
            'total_withdraw_request' => $total_withdraw_request,
            'total_service' => $total_service,
        ]);

    }
}
