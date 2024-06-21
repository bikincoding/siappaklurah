<?php

namespace App\Http\Controllers;

use App\Models\LaporanBulanTahun;
use App\Models\SumberDayaManusia;
use App\Models\Usia;
use App\Models\Banjar;
use App\Models\Pendidikan;
use App\Models\MataPencaharianPokok;
use App\Models\Agama;
use App\Models\Kewarganegaraan;
use App\Models\Etnis;
use App\Models\CacatMentalFisik;
use App\Models\TenagaKerja;
use App\Models\KualitasAngkatanKerja;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = LaporanBulanTahun::all();
        return view('user.pelaporan', compact('laporans'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function data_pokok(string $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id;
        $laporanBulanTahun = LaporanBulanTahun::find($id);
        $sumberDayaManusia = SumberDayaManusia::where('id_laporan_bulan_tahuns', $id)
                                            ->where('id_banjars', $banjarId)
                                            ->first(); 
        

        // Jika tidak ada data yang ditemukan, inisialisasi dengan nilai default
        if (!$sumberDayaManusia) {
            $sumberDayaManusia = new SumberDayaManusia([
                'jumlah_laki_laki' => 0,
                'jumlah_perempuan' => 0,
                'jumlah_total' => 0,
                'jumlah_kepala_keluarga' => 0,
                'kepadatan_penduduk' => 0,
            ]);
        }

        $usias = Usia::where('id_laporan_bulan_tahuns', $id)
                                            ->where('id_banjars', $banjarId)
                                            ->get(); 
        
        $pendidikans = Pendidikan::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $matapencaharianpokoks = MataPencaharianPokok::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $agamas = Agama::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $kewarganegaraans = Kewarganegaraan::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $etniss = Etnis::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $cacats = CacatMentalFisik::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $tenagakerjas = TenagaKerja::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $kualitasangkatankerjas = KualitasAngkatanKerja::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        return view('user.pelaporan.index', compact('laporanBulanTahun', 'sumberDayaManusia', 'usias','pendidikans','matapencaharianpokoks','agamas','kewarganegaraans','etniss','cacats','tenagakerjas','kualitasangkatankerjas' ))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store_sumber_daya_manusia(Request $request, $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id; // Mendapatkan ID Banjar dari user yang terautentikasi

        // Mencari SumberDayaManusia berdasarkan id_laporan_bulan_tahuns dan id_banjars
        $sumberDayaManusia = SumberDayaManusia::where('id_laporan_bulan_tahuns', $id)
                                            ->where('id_banjars', $banjarId)
                                            ->first();

        if (!$sumberDayaManusia) {
            // Jika tidak ada data, buat instansi baru dan simpan data
            $sumberDayaManusia = new SumberDayaManusia;
            $sumberDayaManusia->id_laporan_bulan_tahuns = $id;
            $sumberDayaManusia->id_banjars = $banjarId;
        }

        // Menetapkan nilai dari request ke properti sumberDayaManusia
        $sumberDayaManusia->jumlah_laki_laki = $request->input('jumlah_laki_laki');
        $sumberDayaManusia->jumlah_perempuan = $request->input('jumlah_perempuan');
        $sumberDayaManusia->jumlah_total = $request->input('jumlah_total');
        $sumberDayaManusia->jumlah_kepala_keluarga = $request->input('jumlah_kepala_keluarga');
        $sumberDayaManusia->kepadatan_penduduk = $request->input('kepadatan_penduduk');

        // Menyimpan atau memperbarui data di database
        $sumberDayaManusia->save();

        // Redirect ke halaman tertentu setelah berhasil menyimpan atau memperbarui data
        // return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan');
        // session(['selectedOption' => $request->input('selectOption')]);
        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan')->withInput();
        
    }

    public function store_usias(Request $request, string $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id; // Mendapatkan ID Banjar dari user yang terautentikasi

        // Validasi request
        $request->validate([
            'usia' => 'required',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
        ]);

        // Membuat atau memperbarui data usia
        $usia = Usia::updateOrCreate(
            [
                'id_laporan_bulan_tahuns' => $id,
                'id_banjars' => $banjarId,
                'usia' => $request->usia
            ],
            [
                'laki_laki' => $request->laki_laki,
                'perempuan' => $request->perempuan
            ]
        );

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan')->withInput();
    }

    public function destroy_usia($id, $usiaId)
    {
        $usia = Usia::findOrFail($usiaId);
        $usia->delete();

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan')->withInput();
    }

    public function store_pendidikan(Request $request, string $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id; // Mendapatkan ID Banjar dari user yang terautentikasi

        // Validasi request
        $request->validate([
            'tingkatan_pendidikan' => 'required',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
        ]);

        // Membuat atau memperbarui data pendidikan
        $pendidikan = Pendidikan::updateOrCreate(
            [
                'id_laporan_bulan_tahuns' => $id,
                'id_banjars' => $banjarId,
                'tingkatan_pendidikan' => $request->tingkatan_pendidikan
            ],
            [
                'laki_laki' => $request->laki_laki,
                'perempuan' => $request->perempuan
            ]
        );

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data Pendidikan berhasil disimpan')->withInput();
    }

    public function destroy_pendidikan($id, $pendidikanId)
    {
        $pendidikan = Pendidikan::findOrFail($pendidikanId);
        $pendidikan->delete();

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data Pendidikan berhasil dihapus')->withInput();
    }

    public function store_matapencaharianpokok(Request $request, string $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id; // Mendapatkan ID Banjar dari user yang terautentikasi
        $request->validate([
            'jenis_pekerjaan' => 'required|string',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            // Pastikan untuk memvalidasi id_banjars jika perlu
        ]);

        // Membuat atau memperbarui data pendidikan
        $matapencaharianpokok = MataPencaharianPokok::updateOrCreate(
            [
                'id_laporan_bulan_tahuns' => $id,
                'id_banjars' => $banjarId,
                'jenis_pekerjaan' => $request->jenis_pekerjaan
            ],
            [
                'laki_laki' => $request->laki_laki,
                'perempuan' => $request->perempuan
            ]
        );

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan');
    }

    public function destroy_matapencaharianpokok($id, $mpId)
    {
        $mp = MataPencaharianPokok::findOrFail($mpId);
        $mp->delete();

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil dihapus');
    }

    public function store_agama(Request $request, string $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id; // Mendapatkan ID Banjar dari user yang terautentikasi
        $request->validate([
            'agama' => 'required|string',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            // Pastikan untuk memvalidasi id_banjars jika perlu
        ]);

        // Membuat atau memperbarui data pendidikan
        $agama = Agama::updateOrCreate(
            [
                'id_laporan_bulan_tahuns' => $id,
                'id_banjars' => $banjarId,
                'agama' => $request->agama
            ],
            [
                'laki_laki' => $request->laki_laki,
                'perempuan' => $request->perempuan
            ]
        );

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan');
    }

    public function destroy_agama($id, $agamaId)
    {
        $agama = Agama::findOrFail($agamaId);
        $agama->delete();

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil dihapus');
    }

    public function store_kewarganegaraan(Request $request, string $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id; // Mendapatkan ID Banjar dari user yang terautentikasi
        $request->validate([
            'kewarganegaraan' => 'required|string',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            // Pastikan untuk memvalidasi id_banjars jika perlu
        ]);

        // Membuat atau memperbarui data pendidikan
        $kewarganegaraan = Kewarganegaraan::updateOrCreate(
            [
                'id_laporan_bulan_tahuns' => $id,
                'id_banjars' => $banjarId,
                'kewarganegaraan' => $request->kewarganegaraan
            ],
            [
                'laki_laki' => $request->laki_laki,
                'perempuan' => $request->perempuan
            ]
        );

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan');
    }

    public function destroy_kewarganegaraan($id, $kewarganegaraanId)
    {
        $kewarganegaraan = Kewarganegaraan::findOrFail($kewarganegaraanId);
        $kewarganegaraan->delete();

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil dihapus');
    }

    public function store_etnis(Request $request, string $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id; // Mendapatkan ID Banjar dari user yang terautentikasi
        $request->validate([
            'etnis' => 'required|string',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            // Pastikan untuk memvalidasi id_banjars jika perlu
        ]);

        // Membuat atau memperbarui data pendidikan
        $etnis = Etnis::updateOrCreate(
            [
                'id_laporan_bulan_tahuns' => $id,
                'id_banjars' => $banjarId,
                'etnis' => $request->etnis
            ],
            [
                'laki_laki' => $request->laki_laki,
                'perempuan' => $request->perempuan
            ]
        );

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan');
    }

    public function destroy_etnis($id, $etnisId)
    {
        $etnis = Etnis::findOrFail($etnisId);
        $etnis->delete();

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil dihapus');
    }

    public function store_cacat(Request $request, string $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id; // Mendapatkan ID Banjar dari user yang terautentikasi
        $request->validate([
            'jenis_cacat' => 'required|string',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            // Pastikan untuk memvalidasi id_banjars jika perlu
        ]);

        // Membuat atau memperbarui data pendidikan
        $cacat = CacatMentalFisik::updateOrCreate(
            [
                'id_laporan_bulan_tahuns' => $id,
                'id_banjars' => $banjarId,
                'jenis_cacat' => $request->jenis_cacat
            ],
            [
                'laki_laki' => $request->laki_laki,
                'perempuan' => $request->perempuan
            ]
        );

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan');
    }

    public function destroy_cacat($id, $cacatId)
    {
        $cacat = CacatMentalFisik::findOrFail($cacatId);
        $cacat->delete();

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil dihapus');
    }

    public function store_tenagakerja(Request $request, string $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id; // Mendapatkan ID Banjar dari user yang terautentikasi
        $request->validate([
            'tenaga_kerja' => 'required|string',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            // Pastikan untuk memvalidasi id_banjars jika perlu
        ]);

        // Membuat atau memperbarui data pendidikan
        $tenagakerja = TenagaKerja::updateOrCreate(
            [
                'id_laporan_bulan_tahuns' => $id,
                'id_banjars' => $banjarId,
                'tenaga_kerja' => $request->tenaga_kerja
            ],
            [
                'laki_laki' => $request->laki_laki,
                'perempuan' => $request->perempuan
            ]
        );

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan');
    }

    public function destroy_tenagakerja($id, $tenagakerjaId)
    {
        $tenagakerja = TenagaKerja::findOrFail($tenagakerjaId);
        $tenagakerja->delete();

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil dihapus');
    }

    public function store_kualitasangkatankerja(Request $request, string $id)
    {
        $banjarId = Auth::user()->kepala_lingkungan->banjar->id; // Mendapatkan ID Banjar dari user yang terautentikasi
        $request->validate([
            'angkatan_kerja' => 'required|string',
            'laki_laki' => 'required|integer',
            'perempuan' => 'required|integer',
            // Pastikan untuk memvalidasi id_banjars jika perlu
        ]);

        // Membuat atau memperbarui data pendidikan
        $kualitasangkatankerja = KualitasAngkatanKerja::updateOrCreate(
            [
                'id_laporan_bulan_tahuns' => $id,
                'id_banjars' => $banjarId,
                'angkatan_kerja' => $request->angkatan_kerja
            ],
            [
                'laki_laki' => $request->laki_laki,
                'perempuan' => $request->perempuan
            ]
        );

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil disimpan');
    }

    public function destroy_kualitasangkatankerja($id, $angkatankerjaId)
    {
        $kualitasangkatankerja = KualitasAngkatanKerja::findOrFail($angkatankerjaId);
        $kualitasangkatankerja->delete();

        return redirect()->route('pelaporan.data_pokok', $id)->with('success', 'Data berhasil dihapus');
    }


    public function cetak_laporan_lingkungan($id)
    {
        $id = $id;
        $banjarId = Auth::user()->kepala_lingkungan->id_banjars;

        $banjar = Banjar::where('id', $banjarId)->first();

        $laporanBulanTahun = LaporanBulanTahun::find($id);
        if ($laporanBulanTahun) {
            $bulanAngka = $laporanBulanTahun->bulan; // Angka bulan dari database
            $namaBulan = Carbon::createFromFormat('m', $bulanAngka)->locale('id')->translatedFormat('F');
        
            $laporanBulanTahun->bulan = $namaBulan; // Mengganti atribut bulan dengan nama bulan
        }


        $sumberDayaManusia = SumberDayaManusia::where('id_laporan_bulan_tahuns', $id)
                                            ->where('id_banjars', $banjarId)
                                            ->first(); 

        // Jika tidak ada data yang ditemukan, inisialisasi dengan nilai default
        if (!$sumberDayaManusia) {
            $sumberDayaManusia = new SumberDayaManusia([
                'jumlah_laki_laki' => 0,
                'jumlah_perempuan' => 0,
                'jumlah_total' => 0,
                'jumlah_kepala_keluarga' => 0,
                'kepadatan_penduduk' => 0,
            ]);
        }

        $usias = Usia::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 
        
        $pendidikans = Pendidikan::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $matapencaharianpokoks = MataPencaharianPokok::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $total_laki_laki_mp = $matapencaharianpokoks->sum('laki_laki');
        $total_perempuan_mp = $matapencaharianpokoks->sum('perempuan');

        $agamas = Agama::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $total_laki_laki_ag = $agamas->sum('laki_laki');
        $total_perempuan_ag = $agamas->sum('perempuan');

        $kewarganegaraans = Kewarganegaraan::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $total_laki_laki_kwg = $kewarganegaraans->sum('laki_laki');
        $total_perempuan_kwg = $kewarganegaraans->sum('perempuan');

        $etniss = Etnis::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $cacats = CacatMentalFisik::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $total_laki_laki_cct = $cacats->sum('laki_laki');
        $total_perempuan_cct = $cacats->sum('perempuan');

        $tenagakerjas = TenagaKerja::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $total_laki_laki_tk = $tenagakerjas->sum('laki_laki');
        $total_perempuan_tk = $tenagakerjas->sum('perempuan');

        $kualitasangkatankerjas = KualitasAngkatanKerja::where('id_laporan_bulan_tahuns', $id)
        ->where('id_banjars', $banjarId)
        ->get(); 

        $total_laki_laki_kak = $kualitasangkatankerjas->sum('laki_laki');
        $total_perempuan_kak = $kualitasangkatankerjas->sum('perempuan');

        return view('user.pelaporan.cetak_laporan_lingkungan', compact('laporanBulanTahun', 'sumberDayaManusia', 'usias','pendidikans','matapencaharianpokoks','agamas','kewarganegaraans','etniss','cacats','tenagakerjas','kualitasangkatankerjas','banjar', 'total_laki_laki_mp','total_perempuan_mp','total_laki_laki_ag', 'total_perempuan_ag','total_laki_laki_kwg','total_perempuan_kwg','total_laki_laki_cct','total_perempuan_cct','total_laki_laki_tk','total_perempuan_tk','total_laki_laki_kak','total_perempuan_kak'));
    }

}