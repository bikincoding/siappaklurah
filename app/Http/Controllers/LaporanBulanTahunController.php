<?php

namespace App\Http\Controllers;

use App\Models\LaporanBulanTahun;
use Illuminate\Http\Request;

class LaporanBulanTahunController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $laporans = LaporanBulanTahun::all();
        return view('admin.laporan_bulan_tahun.index', compact('laporans'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('admin.laporan_bulan_tahun.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tahun' => 'required|integer|min:2000|max:2099', // Contoh validasi untuk tahun
            'bulan' => 'required|integer|min:1|max:12',     // Validasi untuk bulan
            'status' => 'required|in:0,1',                  // Validasi untuk status, asumsikan hanya boleh 0 atau 1
            // Tambahkan aturan lainnya jika perlu
        ]);

        LaporanBulanTahun::create($request->all());
        return redirect()->route('laporan-bulan-tahuns.index')
                         ->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $laporan = LaporanBulanTahun::findOrFail($id);
        return view('admin.laporan_bulan_tahun.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = LaporanBulanTahun::findOrFail($id);
        return view('admin.laporan_bulan_tahun.edit',
        compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request...

        $laporan = LaporanBulanTahun::findOrFail($id);
        $laporan->update($request->all());
        return redirect()->route('laporan-bulan-tahuns.index')
                        ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = LaporanBulanTahun::findOrFail($id);
        $laporan->delete();
        return redirect()->route('laporan-bulan-tahuns.index')
                        ->with('success', 'Laporan berhasil dihapus.');
    }
}
