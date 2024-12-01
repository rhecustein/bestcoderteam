<?php

namespace App\Http\Controllers\API\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawMethod;
use App\Models\ProviderWithdraw;
use App\Models\Order;
use App\Models\Setting;
use Auth;
class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        $user = Auth::guard('api')->user();
        $withdraws = ProviderWithdraw::where('user_id',$user->id)->orderBy('id','desc')->get();
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        return response()->json([
            'currency_icon' => $currency_icon,
            'withdraws' => $withdraws,
        ]);
    }

    public function show($id){
        $withdraw = ProviderWithdraw::find($id);
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;

        return response()->json([
            'currency_icon' => $currency_icon,
            'withdraw' => $withdraw,
        ]);
    }

    public function create(){
        $methods = WithdrawMethod::whereStatus('1')->get();

        return response()->json([
            'methods' => $methods
        ]);
    }

    public function getWithDrawAccountInfo($id){
        $method = WithdrawMethod::whereId($id)->first();
        $setting = Setting::first();
        $currency_icon = array(
            'icon' => $setting->currency_icon
        );
        $currency_icon = (object) $currency_icon;
        
        
        return response()->json(['method' => $method]);
        return view('provider.withdraw_account_info', compact('method','currency_icon'));
    }

    public function store(Request $request){
        $rules = [
            'method_id' => 'required',
            'withdraw_amount' => 'required|numeric',
            'account_info' => 'required',
        ];

        $customMessages = [
            'method_id.required' => trans('user_validation.Payment Method filed is required'),
            'withdraw_amount.required' => trans('user_validation.Withdraw amount filed is required'),
            'withdraw_amount.numeric' => trans('user_validation.Please provide valid numeric number'),
            'account_info.required' => trans('user_validation.Account filed is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $user = Auth::guard('api')->user();

        $provider = $user;
        $orders = Order::where('provider_id', $provider->id)->where('order_status', 'complete')->get();
        $total_sold_service = $orders->count();
        $total_balance = $orders->sum('total_amount');
        $total_withdraw = ProviderWithdraw::where('user_id', $provider->id)->sum('total_amount');
        $current_balance = $total_balance - $total_withdraw;

        if($request->withdraw_amount > $current_balance){
            $notification = trans('user_validation.Sorry! Your Payment request is more then your current balance');
            return response()->json(['message' => $notification],403);
        }

        $method = WithdrawMethod::whereId($request->method_id)->first();
        if($request->withdraw_amount >= $method->min_amount && $request->withdraw_amount <= $method->max_amount){
            $widthdraw = new ProviderWithdraw();
            $widthdraw->user_id = $user->id;
            $widthdraw->method = $method->name;
            $widthdraw->total_amount = $request->withdraw_amount;
            $withdraw_request = $request->withdraw_amount;
            $withdraw_amount = ($method->withdraw_charge / 100) * $withdraw_request;
            $widthdraw->withdraw_amount = $request->withdraw_amount - $withdraw_amount;
            $widthdraw->withdraw_charge = $method->withdraw_charge;
            $widthdraw->account_info = $request->account_info;
            $widthdraw->save();
            $notification = trans('user_validation.Withdraw request send successfully, please wait for admin approval');
            return response()->json(['message' => $notification]);

        }else{
            $notification = trans('user_validation.Your amount range is not available');
            return response()->json(['message' => $notification],403);
        }

    }
}
