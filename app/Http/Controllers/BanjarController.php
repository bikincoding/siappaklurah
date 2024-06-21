<?php

namespace App\Http\Controllers;
use App\Models\Banjar;
use Illuminate\Http\Request;

class BanjarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $banjars = Banjar::all();
        return view('admin.banjar.index', compact('banjars'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('admin.banjar.create');
    }

    public function edit($id)
    {
        // Cari Banjar dengan ID, atau gagalkan jika tidak ditemukan
        $banjar = Banjar::findOrFail($id);
        
        // Kembalikan view 'edit' dengan data banjar
        return view('admin.banjar.edit', compact('banjar'));
    }

    public function show($id)
    {
        // Cari Banjar berdasarkan ID dan ambil datanya. Jika tidak ditemukan, akan terjadi error 404.
        $banjar = Banjar::findOrFail($id);

        // Kembalikan view 'show' dengan instance 'banjar' sebagai variabel.
        return view('admin.banjar.show', compact('banjar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_banjar' => 'required',
        ]);

        Banjar::create($request->all());
        return redirect()->route('banjar')->with('success','Banjar created successfully.');
    }

    public function update(Request $request, Banjar $banjar)
    {
        $request->validate([
            'nama_banjar' => 'required',
        ]);

        $banjar->update($request->all());
        return redirect()->route('banjars.index')->with('success','Banjar updated successfully');
    }

    public function destroy(Banjar $banjar)
    {
        $banjar->delete();
        return redirect()->route('banjars.index')->with('success','Banjar deleted successfully');
    }
}
