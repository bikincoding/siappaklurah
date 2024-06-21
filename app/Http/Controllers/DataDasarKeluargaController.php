<?php

namespace App\Http\Controllers;

use App\Models\DataDasarKeluarga;
use App\Models\Banjar; // Pastikan model Banjar sudah ada

use Illuminate\Http\Request;

class DataDasarKeluargaController extends Controller
{
    public function index()
    {
        // $keluargas = DataDasarKeluarga::all();

        $keluargas = DataDasarKeluarga::with('banjar')->get();
        $banjars = Banjar::all();

        return view('admin.data_dasar_keluarga.index', compact('keluargas', 'banjars'));
    }

    public function create()
    {
        $banjars = Banjar::all(); // Ambil semua data banjar
        return view('admin.data_dasar_keluarga.create', compact('banjars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kartu_keluarga' => 'required|unique:data_dasar_keluargas,no_kartu_keluarga',
            'alamat' => 'required',
            // Tambahkan validasi untuk field lain yang diperlukan
        ]);

        $keluarga = new DataDasarKeluarga($request->all());
        $keluarga->save();

        return redirect()->route('data-dasar-keluarga.index')->with('success', 'Keluarga berhasil ditambahkan.');
    }

    public function show($id)
    {
        $keluarga = DataDasarKeluarga::findOrFail($id);
        return view('admin.data_dasar_keluarga.show', compact('keluarga'));
    }

    public function edit($id)
    {
        $keluarga = DataDasarKeluarga::with('banjar')->findOrFail($id);
        $banjars = Banjar::all(); // asumsikan Anda memiliki model Banjar yang memiliki data banjar
        return view('admin.data_dasar_keluarga.edit', compact('keluarga', 'banjars'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_kartu_keluarga' => 'required|unique:data_dasar_keluargas,no_kartu_keluarga,' . $id,
            'alamat' => 'required',
            // Tambahkan validasi untuk field lain yang diperlukan
        ]);

        $keluarga = DataDasarKeluarga::findOrFail($id);
        $keluarga->update($request->all());

        return redirect()->route('data-dasar-keluarga.index')->with('success', 'Keluarga berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $keluarga = DataDasarKeluarga::findOrFail($id);
        $keluarga->delete();

        return redirect()->route('data-dasar-keluarga.index')->with('success', 'Keluarga berhasil dihapus.');
    }

    public function tambahAnggota($data_dasar_keluarga_id)
    {
        // $keluarga = DataDasarKeluarga::findOrFail($data_dasar_keluarga_id);
        $keluarga = DataDasarKeluarga::with('banjar')->findOrFail($data_dasar_keluarga_id);
        return view('admin.data_dasar_keluarga.tambah_anggota', compact('keluarga'));
      
    }
}
