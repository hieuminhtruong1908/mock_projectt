<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Session;
use Closure;

class AutoLogout
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (!Session::has('lastActivityTime')) {
            Session::put('lastActivityTime', time());
        } elseif (time() - Session::get('lastActivityTime') > (config('constant.timeout') * 60)) {

            Session::forget('lastActivityTime');
            Auth::logout();

            return redirect()->route('home')->with('message', 'You had not activity in 30 minutes');

        }
        Session::put('lastActivityTime', time());
        return $next($request);
    }
}
