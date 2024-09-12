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
use App\Models\KepalaLingkungan;
use App\Models\UsulanDanaBantuan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataKerobokanKajaController extends Controller
{
    
    public function index()
    {

        $datas_all = SumberDayaManusia::query()
            ->join('laporan_bulan_tahuns', 'sumber_daya_manusias.id_laporan_bulan_tahuns', '=', 'laporan_bulan_tahuns.id')
            ->distinct()
            ->select('laporan_bulan_tahuns.id', 'laporan_bulan_tahuns.bulan', 'laporan_bulan_tahuns.tahun')
            ->get();

        

        // Ambil semua Banjar kecuali yang memiliki id 34 - Informasi Kepala Lingkungan ----------------------------------------------------------------------
        $kepalaLingkungans = KepalaLingkungan::with('banjar')
        ->where('id_banjars', '!=', 34)
        ->get();

        // Ambil semua Banjar kecuali yang memiliki id 34 --------------------------------------------------------------------------------------
        $lingkungans = Banjar::where('id', '!=', 34)->get();

        // Ambil id dari Banjar yang telah diambil di atas
        // $lingkunganIds = $lingkungans->pluck('id');

        // Ambil Kepala Lingkungan yang banjarnya bukan 34 dan berada dalam lingkungan yang telah diambil
        // $kepalaLingkungansPerLingkungans = KepalaLingkungan::with('banjar')
        //         ->where('id_banjars', '!=', 34)
        //         ->whereIn('id_banjars', $lingkunganIds)
        //         ->get();


        // Lingkungan dan Kepala Batuculung
        $kepalaLingkungansBatuculung = KepalaLingkungan::with('banjar')
        ->where('id', 6)
        ->first();

        $laporanBulanTahunsBatuculung = SumberDayaManusia::join('banjars', 'sumber_daya_manusias.id_banjars', '=', 'banjars.id')
        ->join('laporan_bulan_tahuns', 'sumber_daya_manusias.id_laporan_bulan_tahuns', '=', 'laporan_bulan_tahuns.id')
        ->where('sumber_daya_manusias.id_banjars', 8)
        ->get();
        // End Lingkungan dan Kepala Batuculung
                
        
        return view('data_kerobokan_kaja', compact('kepalaLingkungans','lingkungans', 'kepalaLingkungansBatuculung','laporanBulanTahunsBatuculung','datas_all'));
       
    }

    public function cetak_usulan_data_bantuan($tahun) {
        // Ambil data usulan bantuan berdasarkan tahun dan hitung jumlah per id_bantuans
        $UsulanDanaBantuans = UsulanDanaBantuan::select('id_bantuans', DB::raw('count(*) as total'))
            ->whereYear('tgl_musreng', $tahun)
            ->groupBy('id_bantuans')
            ->with('bantuan') // Eager loading untuk mengambil data bantuan terkait
            ->get();
        
        // Definisikan gaya CSS untuk tabel
        $html = '<style>
            .human-resource-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
    
            .human-resource-table th, .human-resource-table td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
    
            .human-resource-table th {
                background-color: #f2f2f2;
            }
    
            .human-resource-table caption {
                caption-side: top;
                font-size: 1.5em;
                font-weight: bold;
                margin: 10px 0;
            }
        </style>';
    
        // Inisialisasi variabel HTML untuk menampung hasil tabel
        $html .= '<table class="human-resource-table">';
        $html .= '<caption style="text-align:center;">Daftar Usulan Data Bantuan Tahun ' . $tahun . '</caption>';
        $html .= '<thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th>Nama Usulan</th>
                        <th style="text-align:center;">Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>';
        
        // Loop melalui setiap data dan tambahkan ke variabel HTML
        $no = 1; // Inisialisasi nomor urut
        foreach ($UsulanDanaBantuans as $UsulanDanaBantuan) {
            $namaBantuan = $UsulanDanaBantuan->bantuan ? $UsulanDanaBantuan->bantuan->nama_bantuan : 'Tidak Diketahui';
            $html .= '<tr>
                        <td style="text-align:center;">' . $no++ . '</td>
                        <td>' . $namaBantuan . '</td>
                        <td style="text-align:center;">' . $UsulanDanaBantuan->total . '</td>
                      </tr>';
        }
        
        $html .= '</tbody></table>'; // Tutup tabel
        
        // Kembalikan hasil dalam bentuk respon HTML
        return response($html);
    }
    
    
    public function cetak_lingkungan_kaling($id)
    {

        $kepalaLingkungans = KepalaLingkungan::with('banjar')
        ->where('id_banjars', $id)
        ->first();

        $fotoUrl = asset('storage/foto_kepala_lingkungan/' . $kepalaLingkungans->foto);

        // ----------------------------------------------------------------------------------------------------------

        $sumberDayaManusia = SumberDayaManusia::join('laporan_bulan_tahuns', 'sumber_daya_manusias.id_laporan_bulan_tahuns', '=', 'laporan_bulan_tahuns.id')
            ->where('sumber_daya_manusias.id_banjars', $id)
            ->select('sumber_daya_manusias.*', 'laporan_bulan_tahuns.tahun', 'laporan_bulan_tahuns.bulan') // pilih kolom yang diinginkan
            ->get();


        // ----------------------------------------------------------------------------------------------------------
       
        $html = "
    <div class='border p-3 mb-3'>
        <div class='row'>
            <div class='col-md-3 '>
                <div class='image-container'>
                    <img src='{$fotoUrl}' class='card-img-top' alt='Foto Kepala Lingkungan'>
                </div>
            </div>
            <div class='col-md-9'>
                <table class='table table-bordered text-start'>
                    <tr>
                        <th>Nama</th>
                        <td>{$kepalaLingkungans->nama_kepala_lingkungan}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{$kepalaLingkungans->alamat}</td>
                    </tr>
                    <tr>
                        <th>Lingkungan</th>
                        <td>{$kepalaLingkungans->banjar->nama_banjar}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{$kepalaLingkungans->telepon}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class='border p-3  mb-3'>";

  
    if ($sumberDayaManusia->isEmpty()) {
        $html .= "<p>Tidak ada data Sumber Daya Manusia.</p>";
    } else {
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
    
        $html .= '<ul class="nav nav-pills " id="pills-tab" role="tablist">';

    foreach ($sumberDayaManusia as $index => $data) {
        $activeClass = $index === 0 ? 'active' : '';
        $html .= "<li class='nav-item' role='presentation'>
                    <button class='nav-link show-data-lingkungan-laporan {$activeClass}' id='pills-{$data->id}-tab' data-id='{$data->id_banjars}' data-id2='{$data->id_laporan_bulan_tahuns}'
                        type='button'>
                        {$bulan[$data->bulan]} {$data->tahun}
                    </button>
                  </li>";
    }

    $html .= '</ul>';
    }
    

    $html .= "
    </div>
   
    ";
        return response($html);

        
    }

    public function cetak_lingkungan_kaling_laporan($id_banjar, $id_laporan_bulan_tahun)
    {
        $banjarId = $id_banjar;
        $laporanBulanTahunID = $id_laporan_bulan_tahun;

        $banjar = Banjar::where('id', $banjarId)->first(); 

        $laporanBulanTahun = LaporanBulanTahun::find($laporanBulanTahunID);
        if ($laporanBulanTahun) {
            $bulanAngka = $laporanBulanTahun->bulan; 
            $namaBulan = Carbon::createFromFormat('m', $bulanAngka)->locale('id')->translatedFormat('F');
        
            $laporanBulanTahun->bulan = $namaBulan; 
        }

        $sumberDayaManusia = SumberDayaManusia::where('id_laporan_bulan_tahuns', $laporanBulanTahunID)
                                            ->where('id_banjars', $banjarId)
                                            ->first(); 

        if (!$sumberDayaManusia) {
            $sumberDayaManusia = new SumberDayaManusia([
                'jumlah_laki_laki' => 0,
                'jumlah_perempuan' => 0,
                'jumlah_total' => 0,
                'jumlah_kepala_keluarga' => 0,
                'kepadatan_penduduk' => 0,
            ]);
        }

        $usias = Usia::where('id_laporan_bulan_tahuns', $laporanBulanTahunID)
                    ->where('id_banjars', $banjarId)
                    ->get(); 
        
        $pendidikans = Pendidikan::where('id_laporan_bulan_tahuns', $laporanBulanTahunID)
                                ->where('id_banjars', $banjarId)
                                ->get(); 

        $matapencaharianpokoks = MataPencaharianPokok::where('id_laporan_bulan_tahuns', $laporanBulanTahunID)
                                                    ->where('id_banjars', $banjarId)
                                                    ->get(); 

        $total_laki_laki_mp = $matapencaharianpokoks->sum('laki_laki');
        $total_perempuan_mp = $matapencaharianpokoks->sum('perempuan');

        $agamas = Agama::where('id_laporan_bulan_tahuns', $laporanBulanTahunID)
                    ->where('id_banjars', $banjarId)
                    ->get(); 

        $total_laki_laki_ag = $agamas->sum('laki_laki');
        $total_perempuan_ag = $agamas->sum('perempuan');

        $kewarganegaraans = Kewarganegaraan::where('id_laporan_bulan_tahuns', $laporanBulanTahunID)
                                        ->where('id_banjars', $banjarId)
                                        ->get(); 

        $total_laki_laki_kwg = $kewarganegaraans->sum('laki_laki');
        $total_perempuan_kwg = $kewarganegaraans->sum('perempuan');

        $etniss = Etnis::where('id_laporan_bulan_tahuns', $laporanBulanTahunID)
                    ->where('id_banjars', $banjarId)
                    ->get(); 

        $cacats = CacatMentalFisik::where('id_laporan_bulan_tahuns', $laporanBulanTahunID)
                                ->where('id_banjars', $banjarId)
                                ->get(); 

        $total_laki_laki_cct = $cacats->sum('laki_laki');
        $total_perempuan_cct = $cacats->sum('perempuan');

        $tenagakerjas = TenagaKerja::where('id_laporan_bulan_tahuns', $laporanBulanTahunID)
                                ->where('id_banjars', $banjarId)
                                ->get(); 

        $total_laki_laki_tk = $tenagakerjas->sum('laki_laki');
        $total_perempuan_tk = $tenagakerjas->sum('perempuan');

        $kualitasangkatankerjas = KualitasAngkatanKerja::where('id_laporan_bulan_tahuns', $laporanBulanTahunID)
                                                    ->where('id_banjars', $banjarId)
                                                    ->get(); 

        $total_laki_laki_kak = $kualitasangkatankerjas->sum('laki_laki');
        $total_perempuan_kak = $kualitasangkatankerjas->sum('perempuan');

        $html = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Human Resource Potential Table</title>
    <style>
        .human-resource-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .human-resource-table th, .human-resource-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .human-resource-table th {
            background-color: #f2f2f2;
        }

        .human-resource-table caption {
            caption-side: top;
            font-size: 1.5em;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>

    <script type='text/javascript'>
        window.onload = function() {
            window.print();
        }
    </script>
    </head>
    <body>

    <table class='human-resource-table'>
       
        <caption>LINGKUNGAN " . strtoupper($banjar->nama_banjar) . " BULAN " . strtoupper($laporanBulanTahun->bulan) . " TAHUN " . $laporanBulanTahun->tahun . " </caption>
        <thead>
            <tr>
                <th colspan='2'>A. JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jumlah laki-laki</td>
                <td>" . $sumberDayaManusia->jumlah_laki_laki . " orang</td>
            </tr>
            <tr>
                <td>Jumlah perempuan</td>
                <td>" . $sumberDayaManusia->jumlah_perempuan . " orang</td>
            </tr>
            <tr>
                <td>Jumlah total</td>
                <td>" . $sumberDayaManusia->jumlah_total . " orang</td>
            </tr>
            <tr>
                <td>Jumlah kepala keluarga</td>
                <td>" . $sumberDayaManusia->jumlah_kepala_keluarga . " KK</td>
            </tr>
            <tr>
                <td>Kepadatan Penduduk</td>
                <td>" . $sumberDayaManusia->kepadatan_penduduk . " per KM</td>
            </tr>
        </tbody>
    </table>

    <table class='human-resource-table'>
        <thead>
            <tr>
                <th colspan='3'>B. USIA</th>
            </tr>
            <tr>
                <th>Usia</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($usias as $usia) {
        $html .= "<tr><td>{$usia->usia}</td><td>{$usia->laki_laki}</td><td>{$usia->perempuan}</td></tr>";
    }
    $html .= "
        </tbody>
    </table>

    <table class='human-resource-table'>
        <thead>
            <tr>
                <th colspan='3'>C. PENDIDIKAN</th>
            </tr>
            <tr>
                <th>Tingkatan Pendidikan</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($pendidikans as $pendidikan) {
        $html .= "<tr><td>{$pendidikan->tingkatan_pendidikan}</td><td>{$pendidikan->laki_laki}</td><td>{$pendidikan->perempuan}</td></tr>";
    }
    $html .= "
        </tbody>
    </table>

    <table class='human-resource-table'>
        <thead>
            <tr>
                <th colspan='3'>D. MATA PENCAHARIAN POKOK</th>
            </tr>
            <tr>
                <th>Jenis Pekerjaan</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($matapencaharianpokoks as $matapencaharianpokok) {
        $html .= "<tr><td>{$matapencaharianpokok->jenis_pekerjaan}</td><td>{$matapencaharianpokok->laki_laki}</td><td>{$matapencaharianpokok->perempuan}</td></tr>";
    }
    $html .= "
            <tr>
                <td>Jumlah Total Penduduk</td>
                <td>{$total_laki_laki_mp} orang</td>
                <td>{$total_perempuan_mp} orang</td>
            </tr>
        </tbody>
    </table>

    <table class='human-resource-table'>
        <thead>
            <tr>
                <th colspan='3'>E. AGAMA/ALIRAN KEPERCAYAAN</th>
            </tr>
            <tr>
                <th>Agama</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($agamas as $agama) {
        $html .= "<tr><td>{$agama->agama}</td><td>{$agama->laki_laki}</td><td>{$agama->perempuan}</td></tr>";
    }
    $html .= "
            <tr>
                <td>Jumlah</td>
                <td>{$total_laki_laki_ag} orang</td>
                <td>{$total_perempuan_ag} orang</td>
            </tr>
        </tbody>
    </table>

    <table class='human-resource-table'>
        <thead>
            <tr>
                <th colspan='3'>F. KEWARGANEGARAAN</th>
            </tr>
            <tr>
                <th>Kewarganegaraan</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($kewarganegaraans as $kewarganegaraan) {
        $html .= "<tr><td>{$kewarganegaraan->kewarganegaraan}</td><td>{$kewarganegaraan->laki_laki}</td><td>{$kewarganegaraan->perempuan}</td></tr>";
    }
    $html .= "
            <tr>
                <td>Jumlah</td>
                <td>{$total_laki_laki_kwg} orang</td>
                <td>{$total_perempuan_kwg} orang</td>
            </tr>
        </tbody>
    </table>

    <table class='human-resource-table'>
        <thead>
            <tr>
                <th colspan='3'>G. ETNIS</th>
            </tr>
            <tr>
                <th>Etnis</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($etniss as $etnis) {
        $html .= "<tr><td>{$etnis->etnis}</td><td>{$etnis->laki_laki}</td><td>{$etnis->perempuan}</td></tr>";
    }
    $html .= "
        </tbody>
    </table>

    <table class='human-resource-table'>
        <thead>
            <tr>
                <th colspan='3'>H. CACAT MENTAL DAN FISIK</th>
            </tr>
            <tr>
                <th>Jenis Cacat</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($cacats as $cacat) {
        $html .= "<tr><td>{$cacat->jenis_cacat}</td><td>{$cacat->laki_laki}</td><td>{$cacat->perempuan}</td></tr>";
    }
    $html .= "
            <tr>
                <td>Jumlah</td>
                <td>{$total_laki_laki_cct} orang</td>
                <td>{$total_perempuan_cct} orang</td>
            </tr>
        </tbody>
    </table>

    <table class='human-resource-table'>
        <thead>
            <tr>
                <th colspan='3'>I. TENAGA KERJA</th>
            </tr>
            <tr>
                <th>Tenaga Kerja</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($tenagakerjas as $tenagakerja) {
        $html .= "<tr><td>{$tenagakerja->tenaga_kerja}</td><td>{$tenagakerja->laki_laki}</td><td>{$tenagakerja->perempuan}</td></tr>";
    }
    $html .= "
            <tr>
                <td>Jumlah</td>
                <td>{$total_laki_laki_tk} orang</td>
                <td>{$total_perempuan_tk} orang</td>
            </tr>
        </tbody>
    </table>

    <table class='human-resource-table'>
        <thead>
            <tr>
                <th colspan='3'>J. KUALITAS ANGKATAN KERJA</th>
            </tr>
            <tr>
                <th>Angkatan Kerja</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
            </tr>
        </thead>
        <tbody>";
    foreach ($kualitasangkatankerjas as $kualitasangkatankerja) {
        $html .= "<tr><td>{$kualitasangkatankerja->angkatan_kerja}</td><td>{$kualitasangkatankerja->laki_laki}</td><td>{$kualitasangkatankerja->perempuan}</td></tr>";
    }
    $html .= "
            <tr>
                <td>Jumlah</td>
                <td>{$total_laki_laki_kak} orang</td>
                <td>{$total_perempuan_kak} orang</td>
            </tr>
        </tbody>
    </table>

    </body>
    </html>";

    return response($html);
    }


    

    public function cetak_lingkungan_kerobokan_kaja($id)
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

        $html = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Human Resource Potential Table</title>
    <style>
        .human-resource-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .human-resource-table th, .human-resource-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .human-resource-table th {
            background-color: #f2f2f2;
        }

        .human-resource-table caption {
            caption-side: top;
            font-size: 1.5em;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>

    <script type='text/javascript'>
        window.onload = function() {
            window.print();
        }
    </script>
    </head>
    <body>
    <div class='container'>
    
        
        <table class='human-resource-table'>
           
            <caption>KELURAHAN KEROBOKAN KAJA BULAN " . strtoupper($laporanBulanTahun->bulan) ." TAHUN {$laporanBulanTahun->tahun} </caption>
            <thead>
                <tr>
                    <th colspan='2'>A. JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Jumlah laki-laki</td>
                    <td>{$sumberDayaManusia->jumlah_laki_laki} orang</td>
                </tr>
                <tr>
                    <td>Jumlah perempuan</td>
                    <td>{$sumberDayaManusia->jumlah_perempuan} orang</td>
                </tr>
                <tr>
                    <td>Jumlah total</td>
                    <td>{$sumberDayaManusia->jumlah_total} orang</td>
                </tr>
                <tr>
                    <td>Jumlah kepala keluarga</td>
                    <td>{$sumberDayaManusia->jumlah_kepala_keluarga} KK</td>
                </tr>
                <tr>
                    <td>Kepadatan Penduduk</td>
                    <td>{$sumberDayaManusia->kepadatan_penduduk} per KM</td>
                </tr>
            </tbody>
        </table>

        <table class='human-resource-table'>
            <thead>
                <tr>
                    <th colspan='3'>B. USIA</th>
                </tr>
                <tr>
                    <th>Usia</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($usias as $usia) {
        $html .= "<tr><td>{$usia->usia}</td><td>{$usia->total_laki_laki} orang</td><td>{$usia->total_perempuan} orang</td></tr>";
    }
    $html .= "
            </tbody>
        </table>

        <table class='human-resource-table'>
            <thead>
                <tr>
                    <th colspan='3'>C. PENDIDIKAN</th>
                </tr>
                <tr>
                    <th>Tingkatan Pendidikan</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($pendidikans as $pendidikan) {
        $html .= "<tr><td>{$pendidikan->tingkatan_pendidikan}</td><td>{$pendidikan->total_laki_laki} orang</td><td>{$pendidikan->total_perempuan} orang</td></tr>";
    }
    $html .= "
            </tbody>
        </table>

        <table class='human-resource-table'>
            <thead>
                <tr>
                    <th colspan='3'>D. MATA PENCAHARIAN POKOK</th>
                </tr>
                <tr>
                    <th>Jenis Pekerjaan</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($matapencaharianpokoks as $matapencaharianpokok) {
        $html .= "<tr><td>{$matapencaharianpokok->jenis_pekerjaan}</td><td>{$matapencaharianpokok->total_laki_laki} orang</td><td>{$matapencaharianpokok->total_perempuan} orang</td></tr>";
    }
    $html .= "
                <tr>
                    <td>Jumlah Total Penduduk</td>
                    <td>{$total_laki_laki_mp} orang</td>
                    <td>{$total_perempuan_mp} orang</td>
                </tr>
            </tbody>
        </table>

        <table class='human-resource-table'>
            <thead>
                <tr>
                    <th colspan='3'>E. AGAMA/ALIRAN KEPERCAYAAN</th>
                </tr>
                <tr>
                    <th>Agama</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($agamas as $agama) {
        $html .= "<tr><td>{$agama->agama}</td><td>{$agama->total_laki_laki} orang</td><td>{$agama->total_perempuan} orang</td></tr>";
    }
    $html .= "
                <tr>
                    <td>Jumlah</td>
                    <td>{$total_laki_laki_ag} orang</td>
                    <td>{$total_perempuan_ag} orang</td>
                </tr>
            </tbody>
        </table>

        <table class='human-resource-table'>
            <thead>
                <tr>
                    <th colspan='3'>F. KEWARGANEGARAAN</th>
                </tr>
                <tr>
                    <th>Kewarganegaraan</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($kewarganegaraans as $kewarganegaraan) {
        $html .= "<tr><td>{$kewarganegaraan->kewarganegaraan}</td><td>{$kewarganegaraan->total_laki_laki} orang</td><td>{$kewarganegaraan->total_perempuan} orang</td></tr>";
    }
    $html .= "
                <tr>
                    <td>Jumlah</td>
                    <td>{$total_laki_laki_kwg} orang</td>
                    <td>{$total_perempuan_kwg} orang</td>
                </tr>
            </tbody>
        </table>

        <table class='human-resource-table'>
            <thead>
                <tr>
                    <th colspan='3'>G. ETNIS</th>
                </tr>
                <tr>
                    <th>Etnis</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($etniss as $etnis) {
        $html .= "<tr><td>{$etnis->etnis}</td><td>{$etnis->total_laki_laki} orang</td><td>{$etnis->total_perempuan} orang</td></tr>";
    }
    $html .= "
            </tbody>
        </table>

        <table class='human-resource-table'>
            <thead>
                <tr>
                    <th colspan='3'>H. CACAT MENTAL DAN FISIK</th>
                </tr>
                <tr>
                    <th>Jenis Cacat</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($cacats as $cacat) {
        $html .= "<tr><td>{$cacat->jenis_cacat}</td><td>{$cacat->total_laki_laki} orang</td><td>{$cacat->total_perempuan} orang</td></tr>";
    }
    $html .= "
                <tr>
                    <td>Jumlah</td>
                    <td>{$total_laki_laki_cct} orang</td>
                    <td>{$total_perempuan_cct} orang</td>
                </tr>
            </tbody>
        </table>

        <table class='human-resource-table'>
            <thead>
                <tr>
                    <th colspan='3'>I. TENAGA KERJA</th>
                </tr>
                <tr>
                    <th>Tenaga Kerja</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($tenagakerjas as $tenagakerja) {
        $html .= "<tr><td>{$tenagakerja->tenaga_kerja}</td><td>{$tenagakerja->total_laki_laki} orang</td><td>{$tenagakerja->total_perempuan} orang</td></tr>";
    }
    $html .= "
                <tr>
                    <td>Jumlah</td>
                    <td>{$total_laki_laki_tk} orang</td>
                    <td>{$total_perempuan_tk} orang</td>
                </tr>
            </tbody>
        </table>

        <table class='human-resource-table'>
            <thead>
                <tr>
                    <th colspan='3'>J. KUALITAS ANGKATAN KERJA</th>
                </tr>
                <tr>
                    <th>Angkatan Kerja</th>
                    <th>Laki-laki</th>
                    <th>Perempuan</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($kualitasangkatankerjas as $kualitasangkatanKerja) {
        $html .= "<tr><td>{$kualitasangkatanKerja->angkatan_kerja}</td><td>{$kualitasangkatanKerja->total_laki_laki} orang</td><td>{$kualitasangkatanKerja->total_perempuan} orang</td></tr>";
    }
    $html .= "
                <tr>
                    <td>Jumlah</td>
                    <td>{$total_laki_laki_kak} orang</td>
                    <td>{$total_perempuan_kak} orang</td>
                </tr>
            </tbody>
        </table>
    </div>
    </body>
    </html>";

    return response($html);

    }

    



}