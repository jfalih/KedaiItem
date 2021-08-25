<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Cache;
class ActivityByUser
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
        if(Auth::check())
        {
            $expireAt = Carbon::now()->addMinutes(1);
            Cache::put('user-online-'.Auth::user()->id, true, $expireAt);
            $user = User::find(Auth::user()->id);
            $user->last_seen = Carbon::now()->format('Y-m-d H:i:s');
            $user->save(); 
        }
        return $next($request);
    }
}
