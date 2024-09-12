<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Banjar;
use App\Models\Bantuan;
use App\Models\UsulanDanaBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // Pastikan menambahkan ini di bagian atas file

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;



class UsulanDanaBantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $UsulanDanaBantuans = UsulanDanaBantuan::with('banjar')->where('status', '!=', '1')->get();

        return view('admin.usulan_dana_bantuan.index', compact('UsulanDanaBantuans'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index_kaling()
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id;
        $bantuans = Bantuan::all(); // Retrieve all Banjars
        $UsulanDanaBantuans = UsulanDanaBantuan::with('banjar')
        ->where('id_banjars', $banjarId) // Adjust column name if needed
        ->orderBy('id', 'desc') // Sorting by 'id' in descending order
        ->get();
        return view('user.usulan_dana_bantuan.index', compact('UsulanDanaBantuans', 'bantuans'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bantuans = Bantuan::all(); // Retrieve all Banjars
        return view('user.usulan_dana_bantuan.create', compact('bantuans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'usulan_ktp' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
            'surat_pernyataan_kaling' => 'required',
            'alamat' => 'required',
            'id_bantuans' => 'required|integer',
            'keterangan' => 'required',
            'status' => 'required',
            'id_banjars' => 'required',
            'tgl_musreng' => '',
            
        ]);

        $input = $request->all();

        if ($request->hasFile('usulan_ktp')) {
            try {
                // Get the file from the request
                $file = $request->file('usulan_ktp');
                
                // Generate a unique file name
                $fileName = time() . '_' . $file->getClientOriginalName();
                
                // Define the path to store the file
                $destinationPath = public_path('storage/usulan_ktp');
                
                // Move the file to the defined path
                $file->move($destinationPath, $fileName);
                
                // Save the file name in the database
                $input['usulan_ktp'] = $fileName;
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'File upload error: ' . $e->getMessage()]);
            }
        } else {
            $input['usulan_ktp'] = 'default-id-card.JPG';
        }

        if ($request->hasFile('surat_pernyataan_kaling')) {
            try {
                // Get the file from the request
                $file = $request->file('surat_pernyataan_kaling');
                
                // Generate a unique file name
                $fileName = time() . '_' . $file->getClientOriginalName();
                
                // Define the path to store the file
                $destinationPath = public_path('storage/surat_pernyataan_kaling');
                
                // Move the file to the defined path
                $file->move($destinationPath, $fileName);
                
                // Save the file name in the database
                $input['surat_pernyataan_kaling'] = $fileName;
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'File upload error: ' . $e->getMessage()]);
            }
        } else {
            $input['surat_pernyataan_kaling'] = '-';
        }

        $input['tgl_musreng'] = Carbon::now();

        UsulanDanaBantuan::create($input);

        return redirect()->route('usulan_dana_bantuan_kaling')->with('success', 'Usulan dana bantuan berhasil diajukan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $UsulanDanaBantuan = UsulanDanaBantuan::with('banjar')->findOrFail($id);
        return view('admin.usulan_dana_bantuan.show', compact('UsulanDanaBantuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kepala_lingkungan = UsulanDanaBantuan::findOrFail($id);
        $banjars = Banjar::all();
        return view('admin.usulan_dana_bantuan.edit', compact('kepala_lingkungan','banjars'));
    }



    public function destroy(string $id)
    {
        $UsulanDanaBantuan = UsulanDanaBantuan::findOrFail($id);
        $UsulanDanaBantuan->delete();

        return redirect()->route('usulan_dana_bantuan_kaling')->with('success', 'Usulan berhasil dihapus.');
    }

    // Fungsi untuk menerima usulan
    public function accept(Request $request,$id)
    {
        $usulan = UsulanDanaBantuan::find($id);
        $usulan->status = '1'; // 1 = Diterima
        $usulan->keterangan = $request->input('keterangan_diterima'); // Isi keterangan dari form
        $usulan->tgl_musreng = $request->input('tanggal_musrenbang_diterima'); // Isi keterangan dari form
        $usulan->save();

        return redirect()->back()->with('success', 'Usulan diterima.');
    }

    // Fungsi untuk menolak usulan
    public function reject(Request $request, $id)
    {
        $usulan = UsulanDanaBantuan::find($id);
        $usulan->status = $request->input('jenis_penolakan'); // 0 = Ditolak Permanen, 3 = Ditolak Sementara
        $usulan->keterangan = $request->input('keterangan_penolakan'); // Isi keterangan dari form
        
        $tanggalMusrenbangDitolak = $request->input('tanggal_musrenbang_ditolak');
        $tanggalMusrenbangDitolak = $tanggalMusrenbangDitolak ?: Carbon::now()->toDateString();

        $usulan->tgl_musreng = $tanggalMusrenbangDitolak; // Isi keterangan dari form
        $usulan->save();

        return redirect()->back()->with('success', 'Usulan ditolak.');
    }

    public function ajukanUlang(Request $request, $id)
    {
        $usulanDanaBantuan = UsulanDanaBantuan::findOrFail($id);

        // Validasi data yang diterima dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'usulan_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi tambahan untuk file
            'surat_pernyataan_kaling' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi tambahan untuk file
            'alamat' => 'required|string|max:255',
            'id_bantuans' => 'required|integer',
            'keterangan' => 'required|string|max:500',
        ]);

        $input = $request->all(); // Mendapatkan semua input dari request

        // Penanganan upload file 'usulan_ktp'
        if ($request->hasFile('usulan_ktp')) {
            try {
                // Hapus file lama jika ada
                $this->deleteOldFile(public_path('storage/usulan_ktp/'), $usulanDanaBantuan->usulan_ktp, 'default-id-card.JPG');

                // Unggah file baru
                $input['usulan_ktp'] = $this->uploadFile($request->file('usulan_ktp'), 'usulan_ktp');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'File upload error: ' . $e->getMessage()]);
            }
        } else {
            $input['usulan_ktp'] = $usulanDanaBantuan->usulan_ktp;
        }

        // Penanganan upload file 'surat_pernyataan_kaling'
        if ($request->hasFile('surat_pernyataan_kaling')) {
            try {
                // Hapus file lama jika ada
                $this->deleteOldFile(public_path('storage/surat_pernyataan_kaling/'), $usulanDanaBantuan->surat_pernyataan_kaling, '-');

                // Unggah file baru
                $input['surat_pernyataan_kaling'] = $this->uploadFile($request->file('surat_pernyataan_kaling'), 'surat_pernyataan_kaling');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'File upload error: ' . $e->getMessage()]);
            }
        } else {
            $input['surat_pernyataan_kaling'] = $usulanDanaBantuan->surat_pernyataan_kaling;
        }

        // Mengatur status menjadi 'Pengajuan Baru'
        $input['status'] = '2';

        // Perbarui data usulan
        if (!$usulanDanaBantuan->update($input)) {
            return back()->withErrors(['error' => 'Gagal mengupdate data usulan dana bantuan.']);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('usulan_dana_bantuan_kaling')->with('success', 'Usulan dana bantuan berhasil diajukan ulang.');
    }

    private function deleteOldFile($path, $filename, $ignoreFile)
    {
        $oldFilePath = $path . $filename;
        if (file_exists($oldFilePath) && $filename != $ignoreFile) {
            unlink($oldFilePath);
        }
    }

    private function uploadFile($file, $folder)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('storage/' . $folder);
        $file->move($destinationPath, $fileName);
        return $fileName;
    }

    public function cetak_laporan()
    {
        $UsulanDanaBantuans = UsulanDanaBantuan::with('banjar')->where('status', '!=', '1')->get();

        return view('admin.usulan_dana_bantuan.cetak_laporan', compact('UsulanDanaBantuans'))->with('i');
    }

    public function exportXlsx()
    {
        // Membuat instance dari Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Mengatur header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'Usulan');
        $sheet->setCellValue('F1', 'Tanggal Pengajuan');
        $sheet->setCellValue('G1', 'Lingkungan');
        $sheet->setCellValue('H1', 'Status');
        $sheet->setCellValue('I1', 'Keterangan');

        // Mengatur lebar kolom agar otomatis
        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Mengubah warna background header menjadi soft gray
        $sheet->getStyle('A1:I1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFD3D3D3'], // Soft Gray
            ],
            'font' => [
                'bold' => true,
            ],
        ]);

        // Mengambil data dari database
        // $usulanDanaBantuans = UsulanDanaBantuan::all();
        $UsulanDanaBantuans = UsulanDanaBantuan::with('banjar')->where('status', '!=', '1')->get();

        

        // Menulis data ke dalam file Excel
        $row = 2; // Mulai menulis dari baris kedua
        $no = 1; // Penomoran mulai dari 1
        foreach ($UsulanDanaBantuans as $usulan) {
            $sheet->setCellValue('A' . $row, $no++); // Menambahkan nomor urut
            $sheet->setCellValue('B' . $row, $usulan->id);
            $sheet->setCellValue('C' . $row, $usulan->nama);
            $sheet->setCellValue('D' . $row, $usulan->alamat);
            $sheet->setCellValue('E' . $row, $usulan->bantuan->nama_bantuan ?? 'N/A');
            $sheet->setCellValue('F' . $row, $usulan->created_at->format('Y-m-d'));
            $sheet->setCellValue('G' . $row, $usulan->banjar->nama_banjar ?? 'N/A');
            $sheet->setCellValue('H' . $row, $usulan->status_label);
            $cleanedText = trim(html_entity_decode(strip_tags(str_replace(['<br>', '<br />'], "\n", $usulan->keterangan))));
            $sheet->setCellValue('I' . $row, $cleanedText);
            $row++;
        }

        // Menambahkan border ke seluruh data (A1 sampai I(row terakhir))
        $sheet->getStyle('A1:I' . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'], // Hitam
                ],
            ],
        ]);

        // Membuat Writer untuk mengonversi spreadsheet menjadi file XLSX
        $writer = new Xlsx($spreadsheet);

        // Membuat StreamedResponse untuk mendownload file
        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        // Mengatur header respons dengan benar menggunakan `headers->set()`
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="usulan_dana_bantuan.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }

    
}