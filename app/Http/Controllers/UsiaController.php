<?php

namespace App\Http\Controllers;

use App\Models\Usia;
use Illuminate\Http\Request;

class UsiaController extends Controller
{
    /**
     * Menampilkan daftar usia.
     */
    public function index()
    {
        $usias = Usia::all();
        return view('usias.index', compact('usias'));
    }

    /**
     * Menampilkan formulir untuk membuat usia baru.
     */
    public function create()
    {
        return view('usias.create');
    }

    /**
     * Menyimpan usia baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'usia' => 'required|string',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            'id_laporan_bulan_tahuns' => 'required|integer',
            'id_banjars' => 'required|integer'
        ]);

        Usia::create($validatedData);
        return redirect()->route('usias.index')->with('success', 'Usia berhasil ditambahkan');
    }

    /**
     * Menampilkan usia tertentu.
     */
    public function show(Usia $usia)
    {
        return view('usias.show', compact('usia'));
    }

    /**
     * Menampilkan formulir untuk mengedit usia tertentu.
     */
    public function edit(Usia $usia)
    {
        return view('usias.edit', compact('usia'));
    }

    /**
     * Memperbarui usia tertentu dalam database.
     */
    public function update(Request $request, Usia $usia)
    {
        $validatedData = $request->validate([
            'usia' => 'required|string',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            'id_laporan_bulan_tahuns' => 'required|integer',
            'id_banjars' => 'required|integer'
        ]);

        $usia->update($validatedData);
        return redirect()->route('usias.index')->with('success', 'Usia berhasil diperbarui');
    }

    /**
     * Menghapus usia tertentu dari database.
     */
    public function destroy(Usia $usia)
    {
        $usia->delete();
        return redirect()->route('usias.index')->with('success', 'Usia berhasil dihapus');
    }
}
