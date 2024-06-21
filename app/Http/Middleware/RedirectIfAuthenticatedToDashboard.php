<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedToDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->route('dashboard');
            } elseif ($user->hasRole('user')) {
                return redirect()->route('dashboard_user');
            }
        }

        return $next($request);
    }
}