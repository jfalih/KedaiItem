<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ResellerVerify
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
        if(!in_array('reseller',Auth::user()->role_name) || !in_array('admin', Auth::user()->role_name)){
            return abort(404);
        }
        
        return $next($request);
    }
}
