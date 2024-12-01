<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\Setting;
use Auth;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function coupon_history(){

        $provider = Auth::guard('web')->user();

        $coupon_histories = CouponHistory::where(['provider_id' => $provider->id])->orderBy('id', 'desc')->get();
        $setting = Setting::first();

        return view('provider.coupon_history', compact('coupon_histories','setting'));
    }

    public function index(){

        $provider = Auth::guard('web')->user();

        $coupons = Coupon::where(['provider_id' => $provider->id])->orderBy('id', 'desc')->get();

        return view('provider.coupon', compact('coupons'));
    }

    public function store(Request $request){

        $auth_user = Auth::guard('web')->user();

        $rules = [
            'coupon_code'=>'required|unique:coupons',
            'offer_percentage'=>'required',
            'expired_date'=>'required',
        ];
        $customMessages = [
            'coupon_code.required' => trans('user_validation.Coupon code is required'),
            'coupon_code.unique' => trans('user_validation.Coupon already exist'),
            'offer_percentage.required' => trans('user_validation.Offer percentage is required'),
            'expired_date.required' => trans('user_validation.Expired date is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $coupon = new Coupon();
        $coupon->provider_id = $auth_user->id;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->offer_percentage = $request->offer_percentage;
        $coupon->expired_date = $request->expired_date;
        $coupon->status = $request->status;
        $coupon->save();

        $notification= trans('user_validation.Created Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function update(Request $request, $id){

        $auth_user = Auth::guard('web')->user();

        $rules = [
            'coupon_code'=>'required|unique:coupons,coupon_code,'.$id,
            'offer_percentage'=>'required',
            'expired_date'=>'required',
        ];
        $customMessages = [
            'coupon_code.required' => trans('user_validation.Coupon code is required'),
            'coupon_code.unique' => trans('user_validation.Coupon already exist'),
            'offer_percentage.required' => trans('user_validation.Offer percentage is required'),
            'expired_date.required' => trans('user_validation.Expired date is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $coupon = Coupon::find($id);
        $coupon->provider_id = $auth_user->id;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->offer_percentage = $request->offer_percentage;
        $coupon->expired_date = $request->expired_date;
        $coupon->status = $request->status;
        $coupon->save();

        $notification= trans('user_validation.Updated Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function destroy($id){
        $coupon = Coupon::find($id);
        $coupon->delete();

        $notification= trans('user_validation.Deleted Successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }
}
