<?php

namespace App\Http\Controllers;

use App\Models\Banjar;
use App\Models\KepalaLingkungan;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $kepalaLingkungans = KepalaLingkungan::with('banjar')
        ->where('id_banjars', '!=', 34)
        ->get();
        return view('user.dashboard', compact('kepalaLingkungans'));
    }

    
}