<?php

namespace Modules\Subscription\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\BreadcrumbImage;
use Modules\Subscription\Entities\SubscriptionPlan;
use Session;


class SubscriptionController extends Controller
{

    public function subscription_plan()
    {

        $breadcrumb = BreadcrumbImage::where(['id' => 12])->first();

        $plans = SubscriptionPlan::where('status', 1)->orderBy('serial','asc')->get();

        $selected_theme = Session::get('selected_theme');
        if ($selected_theme == 'theme_one'){
            $active_theme = 'layout';
        }elseif($selected_theme == 'theme_two'){
            $active_theme = 'layout2';
        }elseif($selected_theme == 'theme_three'){
            $active_theme = 'layout3';
        }else{
            $active_theme = 'layout';
        }



        return view('subscription::subscription_plan', compact('active_theme','plans','breadcrumb'));
    }
}
