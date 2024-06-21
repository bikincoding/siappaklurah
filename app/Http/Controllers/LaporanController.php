<?php

namespace App\Http\Controllers;

use App\Models\Banjar;
use App\Models\SumberDayaManusia;
use App\Models\LaporanBulanTahun;
use App\Models\Laporan;
use App\Models\Agama;
use App\Models\Usia;
use App\Models\Pendidikan;
use App\Models\MataPencaharianPokok;
use App\Models\Kewarganegaraan;
use App\Models\Etnis;
use App\Models\CacatMentalFisik;
use App\Models\TenagaKerja;
use App\Models\KualitasAngkatanKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $banjars = Banjar::all();

    $datas = SumberDayaManusia::query()
        ->join('laporan_bulan_tahuns', 'sumber_daya_manusias.id_laporan_bulan_tahuns', '=', 'laporan_bulan_tahuns.id')
        ->join('banjars', 'sumber_daya_manusias.id_banjars', '=', 'banjars.id')
        ->select(
            'sumber_daya_manusias.id_banjars',
            'laporan_bulan_tahuns.id',
            'laporan_bulan_tahuns.bulan',
            'laporan_bulan_tahuns.tahun',
            'banjars.nama_banjar'
        )
        ->get(); // Menggunakan get() untuk mendapatkan semua data

        $datas_all = SumberDayaManusia::query()
            ->join('laporan_bulan_tahuns', 'sumber_daya_manusias.id_laporan_bulan_tahuns', '=', 'laporan_bulan_tahuns.id')
            ->distinct()
            ->select('laporan_bulan_tahuns.id', 'laporan_bulan_tahuns.bulan', 'laporan_bulan_tahuns.tahun')
            ->get();

    $i = 0; // Inisialisasi penomoran
    $j = 0; // Inisialisasi penomoran

    return view('admin.laporan.index', compact('datas','datas_all', 'banjars', 'i', 'j'));
}



    public function filter(Request $request)
    {
        $banjars = Banjar::all();

        // Build the query with initial joins and select
        $query = SumberDayaManusia::query()
            ->join('laporan_bulan_tahuns', 'sumber_daya_manusias.id_laporan_bulan_tahuns', '=', 'laporan_bulan_tahuns.id')
            ->join('banjars', 'sumber_daya_manusias.id_banjars', '=', 'banjars.id')
            ->select(
                'sumber_daya_manusias.id_banjars',
                'laporan_bulan_tahuns.id',
                'laporan_bulan_tahuns.bulan',
                'laporan_bulan_tahuns.tahun',
                'banjars.nama_banjar'
            );

        // Apply filters based on the request
        if ($request->has('bulan') && $request->bulan != '') {
            $query->where('laporan_bulan_tahuns.bulan', $request->bulan);
        }

        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('laporan_bulan_tahuns.tahun', $request->tahun);
        }

        if ($request->has('id_banjar') && $request->id_banjar != '') {
            $query->where('banjars.id', $request->id_banjar);
        }

        // Execute the query and get the results
        $datas = $query->get();

        return view('admin.laporan.index', compact('datas', 'banjars'))
        ->with('i', (request()->input('page', 1) - 1) * 5)
        ->withInput($request->input()); 
    }



    public function cetak_laporan_sumber_daya_manusia(string $id_banjars,$id)
    {
        $banjarId = $id_banjars;


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

     
        return view('admin.laporan.cetak_laporan_sumber_daya_manusia', compact('laporanBulanTahun', 'sumberDayaManusia', 'usias','pendidikans','matapencaharianpokoks','agamas','kewarganegaraans','etniss','cacats','tenagakerjas','kualitasangkatankerjas','banjar', 'total_laki_laki_mp','total_perempuan_mp','total_laki_laki_ag', 'total_perempuan_ag','total_laki_laki_kwg','total_perempuan_kwg','total_laki_laki_cct','total_perempuan_cct','total_laki_laki_tk','total_perempuan_tk','total_laki_laki_kak','total_perempuan_kak' ));
    }

    public function cetak_laporan_sumber_daya_manusia_all($id)
    {
       

        $laporanBulanTahun = LaporanBulanTahun::find($id);
        if ($laporanBulanTahun) {
            $bulanAngka = $laporanBulanTahun->bulan; // Angka bulan dari database
            $namaBulan = Carbon::createFromFormat('m', $bulanAngka)->locale('id')->translatedFormat('F');
        
            $laporanBulanTahun->bulan = $namaBulan; // Mengganti atribut bulan dengan nama bulan
        }


        $sumberDayaManusia = SumberDayaManusia::where('id_laporan_bulan_tahuns', $id)
        ->select(
            DB::raw('SUM(jumlah_laki_laki) as jumlah_laki_laki'),
            DB::raw('SUM(jumlah_perempuan) as jumlah_perempuan'),
            DB::raw('SUM(jumlah_total) as jumlah_total'),
            DB::raw('SUM(jumlah_kepala_keluarga) as jumlah_kepala_keluarga'),
            DB::raw('SUM(kepadatan_penduduk) as kepadatan_penduduk')
        )
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
        ->select(
            'usia',
            DB::raw('SUM(laki_laki) as total_laki_laki'),
            DB::raw('SUM(perempuan) as total_perempuan')
        )
        ->groupBy('usia')
        ->orderBy('usia', 'asc') // Mengurutkan berdasarkan kolom usia dari terkecil ke terbesar
        ->get();
        
        $pendidikans = Pendidikan::where('id_laporan_bulan_tahuns', $id)
        ->select(
            'tingkatan_pendidikan',
            DB::raw('SUM(laki_laki) as total_laki_laki'),
            DB::raw('SUM(perempuan) as total_perempuan')
        )
        ->groupBy('tingkatan_pendidikan')
        ->orderBy('tingkatan_pendidikan', 'asc') // Mengurutkan berdasarkan kolom usia dari terkecil ke terbesar
        ->get(); 

        $matapencaharianpokoks = MataPencaharianPokok::where('id_laporan_bulan_tahuns', $id)
        ->select(
            'jenis_pekerjaan',
            DB::raw('SUM(laki_laki) as total_laki_laki'),
            DB::raw('SUM(perempuan) as total_perempuan')
        )
        ->groupBy('jenis_pekerjaan')
        ->orderBy('jenis_pekerjaan', 'asc') // Mengurutkan berdasarkan kolom usia dari terkecil ke terbesar
        ->get(); 
       

        $total_laki_laki_mp = $matapencaharianpokoks->sum('total_laki_laki');
        $total_perempuan_mp = $matapencaharianpokoks->sum('total_perempuan');

        $agamas = Agama::where('id_laporan_bulan_tahuns', $id)
        ->select(
            'agama',
            DB::raw('SUM(laki_laki) as total_laki_laki'),
            DB::raw('SUM(perempuan) as total_perempuan')
        )
        ->groupBy('agama')
        ->orderBy('agama', 'asc') // Mengurutkan berdasarkan kolom usia dari terkecil ke terbesar
        ->get(); 
  

        $total_laki_laki_ag = $agamas->sum('total_laki_laki');
        $total_perempuan_ag = $agamas->sum('total_perempuan');

        $kewarganegaraans = Kewarganegaraan::where('id_laporan_bulan_tahuns', $id)
        ->select(
            'kewarganegaraan',
            DB::raw('SUM(laki_laki) as total_laki_laki'),
            DB::raw('SUM(perempuan) as total_perempuan')
        )
        ->groupBy('kewarganegaraan')
        ->orderBy('kewarganegaraan', 'asc') // Mengurutkan berdasarkan kolom usia dari terkecil ke terbesar
        ->get(); 

        $total_laki_laki_kwg = $kewarganegaraans->sum('total_laki_laki');
        $total_perempuan_kwg = $kewarganegaraans->sum('total_perempuan');

        $etniss = Etnis::where('id_laporan_bulan_tahuns', $id)
        ->select(
            'etnis',
            DB::raw('SUM(laki_laki) as total_laki_laki'),
            DB::raw('SUM(perempuan) as total_perempuan')
        )
        ->groupBy('etnis')
        ->orderBy('etnis', 'asc') // Mengurutkan berdasarkan kolom usia dari terkecil ke terbesar
        ->get(); 

        $cacats = CacatMentalFisik::where('id_laporan_bulan_tahuns', $id)
        ->select(
            'jenis_cacat',
            DB::raw('SUM(laki_laki) as total_laki_laki'),
            DB::raw('SUM(perempuan) as total_perempuan')
        )
        ->groupBy('jenis_cacat')
        ->orderBy('jenis_cacat', 'asc') // Mengurutkan berdasarkan kolom usia dari terkecil ke terbesar
        ->get(); 

        $total_laki_laki_cct = $cacats->sum('total_laki_laki');
        $total_perempuan_cct = $cacats->sum('total_perempuan');

        $tenagakerjas = TenagaKerja::where('id_laporan_bulan_tahuns', $id)
        ->select(
            'tenaga_kerja',
            DB::raw('SUM(laki_laki) as total_laki_laki'),
            DB::raw('SUM(perempuan) as total_perempuan')
        )
        ->groupBy('tenaga_kerja')
        ->orderBy('tenaga_kerja', 'asc') // Mengurutkan berdasarkan kolom usia dari terkecil ke terbesar
        ->get(); 

        $total_laki_laki_tk = $tenagakerjas->sum('total_laki_laki');
        $total_perempuan_tk = $tenagakerjas->sum('total_perempuan');

        $kualitasangkatankerjas = KualitasAngkatanKerja::where('id_laporan_bulan_tahuns', $id)
        ->select(
            'angkatan_kerja',
            DB::raw('SUM(laki_laki) as total_laki_laki'),
            DB::raw('SUM(perempuan) as total_perempuan')
        )
        ->groupBy('angkatan_kerja')
        ->orderBy('angkatan_kerja', 'asc') // Mengurutkan berdasarkan kolom usia dari terkecil ke terbesar
        ->get(); 

        $total_laki_laki_kak = $kualitasangkatankerjas->sum('total_laki_laki');
        $total_perempuan_kak = $kualitasangkatankerjas->sum('total_perempuan');

     
        return view('admin.laporan.cetak_laporan_sumber_daya_manusia_all', compact('laporanBulanTahun', 'sumberDayaManusia', 'usias','pendidikans','matapencaharianpokoks','agamas','kewarganegaraans','etniss','cacats','tenagakerjas','kualitasangkatankerjas', 'total_laki_laki_mp','total_perempuan_mp','total_laki_laki_ag', 'total_perempuan_ag','total_laki_laki_kwg','total_perempuan_kwg','total_laki_laki_cct','total_perempuan_cct','total_laki_laki_tk','total_perempuan_tk','total_laki_laki_kak','total_perempuan_kak' ));
    }

}