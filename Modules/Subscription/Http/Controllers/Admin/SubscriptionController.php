<?php

namespace Modules\Subscription\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Subscription\Entities\SubscriptionPlan;
use App\Models\Setting;

class SubscriptionController extends Controller
{

    public function index()
    {
        $plans = SubscriptionPlan::orderBy('serial','asc')->get();

        return view('subscription::admin.subscription', compact('plans'));
    }


    public function create()
    {
        return view('subscription::admin.subscription_create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'plan_name' => 'required',
            'plan_price' => 'required',
            'expiration_date' => 'required',
            'maximum_service' => 'required',
            'serial' => 'required',
            'status' => 'required',
        ],[
            'plan_name.required' => trans('admin_validation.Plan name is required'),
            'plan_price.required' => trans('admin_validation.Plan price is required'),
            'expiration_date.required' => trans('admin_validation.Expiration date is required'),
            'maximum_service.required' => trans('admin_validation.Maximum service is required'),
            'serial.required' => trans('admin_validation.Serial is required')

        ]);

        $plan = new SubscriptionPlan();
        $plan->plan_name = $request->plan_name;
        $plan->plan_price = $request->plan_price;
        $plan->expiration_date = $request->expiration_date;
        $plan->maximum_service = $request->maximum_service;
        $plan->serial = $request->serial;
        $plan->status = $request->status;
        $plan->save();

        $notification = trans('admin_validation.Create Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.subscription-plan.index')->with($notification);
    }

    public function show($id)
    {
        return view('subscription::show');
    }

    public function edit($id)
    {

        $plan = SubscriptionPlan::find($id);

        return view('subscription::admin.subscription_edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'plan_name' => 'required',
            'plan_price' => 'required',
            'expiration_date' => 'required',
            'maximum_service' => 'required',
            'serial' => 'required',
            'status' => 'required',
        ],[
            'plan_name.required' => trans('admin_validation.Plan name is required'),
            'plan_price.required' => trans('admin_validation.Plan price is required'),
            'expiration_date.required' => trans('admin_validation.Expiration date is required'),
            'maximum_service.required' => trans('admin_validation.Maximum service is required'),
            'serial.required' => trans('admin_validation.Serial is required')

        ]);

        $plan = SubscriptionPlan::find($id);
        $plan->plan_name = $request->plan_name;
        $plan->plan_price = $request->plan_price;
        $plan->expiration_date = $request->expiration_date;
        $plan->maximum_service = $request->maximum_service;
        $plan->serial = $request->serial;
        $plan->status = $request->status;
        $plan->save();


        $notification = trans('admin_validation.Update Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.subscription-plan.index')->with($notification);
    }


    public function destroy($id)
    {
        $plan = SubscriptionPlan::find($id);
        $plan->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.subscription-plan.index')->with($notification);

    }
}
