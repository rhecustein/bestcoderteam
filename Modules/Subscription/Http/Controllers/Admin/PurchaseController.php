<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Subscription\Entities\SubscriptionPlan;
use Modules\Subscription\Entities\PurchaseHistory;
use App\Models\Setting;
use App\Models\User;

class PurchaseController extends Controller
{

    public function index()
    {
        $histories = PurchaseHistory::with('provider')->orderBy('id','desc')->paginate(20);

        return view('subscription::admin.purchase_history', compact('histories'));
    }

    public function pending_payment()
    {
        $histories = PurchaseHistory::with('provider')->orderBy('id','desc')->where('payment_status','pending')->paginate(20);

        return view('subscription::admin.purchase_history', compact('histories'));
    }

    public function create()
    {

        $plans = SubscriptionPlan::where('status', 1)->orderBy('serial','asc')->get();

        $providers = User::where('status', 1)->get();

        return view('subscription::admin.assign_plan', compact('plans','providers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'provider_id' => 'required',
            'plan_id' => 'required',
        ],[
            'provider_id.required' => trans('admin_validation.Provider is required'),
            'plan_id.required' => trans('admin_validation.Plan is required'),
        ]);

        $plan = SubscriptionPlan::find($request->plan_id);

        if($plan->expiration_date == 'monthly'){
            $expiration_date = date('Y-m-d', strtotime('30 days'));
        }elseif($plan->expiration_date == 'yearly'){
            $expiration_date = date('Y-m-d', strtotime('365 days'));
        }elseif($plan->expiration_date == 'lifetime'){
            $expiration_date = 'lifetime';
        }

        PurchaseHistory::where('provider_id', $request->provider_id)->update(['status' => 'expired']);

        $purchase = new PurchaseHistory();

        $purchase->provider_id = $request->provider_id;
        $purchase->plan_id = $request->plan_id;
        $purchase->plan_name = $plan->plan_name;
        $purchase->plan_price = $plan->plan_price;
        $purchase->expiration = $plan->expiration_date;
        $purchase->expiration_date = $expiration_date;
        $purchase->maximum_service = $plan->maximum_service;
        $purchase->status = 'active';
        $purchase->payment_method = 'handcash';
        $purchase->payment_status = 'success';
        $purchase->transaction = 'hand_cash';
        $purchase->save();

        $notification = trans('admin_validation.Assign Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function show($id)
    {

        $history = PurchaseHistory::with('provider')->where('id', $id)->first();

        return view('subscription::admin.purchase_history_show', compact('history'));
    }


    public function approved_plan_payment($id){

        $history = PurchaseHistory::with('provider')->where('id', $id)->first();

        PurchaseHistory::where('provider_id', $history->provider_id)->update(['status' => 'expired']);

        $history = PurchaseHistory::with('provider')->where('id', $id)->first();
        $history->payment_status = 'success';
        $history->status = 'active';
        $history->save();

        $notification = trans('admin_validation.Approved Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.purchase-history')->with($notification);
    }


    public function delete_plan_payment($id)
    {
        $history = PurchaseHistory::with('provider')->where('id', $id)->first();
        $history->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.purchase-history')->with($notification);

    }
}
