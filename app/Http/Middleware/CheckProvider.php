<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class CheckProvider
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('web')->user();
        if($user->is_provider == 1){
            if($user->status == 1){
                return $next($request);
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('home');
        }

    }
}
