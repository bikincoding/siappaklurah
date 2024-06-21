<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard'); // Route untuk DashboardController
        } elseif ($user->hasRole('user')) {
            return redirect()->route('dashboard_user'); // Route untuk DashboardUserController
        } else {
            return redirect('/'); // Atau arahkan ke halaman lain jika tidak ada peran yang cocok
        }

        
    }
}