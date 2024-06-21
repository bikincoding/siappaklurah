<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AutoLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $timeout = 600; // Waktu timeout dalam detik (misalnya 30 menit)

        $lastActivity = Session::get('last_activity_time');
        $currentTime = time();

        if (Auth::check() && $lastActivity && ($currentTime - $lastActivity > $timeout)) {
            Auth::logout();
            Session::forget('last_activity_time');
            return redirect('/login')->with('message', 'You have been logged out due to inactivity.');
        }

        Session::put('last_activity_time', $currentTime);

        return $next($request);
    }
}