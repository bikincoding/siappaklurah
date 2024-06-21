<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Banjar;
use Illuminate\Http\Request;
use App\Models\KepalaLingkungan;
use Illuminate\Support\Facades\Storage;

class KepalaLingkunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kepala_lingkungans = KepalaLingkungan::with('banjar')->get();
        return view('admin.kepala_lingkungans.index', compact('kepala_lingkungans'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $banjars = Banjar::all(); // Retrieve all Banjars
        return view('admin.kepala_lingkungans.create', compact('banjars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_kepala_lingkungan' => 'required',
            'alamat' => 'required',
            'id_banjars' => 'required|integer',
            'telepon' => 'required'
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            try {
                // Get the file from the request
                $file = $request->file('foto');
                
                // Generate a unique file name
                $fileName = time() . '_' . $file->getClientOriginalName();
                
                // Define the path to store the file
                $destinationPath = public_path('storage/foto_kepala_lingkungan');
                
                // Move the file to the defined path
                $file->move($destinationPath, $fileName);
                
                // Save the file name in the database
                $input['foto'] = $fileName;
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'File upload error: ' . $e->getMessage()]);
            }
        }

        KepalaLingkungan::create($input);

        return redirect()->route('kepala_lingkungans.index')->with('success', 'Kepala Lingkungan created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kepalaLingkungan = KepalaLingkungan::with('banjar')->findOrFail($id);
        return view('admin.kepala_lingkungans.show', compact('kepalaLingkungan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kepala_lingkungan = KepalaLingkungan::findOrFail($id);
        $banjars = Banjar::all();
        return view('admin.kepala_lingkungans.edit', compact('kepala_lingkungan','banjars'));
    }

    public function biodata(string $id)
    {
        $kepala_lingkungan = KepalaLingkungan::findOrFail($id);
        $banjars = Banjar::all();
        return view('user.biodata', compact('kepala_lingkungan','banjars'));
    }

    // public function update_biodata(Request $request, string $id)
    // {
    //     $request->validate([
    //         'nama_kepala_lingkungan' => 'required',
    //         'alamat' => 'required',
    //         'telepon' => 'required'
    //     ]);

    //     $kepalaLingkungan = KepalaLingkungan::findOrFail($id);
    //     $input = $request->all();

    //     if ($request->hasFile('foto')) {
    //         // Delete old file
    //         Storage::delete('public/foto_kepala_lingkungan/'.$kepalaLingkungan->foto);

    //         // Store new file
    //         $path = $request->file('foto')->store('public/foto_kepala_lingkungan');
    //         $input['foto'] = basename($path);
    //     }

    //     $kepalaLingkungan->update($input);
     
          
    //     return redirect()->route('dashboard_user')->with('success', 'Kepala Lingkungan updated successfully.');
        
        
    // }


    public function update_biodata(Request $request, string $id)
{
    $request->validate([
        'nama_kepala_lingkungan' => 'required',
        'alamat' => 'required',
        'telepon' => 'required'
    ]);

    $kepalaLingkungan = KepalaLingkungan::findOrFail($id);
    $input = $request->all();

    if ($request->hasFile('foto')) {
        try {
            // Delete old file
            $oldFilePath = public_path('storage/foto_kepala_lingkungan/' . $kepalaLingkungan->foto);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // Store new file
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/foto_kepala_lingkungan');
            $file->move($destinationPath, $fileName);
            $input['foto'] = $fileName;
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'File upload error: ' . $e->getMessage()]);
        }
    } else {
        // If no new image uploaded, retain the old image path
        $input['foto'] = $kepalaLingkungan->foto;
    }

    $kepalaLingkungan->update($input);

    return redirect()->route('dashboard_user')->with('success', 'Kepala Lingkungan updated successfully.');
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kepala_lingkungan' => 'required',
            'alamat' => 'required',
            'id_banjars' => 'required|integer',
            'telepon' => 'required'
        ]);

        $kepalaLingkungan = KepalaLingkungan::findOrFail($id);
        $input = $request->all();

        if ($request->hasFile('foto')) {
            try {
                // Delete old file
                $oldFilePath = public_path('storage/foto_kepala_lingkungan/' . $kepalaLingkungan->foto);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }

                // Store new file
                $file = $request->file('foto');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('storage/foto_kepala_lingkungan');
                $file->move($destinationPath, $fileName);
                $input['foto'] = $fileName;
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'File upload error: ' . $e->getMessage()]);
            }
        }

        $kepalaLingkungan->update($input);

        if (Auth::user()->role == "admin") {
            return redirect()->route('kepala_lingkungans.index')->with('success', 'Kepala Lingkungan updated successfully.');
        } else {
            return redirect()->route('dashboard_user')->with('success', 'Kepala Lingkungan updated successfully.');
        }
    }


    public function destroy(string $id)
    {
        $kepalaLingkungan = KepalaLingkungan::findOrFail($id);
        // Delete the file associated with the record
        Storage::delete('public/foto_kepala_lingkungan/'.$kepalaLingkungan->foto);
        $kepalaLingkungan->delete();

        return redirect()->route('kepala_lingkungans.index')->with('success', 'Kepala Lingkungan deleted successfully.');
    }
}