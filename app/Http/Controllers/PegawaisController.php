<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaisController extends Controller
{
    /**
     * Menampilkan daftar pegawai.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('admin.pegawais.index', compact('pegawais'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Menampilkan form untuk membuat pegawai baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pegawais.create');
    }

    /**
     * Menyimpan pegawai baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validasi data yang diterima dari form
    $validatedData = $request->validate([
        'foto_pegawai' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'nama_pegawai' => 'required|max:255',
        'nip' => 'required|unique:pegawais,nip|digits:18',
        'jabatan' => 'required|max:255',
        'pangkat_golongan' => 'required|max:255',
        'alamat' => 'required',
        'tgl_lahir' => 'required|date',
        'no_ktp' => 'required|digits:16|unique:pegawais,no_ktp',
        'npwp' => 'nullable|max:255|unique:pegawais,npwp',
        'no_karpeg' => 'nullable|max:255|unique:pegawais,no_karpeg',
        'no_rek' => 'nullable|max:255',
        'email' => 'required|email|max:255|unique:pegawais,email',
        'telp' => 'required|max:255',
        'golongan_darah' => 'nullable|in:A,B,AB,O',
    ]);

    // Cek jika ada file foto yang diupload dan proses
    if ($request->hasFile('foto_pegawai')) {
        try {
            // Get the file from the request
            $file = $request->file('foto_pegawai');
            
            // Generate a unique file name
            $filename = time().'_'.$file->getClientOriginalName();
            
            // Define the path to store the file
            $destinationPath = public_path('storage/foto_pegawai');
            
            // Ensure the destination path exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            // Move the file to the defined path
            $file->move($destinationPath, $filename);
            
            // Add the filename to the validated data array
            $validatedData['foto_pegawai'] = $filename;
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'File upload error: ' . $e->getMessage()]);
        }
    }

    // Buat objek Pegawai baru dan simpan data ke database
    Pegawai::create($validatedData);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil ditambahkan.');
}


    /**
     * Menampilkan detail pegawai tertentu.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id); // Cari pegawai berdasarkan id, gagal jika tidak ditemukan

        // Tampilkan view show dengan data pegawai
        return view('admin.pegawais.show', compact('pegawai'));
    }

    /**
     * Menampilkan form untuk mengedit pegawai.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id); // Cari pegawai berdasarkan id, gagal jika tidak ditemukan
        return view('admin.pegawais.edit', compact('pegawai'));
    }

    /**
     * Memperbarui data pegawai di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id); // Cari pegawai berdasarkan id, gagal jika tidak ditemukan

        // Validasi request
        $validatedData = $request->validate([
            'nama_pegawai' => 'required|max:255',
            'nip' => 'required|digits_between:10,20|unique:pegawais,nip,' . $id, // pastikan nip unik kecuali untuk pegawai ini
            'jabatan' => 'required|max:255',
            'pangkat_golongan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'tgl_lahir' => 'required|date',
            'no_ktp' => 'required|digits:16|unique:pegawais,no_ktp,' . $id, // pastikan no_ktp unik kecuali untuk pegawai ini
            'npwp' => 'nullable|max:255',
            'no_karpeg' => 'nullable|max:255',
            'no_rek' => 'nullable',
            'email' => 'required|email|max:255|unique:pegawais,email,' . $id, // pastikan email unik kecuali untuk pegawai ini
            'telp' => 'required|max:255',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'foto_pegawai' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // validasi untuk file gambar
        ]);

        // Periksa apakah ada file foto yang diupload dan proses
        if ($request->hasFile('foto_pegawai')) {
            // Hapus foto lama jika ada
            if ($pegawai->foto_pegawai && file_exists(public_path('storage/foto_pegawai/'.$pegawai->foto_pegawai))) {
                unlink(public_path('storage/foto_pegawai/'.$pegawai->foto_pegawai));
            }

            // Simpan file foto baru
            $file = $request->file('foto_pegawai');
            $filename = time().'_'.$file->getClientOriginalName();
            $destinationPath = public_path('storage/foto_pegawai');
            
            // Ensure the destination path exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $filename);
            $validatedData['foto_pegawai'] = $filename; // Update nama file foto di data yang divalidasi
        }

        // Update pegawai dengan data yang divalidasi
        $pegawai->update($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }



    /**
     * Menghapus pegawai dari database.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawais.index');
    }
}