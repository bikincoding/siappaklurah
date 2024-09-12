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
        $pegawais = Pegawai::where('nip', '!=', '198703012006021001')->get();

        $pak_lurah = Pegawai::where('nip', '198703012006021001')->first();

        // Tampilkan view admin.dashboard dengan data pegawai
        return view('admin.dashboard', compact('pegawais', 'pak_lurah'));
    }
}