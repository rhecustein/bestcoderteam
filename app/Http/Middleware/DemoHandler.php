<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class DemoHandler
{
    public function handle(Request $request, Closure $next)
    {
        if(Route::is('admin.store-login') || Route::is('store-login') || Route::is('admin.logout') || Route::is('send-message-to-provider') || Route::is('provider.send-message-to-buyer') || Route::is('get-available-schedule')){
            return $next($request);
         }else{
            if(env('APP_MODE') == 'DEMO'){
                if($request->isMethod('post') || $request->isMethod('delete') || $request->isMethod('put') || $request->isMethod('patch')){
                    
                    if ($request->ajax()) {
                        return response()->json(['message' => 'This Is Demo Version. You Can Not Change Anything'],403);
                    } else {

                        $notification = trans('This Is Demo Version. You Can Not Change Anything');
                        $notification=array('messege'=>$notification,'alert-type'=>'error');
                        return redirect()->back()->with($notification);
                    }
                }
                if(Route::is('user.remove-wishlist')){
                    
                    if ($request->ajax()) {
                        return response()->json(['message' => 'This Is Demo Version. You Can Not Change Anything'],403);
                    } else {

                        $notification = trans('This Is Demo Version. You Can Not Change Anything');
                        $notification=array('messege'=>$notification,'alert-type'=>'error');
                        return redirect()->back()->with($notification);
                    }
                    
                }
            }
         }
        return $next($request);
    }
}
