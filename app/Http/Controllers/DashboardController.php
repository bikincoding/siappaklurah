<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // Ambil semua data pegawai
        $pegawais = Pegawai::all();

        // Tampilkan view admin.dashboard dengan data pegawai
        return view('admin.dashboard', compact('pegawais'));
    }
}
