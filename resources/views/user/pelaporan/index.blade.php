@extends('layouts.app_user')

@section('content')
<div class="card">
    @php
    $bulan = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    @endphp
    <div class="card-header warna-pns">Data Potensi Sumber Daya Manusia - Lingkungan
        {{ Auth::user()->kepala_lingkungan->banjar->nama_banjar }}, {{ $bulan[$laporanBulanTahun->bulan] }}
        {{ $laporanBulanTahun->tahun }}</div>

    <div class="card-body">
        <div class="row">


            <!-- <div class="col-md-3 mb-3">
            <a href="#" style="text-decoration: none; color: inherit;">
                <div class="card h-100 hover-effectxxx">
                    <div class="card-body text-center">
                   
                    I. Potensi Sumber Daya Alam
                    </div>
                </div>
            </a>
            </div>
            <div class="col-md-3 mb-3">
            <a href="#" style="text-decoration: none; color: inherit;">
                <div class="card h-100 hover-effectxxx">
                    <div class="card-body text-center">
                   
                    II. Potensi Sumber Daya Manusia
                    </div>
                </div>
            </a>
            </div>
            <div class="col-md-3 mb-3">
            <a href="#" style="text-decoration: none; color: inherit;">
                <div class="card h-100 hover-effectxxx">
                    <div class="card-body text-center">
                   
                    III. Potensi Kelembagaan
                    </div>
                </div>
            </a>
            </div>
            <div class="col-md-3 mb-3">
            <a href="#" style="text-decoration: none; color: inherit;">
                <div class="card h-100 hover-effectxxx">
                    <div class="card-body text-center">
                   
                    IV. Potensi Prasarana dan Sarana
                    </div>
                </div>
            </a>
            </div>
       -->

        </div>
        <!-- <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Import Sumber Daya Manusia (masih dalam perbaikan)</h5>
                        <form>
                            <div class="form-container d-flex align-items-center">
                                <div class="form-group mr-2">
                             
                                    <input type="file" class="form-control" id="fileInput">
                                </div>
                                <div class="form-group ml-2">
                                    <button type="button" class="btn btn-primary btn-sm mr-2">Import</button>
                                    <a href="template.xlsx" class="btn btn-secondary btn-sm">Download Template</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card warna-pns">
                    <div class="card-body">
                        <form action="{{ route('pelaporan.impor_data_laporan') }}" method="POST">
                            @csrf
                            <div class="row align-items-center">
                                <label for="selectLaporanBulanTahun" class="col-sm-3 col-form-label">
                                    Impor Data Laporan
                                </label>
                                <div class="col-sm-6">
                                    <select class="form-select" id="selectLaporanBulanTahun"
                                        name="selectLaporanBulanTahun">
                                        <option value="">Pilih laporan yang ingin diimpor ...</option>
                                        @php
                                        $bulanNama = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember'
                                        ];
                                        @endphp
                                        @foreach($laporans as $laporan)
                                        <option value="{{ $laporan->id }}">
                                            Laporan {{ $bulanNama[$laporan->bulan] }} {{ $laporan->tahun }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="idBanjar"
                                        value="{{ Auth::user()->kepala_lingkungan->banjar->id }}">
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip"
                                        title="Mengkopi data dari bulan yang dipilih ke form dibawah">
                                        Impor Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <div class="row mb-3">
            <div class="col-md-12 mb-12">
                <div class="card warna-pns">
                    <div class="card-body">
                        <select class="form-select" id="selectOption" name="selectOption">
                            <option>Pilih satu opsi...</option>
                            <option value="jumlah">A. JUMLAH</option>
                            <option value="usia">B. USIA</option>
                            <option value="pendidikan">C. PENDIDIKAN</option>
                            <option value="mata-pencaharian-pokok">D. MATA PENCAHARIAN POKOK</option>
                            <option value="agama">E. AGAMA/ALIRAN KEPERCAYAAN</option>
                            <option value="kewarganegaraan">F. KEWARGANEGARAAN</option>
                            <option value="etnis">G. ETNIS</option>
                            <option value="cacat-mental-dan-fisik">H. CACAT MENTAL DAN FISIK</option>
                            <option value="tenaga-kerja">I. TENAGA KERJA</option>
                            <option value="kualitas-angkatan-kerja">J. KUALITAS ANGKATAN KERJA</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 card-section" id="card-jumlah">
            <div class="col-md-12 mb-12">
                <div class="card">
                    <div class="card-body">
                        <form
                            action="{{ route('pelaporan.store_sumber_daya_manusia', ['id' => $laporanBulanTahun->id]) }}"
                            method="POST">
                            @csrf
                            <!-- CSRF Token diperlukan untuk keamanan form -->

                            <table class="table">
                                <tr>
                                    <th colspan="2">A. Jumlah</th>
                                </tr>
                                <tr>
                                    <td>Jumlah laki-laki</td>
                                    <td><input type="text" class="form-control" name="jumlah_laki_laki"
                                            value="{{ $sumberDayaManusia->jumlah_laki_laki }}" required></td>
                                </tr>
                                <tr>
                                    <td>Jumlah perempuan</td>
                                    <td><input type="text" class="form-control" name="jumlah_perempuan"
                                            value="{{ $sumberDayaManusia->jumlah_perempuan }}" required></td>
                                </tr>
                                <tr>
                                    <td>Jumlah total</td>
                                    <td><input type="text" class="form-control" name="jumlah_total"
                                            value="{{ $sumberDayaManusia->jumlah_total }}" required></td>
                                </tr>
                                <tr>
                                    <td>Jumlah kepala keluarga</td>
                                    <td><input type="text" class="form-control" name="jumlah_kepala_keluarga"
                                            value="{{ $sumberDayaManusia->jumlah_kepala_keluarga }}" required></td>
                                </tr>
                                <tr>
                                    <td>Kepadatan penduduk</td>
                                    <td><input type="text" class="form-control" name="kepadatan_penduduk"
                                            value="{{ $sumberDayaManusia->kepadatan_penduduk }}" required></td>
                                </tr>
                            </table>

                            <div class="d-flex justify-content-end">


                                <button type="submit" class="btn btn-success ms-1">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 card-section" id="card-usia">
            <div class="col-md-12 mb-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th colspan="4">B. Usia</th>
                            </tr>
                            <tr>
                                <form action="{{ route('pelaporan.store_usias', ['id' => $laporanBulanTahun->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-container">
                                        <div class="form-group">

                                            <select class="form-control" id="age" name="usia">
                                                <option value="">--Pilih Usia--</option>
                                                <option value="0 - 12 Bulan">0 - 12 Bulan</option>
                                                @for ($i = 1; $i <= 75; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                    <option value=">75">>75</option>
                                            </select>
                                        </div>
                                        <div class="form-group">

                                            <input type="number" class="form-control" id="laki_laki_usia"
                                                name="laki_laki" placeholder="Masukkan jumlah laki-laki di sini"
                                                required>
                                        </div>
                                        <div class="form-group">

                                            <input type="number" class="form-control" id="perempuan_usia"
                                                name="perempuan" placeholder="Masukkan jumlah perempuan di sini"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </tr>
                            <tr>
                                <th>Usia</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($usias as $usia)
                            <tr>
                                <td>{{ $usia->usia }}</td>
                                <td>{{ $usia->laki_laki }} orang</td>
                                <td>{{ $usia->perempuan }} orang</td>
                                <td>
                                    <button type="button" class="btn btn-primary edit-btn" data-usia="{{ $usia->usia }}"
                                        data-laki="{{ $usia->laki_laki }}" data-perempuan="{{ $usia->perempuan }}"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    <form
                                        action="{{ route('pelaporan.destroy_usia', ['id' => $laporanBulanTahun->id, 'usiaId' => $usia->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 card-section" id="card-pendidikan">
            <div class="col-md-12 mb-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th colspan="4">C. Pendidikan</th>
                            </tr>
                            <tr>

                                <form
                                    action="{{ route('pelaporan.store_pendidikan', ['id' => $laporanBulanTahun->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-container">
                                        <div class="form-group">
                                            <select class="form-control" id="tingkatan_pendidikan"
                                                name="tingkatan_pendidikan">
                                                <option value="">--Pilih Tingkatan Pendidikan--</option>
                                                <option value="Usia 3 - 6 tahun yang belum masuk TK">Usia 3 - 6
                                                    tahun yang belum masuk TK</option>
                                                <option value="Usia 3 - 6 tahun yang sedang TK/play group">Usia 3 -
                                                    6 tahun yang sedang TK/play group</option>
                                                <option value="Usia 7 - 18 tahun yang sedang sekolah">Usia 7 - 18
                                                    tahun yang sedang sekolah</option>
                                                <option value="Tamat SD/sederajat">Tamat SD/sederajat</option>
                                                <option value="Tamat SMP/sederajat">Tamat SMP/sederajat</option>
                                                <option value="Tamat SMA/sederajat">Tamat SMA/sederajat</option>
                                                <option value="Tamat D1/sederajat">Tamat D1/sederajat</option>
                                                <option value="Tamat D2/sederajat">Tamat D2/sederajat</option>
                                                <option value="Tamat D3/sederajat">Tamat D3/sederajat</option>
                                                <option value="Tamat S1/sederajat">Tamat S1/sederajat</option>
                                                <option value="Tamat S2/sederajat">Tamat S2/sederajat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="laki_laki_pendidikan"
                                                name="laki_laki" placeholder="Masukkan laki-laki di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="perempuan_pendidikan"
                                                name="perempuan" placeholder="Masukkan perempuan di sini" required>
                                        </div>
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-success"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                </form>


                            </tr>
                            <tr>
                                <th>Tingkatan Pendidikan</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($pendidikans as $pendidikan)
                            <tr>
                                <td>{{ $pendidikan->tingkatan_pendidikan }}</td>
                                <td>{{ $pendidikan->laki_laki }} orang</td>
                                <td>{{ $pendidikan->perempuan }} orang</td>
                                <td>
                                    <button type="button" class="btn btn-primary edit-btn"
                                        data-id="{{ $pendidikan->id }}"
                                        data-tingkatan="{{ $pendidikan->tingkatan_pendidikan }}"
                                        data-laki="{{ $pendidikan->laki_laki }}"
                                        data-perempuan="{{ $pendidikan->perempuan }}"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    <form
                                        action="{{ route('pelaporan.destroy_pendidikan', ['id' => $laporanBulanTahun->id, 'pendidikanId' => $pendidikan->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 card-section" id="card-mata-pencaharian-pokok">
            <div class="col-md-12 mb-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th colspan="4">D. Mata Pencaharian Pokok</th>
                            </tr>
                            <tr>
                                <form
                                    action="{{ route('pelaporan.store_matapencaharianpokok', ['id' => $laporanBulanTahun->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-container">
                                        <div class="form-group">
                                            <select class="form-control" id="jenis_pekerjaan" name="jenis_pekerjaan">
                                                <option value="">--Pilih Jenis Pekerjaan--</option>
                                                <option value="Pegawai Swasta">Pegawai Swasta</option>
                                                <option value="Pegawai Negeri">Pegawai Negeri</option>
                                                <option value="Petani">Petani</option>
                                                <option value="Peternak">Peternak</option>
                                                <option value="TNI">TNI</option>
                                                <option value="Polri">Polri</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Dosen">Dosen</option>
                                                <option value="Seniman/artis">Seniman/artis</option>
                                                <option value="Pengacara">Pengacara</option>
                                                <option value="Purnawirawan/Pensiunan">Purnawirawan/Pensiunan</option>
                                                <option value="Pemilik usaha warung, rumah makan dan restoran">Pemilik
                                                    usaha warung, rumah makan dan restoran</option>
                                                <option value="Dukun/paranormal/supranatural">
                                                    Dukun/paranormal/supranatural</option>
                                                <option value="Sopir">Sopir</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="laki_laki_mp" name="laki_laki"
                                                placeholder="Masukkan laki-laki di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="perempuan_mp" name="perempuan"
                                                placeholder="Masukkan perempuan di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </tr>
                            <tr>
                                <th>Jenis Pekerjaan</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($matapencaharianpokoks as $mp)
                            <tr>
                                <td>{{ $mp->jenis_pekerjaan }}</td>
                                <td>{{ $mp->laki_laki }} orang</td>
                                <td>{{ $mp->perempuan }} orang</td>
                                <td width="120">
                                    <button type="button" class="btn btn-primary edit-btn-mp" data-id="{{ $mp->id }}"
                                        data-jenis="{{ $mp->jenis_pekerjaan }}" data-laki="{{ $mp->laki_laki }}"
                                        data-perempuan="{{ $mp->perempuan }}"><i class="bi bi-pencil-fill"></i></button>
                                    <form
                                        action="{{ route('pelaporan.destroy_matapencaharianpokok', ['id' => $laporanBulanTahun->id, 'mpId' => $mp->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 card-section" id="card-agama">
            <div class="col-md-12 mb-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th colspan="4">E. Agama</th>
                            </tr>
                            <tr>
                                <form action="{{ route('pelaporan.store_agama', ['id' => $laporanBulanTahun->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-container">
                                        <div class="form-group">
                                            <select class="form-control" id="agama" name="agama">
                                                <option value="">--Pilih Agama--</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katholik">Katholik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Khonghucu">Khonghucu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="laki_laki_agama"
                                                name="laki_laki" placeholder="Masukkan laki-laki di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="perempuan_agama"
                                                name="perempuan" placeholder="Masukkan perempuan di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </tr>
                            <tr>
                                <th>Agama</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($agamas as $agama)
                            <tr>
                                <td>{{ $agama->agama }}</td>
                                <td>{{ $agama->laki_laki }} orang</td>
                                <td>{{ $agama->perempuan }} orang</td>
                                <td width="120">
                                    <button type="button" class="btn btn-primary edit-btn-agama"
                                        data-id="{{ $agama->id }}" data-agama="{{ $agama->agama }}"
                                        data-laki="{{ $agama->laki_laki }}" data-perempuan="{{ $agama->perempuan }}"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    <form
                                        action="{{ route('pelaporan.destroy_agama', ['id' => $laporanBulanTahun->id, 'agamaId' => $agama->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 card-section" id="card-kewarganegaraan">
            <div class="col-md-12 mb-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-responsive">
                            <tr>
                                <th colspan="4">F. Kewarganegaraan</th>
                            </tr>
                            <tr>
                                <form
                                    action="{{ route('pelaporan.store_kewarganegaraan', ['id' => $laporanBulanTahun->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-container">
                                        <div class="form-group">
                                            <select class="form-control" id="kewarganegaraan" name="kewarganegaraan">
                                                <option value="">--Pilih Kewarganegaraan--</option>
                                                <option value="WNA">WNA</option>
                                                <option value="WNI">WNI</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="laki_laki_kewarganegaraan"
                                                name="laki_laki" placeholder="Masukkan laki-laki di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="perempuan_kewarganegaraan"
                                                name="perempuan" placeholder="Masukkan perempuan di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </tr>
                            <tr>
                                <th>Kewarganegaraan</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($kewarganegaraans as $kewarganegaraan)
                            <tr>
                                <td>{{ $kewarganegaraan->kewarganegaraan }}</td>
                                <td>{{ $kewarganegaraan->laki_laki }} orang</td>
                                <td>{{ $kewarganegaraan->perempuan }} orang</td>
                                <td width="120">
                                    <button type="button" class="btn btn-primary edit-btn-kewarganegaraan"
                                        data-id="{{ $kewarganegaraan->id }}"
                                        data-kewarganegaraan="{{ $kewarganegaraan->kewarganegaraan }}"
                                        data-laki="{{ $kewarganegaraan->laki_laki }}"
                                        data-perempuan="{{ $kewarganegaraan->perempuan }}"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    <form
                                        action="{{ route('pelaporan.destroy_kewarganegaraan', ['id' => $laporanBulanTahun->id, 'kewarganegaraanId' => $kewarganegaraan->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 card-section" id="card-etnis">
            <div class="col-md-12 mb-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th colspan="4">G. Etnis</th>
                            </tr>
                            <tr>
                                <form action="{{ route('pelaporan.store_etnis', ['id' => $laporanBulanTahun->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-container">
                                        <div class="form-group">
                                            <select class="form-control" id="etnis" name="etnis">
                                                <option value="">--Pilih Etnis--</option>
                                                <option value="Aceh">Aceh</option>
                                                <option value="Bali">Bali</option>
                                                <option value="Banjar">Banjar</option>
                                                <option value="Batak">Batak</option>
                                                <option value="Betawi">Betawi</option>
                                                <option value="Bugis">Bugis</option>
                                                <option value="Cirebon">Cirebon</option>
                                                <option value="Dayak">Dayak</option>
                                                <option value="Jawa">Jawa</option>
                                                <option value="Madura">Madura</option>
                                                <option value="Makassar">Makassar</option>
                                                <option value="Minangkabau">Minangkabau</option>
                                                <option value="Papua">Papua</option>
                                                <option value="Sasak">Sasak</option>
                                                <option value="Sunda">Sunda</option>
                                                <option value="Toraja">Toraja</option>
                                                <option value="Tionghoa">Tionghoa</option>
                                                <option value="Melayu">Melayu</option>
                                                <option value="Minang">Minang</option>
                                                <option value="Mandar">Mandar</option>
                                                <option value="Ambon">Ambon</option>
                                                <option value="Minahasa">Minahasa</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="laki_laki_etnis"
                                                name="laki_laki" placeholder="Masukkan laki-laki di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="perempuan_etnis"
                                                name="perempuan" placeholder="Masukkan perempuan di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </tr>
                            <tr>
                                <th>Etnis</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($etniss as $etnis)
                            <tr>
                                <td>{{ $etnis->etnis }}</td>
                                <td>{{ $etnis->laki_laki }} orang</td>
                                <td>{{ $etnis->perempuan }} orang</td>
                                <td width="120">
                                    <button type="button" class="btn btn-primary edit-btn-etnis"
                                        data-id="{{ $etnis->id }}" data-etnis="{{ $etnis->etnis }}"
                                        data-laki="{{ $etnis->laki_laki }}" data-perempuan="{{ $etnis->perempuan }}"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    <form
                                        action="{{ route('pelaporan.destroy_etnis', ['id' => $laporanBulanTahun->id, 'etnisId' => $etnis->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 card-section" id="card-cacat-mental-dan-fisik">
            <div class="col-md-12 mb-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th colspan="4">H. Cacat Mental dan Fisik</th>
                            </tr>
                            <tr>

                                <form action="{{ route('pelaporan.store_cacat', ['id' => $laporanBulanTahun->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-container">
                                        <div class="form-group">
                                            <select class="form-control" id="jenis_cacat" name="jenis_cacat">
                                                <option value="">--Pilih Jenis Cacat--</option>
                                                <option value="Cacat Fisik">Cacat Fisik</option>
                                                <option value="Cacat Sensorik">Cacat Sensorik</option>
                                                <option value="Cacat Intelektual">Cacat Intelektual</option>
                                                <option value="Cacat Mental">Cacat Mental</option>
                                                <option value="Tuna Rungu">Tuna Rungu</option>
                                                <option value="Tuna Wicara">Tuna Wicara</option>
                                                <option value="Tuna Netra">Tuna Netra</option>
                                                <option value="Tuna Daksa">Tuna Daksa</option>
                                                <option value="Tuna Laras">Tuna Laras</option>
                                                <option value="Tuna Grahita Ringan">Tuna Grahita Ringan</option>
                                                <option value="Tuna Grahita Sedang">Tuna Grahita Sedang</option>
                                                <option value="Down Syndrome">Down Syndrome</option>
                                                <option value="Autisme">Autisme</option>
                                                <option value="Hemofilia">Hemofilia</option>
                                                <option value="Thalassemia">Thalassemia</option>
                                                <option value="Cerebral Palsy">Cerebral Palsy</option>
                                                <option value="Multiple Sclerosis">Multiple Sclerosis</option>
                                                <option value="Muscular Dystrophy">Muscular Dystrophy</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="laki_laki_cacat"
                                                name="laki_laki" placeholder="Masukkan laki-laki di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="perempuan_cacat"
                                                name="perempuan" placeholder="Masukkan perempuan di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </tr>
                            <tr>
                                <th>Jenis Cacat</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($cacats as $cacat)
                            <tr>
                                <td>{{ $cacat->jenis_cacat }}</td>
                                <td>{{ $cacat->laki_laki }} orang</td>
                                <td>{{ $cacat->perempuan }} orang</td>
                                <td width="120">
                                    <button type="button" class="btn btn-primary edit-btn-cacat"
                                        data-id="{{ $cacat->id }}" data-jenis-cacat="{{ $cacat->jenis_cacat }}"
                                        data-laki="{{ $cacat->laki_laki }}" data-perempuan="{{ $cacat->perempuan }}"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    <form
                                        action="{{ route('pelaporan.destroy_cacat', ['id' => $laporanBulanTahun->id, 'cacatId' => $cacat->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 card-section" id="card-tenaga-kerja">
            <div class="col-md-12 mb-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th colspan="4">I. Tenaga Kerja</th>
                            </tr>
                            <tr>

                                <form
                                    action="{{ route('pelaporan.store_tenagakerja', ['id' => $laporanBulanTahun->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-container">
                                        <div class="form-group">
                                            <select class="form-control" id="tenaga_kerja" name="tenaga_kerja">
                                                <option value="">--Pilih Tenaga Kerja--</option>
                                                <option value="Penduduk usia 18 - 56 tahun">Penduduk usia 18 - 56 tahun
                                                </option>
                                                <option value="Penduduk usia 18 - 56 tahun yang bekerja">Penduduk usia
                                                    18 - 56 tahun yang bekerja</option>
                                                <option
                                                    value="Penduduk usia 18 - 56 tahun yang belum atau tidak bekerja">
                                                    Penduduk usia 18 - 56 tahun yang belum atau tidak bekerja</option>
                                                <option value="Penduduk usia 56 tahun ke atas">Penduduk usia 56 tahun ke
                                                    atas</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="laki_laki_tenagakerja"
                                                name="laki_laki" placeholder="Masukkan laki-laki di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="perempuan_tenagakerja"
                                                name="perempuan" placeholder="Masukkan perempuan di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </tr>
                            <tr>
                                <th>Tenaga Kerja</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($tenagakerjas as $tenagakerja)
                            <tr>
                                <td>{{ $tenagakerja->tenaga_kerja }}</td>
                                <td>{{ $tenagakerja->laki_laki }} orang</td>
                                <td>{{ $tenagakerja->perempuan }} orang</td>
                                <td width="120">
                                    <button type="button" class="btn btn-primary edit-btn-tenagakerja"
                                        data-id="{{ $tenagakerja->id }}"
                                        data-tenaga-kerja="{{ $tenagakerja->tenaga_kerja }}"
                                        data-laki="{{ $tenagakerja->laki_laki }}"
                                        data-perempuan="{{ $tenagakerja->perempuan }}"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    <form
                                        action="{{ route('pelaporan.destroy_tenagakerja', ['id' => $laporanBulanTahun->id, 'tenagakerjaId' => $tenagakerja->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 card-section" id="card-kualitas-angkatan-kerja">
            <div class="col-md-12 mb-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th colspan="4">J. Kualitas Angkatan Kerja</th>
                            </tr>
                            <tr>

                                <form
                                    action="{{ route('pelaporan.store_kualitasangkatankerja', ['id' => $laporanBulanTahun->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-container">
                                        <div class="form-group">
                                            <select class="form-control" id="angkatan_kerja" name="angkatan_kerja">
                                                <option value="">--Pilih Angkatan Kerja--</option>
                                                <option
                                                    value="Penduduk usia 18 - 56 tahun yang buta aksara dan huruf/angka latin">
                                                    Penduduk usia 18 - 56 tahun yang buta aksara dan huruf/angka
                                                    latin</option>
                                                <option value="Penduduk usia 18 - 56 tahun yang tamat SD">Penduduk
                                                    usia 18 - 56 tahun yang tamat SD</option>
                                                <option value="Penduduk usia 18 - 56 tahun yang tamat SLTP">Penduduk
                                                    usia 18 - 56 tahun yang tamat SLTP</option>
                                                <option value="Penduduk usia 18 - 56 tahun yang tamat SLTA">Penduduk
                                                    usia 18 - 56 tahun yang tamat SLTA</option>
                                                <option value="Penduduk usia 18 - 56 tahun yang tamat Perguruan Tinggi">
                                                    Penduduk usia 18 - 56 tahun yang tamat Perguruan Tinggi</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control"
                                                id="laki_laki_kualitasangkatankerja" name="laki_laki"
                                                placeholder="Masukkan laki-laki di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control"
                                                id="perempuan_kualitasangkatankerja" name="perempuan"
                                                placeholder="Masukkan perempuan di sini" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success"><i
                                                    class="bi bi-plus-circle-fill"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </tr>
                            <tr>
                                <th>Angkatan Kerja</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Aksi</th>
                            </tr>
                            @foreach($kualitasangkatankerjas as $kualitasangkatankerja)
                            <tr>
                                <td>{{ $kualitasangkatankerja->angkatan_kerja }}</td>
                                <td>{{ $kualitasangkatankerja->laki_laki }} orang</td>
                                <td>{{ $kualitasangkatankerja->perempuan }} orang</td>
                                <td width="120">
                                    <button type="button" class="btn btn-primary edit-btn-kualitasangkatankerja"
                                        data-id="{{ $kualitasangkatankerja->id }}"
                                        data-angkatan-kerja="{{ $kualitasangkatankerja->angkatan_kerja }}"
                                        data-laki="{{ $kualitasangkatankerja->laki_laki }}"
                                        data-perempuan="{{ $kualitasangkatankerja->perempuan }}"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    <form
                                        action="{{ route('pelaporan.destroy_kualitasangkatankerja', ['id' => $laporanBulanTahun->id, 'kualitasangkatankerjaId' => $kualitasangkatankerja->id]) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


@endsection

@section('javascripts')

<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>

@if(session('success'))
<script>
Swal.fire({
    position: 'top-end', // Top-right corner of the screen
    icon: 'success',
    title: '{{ session('
    success ') }}',
    showConfirmButton: false,
    timer: 3000, // Toast akan ditampilkan selama 3 detik
    toast: true // Menggunakan style toast
});
</script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('selectOption');
    var savedValue = localStorage.getItem('selectedOptionValue');

    if (savedValue) {
        selectElement.value = savedValue;
        toggleCards(savedValue);
    }

    selectElement.addEventListener('change', function() {
        localStorage.setItem('selectedOptionValue', this.value);
        toggleCards(this.value);
    });

    function toggleCards(selectedValue) {
        // Sembunyikan semua card-section
        document.querySelectorAll('.card-section').forEach(function(card) {
            card.style.display = 'none';
        });

        // Tampilkan card yang sesuai dengan pilihan
        var selectedCard = document.getElementById('card-' + selectedValue);
        if (selectedCard) {
            selectedCard.style.display = 'block';
        }
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('#card-usia .edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            let usia = this.getAttribute('data-usia');
            let laki = this.getAttribute('data-laki');
            let perempuan = this.getAttribute('data-perempuan');

            document.getElementById('age').value = usia;
            document.getElementById('laki_laki_usia').value = laki;
            document.getElementById('perempuan_usia').value = perempuan;
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            let usia = this.getAttribute('data-usia');
            let laki = this.getAttribute('data-laki');
            let perempuan = this.getAttribute('data-perempuan');

            document.getElementById('age').value = usia;
            document.getElementById('laki_laki').value = laki;
            document.getElementById('perempuan').value = perempuan;

            // Jika Anda ingin mengubah action dari form untuk update
            // Anda bisa menambahkan route untuk update dan mengubah action di sini
            // document.querySelector('form').action = 'route yang sesuai untuk update';
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('#card-pendidikan .edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let tingkatan = this.getAttribute('data-tingkatan');
            let laki = this.getAttribute('data-laki');
            let perempuan = this.getAttribute('data-perempuan');

            document.getElementById('tingkatan_pendidikan').value = tingkatan;
            document.getElementById('laki_laki_pendidikan').value = laki;
            document.getElementById('perempuan_pendidikan').value = perempuan;
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('#card-mata-pencaharian-pokok .edit-btn-mp').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let jenis = this.getAttribute('data-jenis');
            let laki = this.getAttribute('data-laki');
            let perempuan = this.getAttribute('data-perempuan');

            document.getElementById('jenis_pekerjaan').value = jenis;
            document.getElementById('laki_laki_mp').value = laki;
            document.getElementById('perempuan_mp').value = perempuan;
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('#card-agama .edit-btn-agama').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let agama = this.getAttribute('data-agama');
            let laki = this.getAttribute('data-laki');
            let perempuan = this.getAttribute('data-perempuan');

            document.getElementById('agama').value = agama;
            document.getElementById('laki_laki_agama').value = laki;
            document.getElementById('perempuan_agama').value = perempuan;
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('#card-kewarganegaraan .edit-btn-kewarganegaraan').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let kewarganegaraan = this.getAttribute('data-kewarganegaraan');
            let laki = this.getAttribute('data-laki');
            let perempuan = this.getAttribute('data-perempuan');

            document.getElementById('kewarganegaraan').value = kewarganegaraan;
            document.getElementById('laki_laki_kewarganegaraan').value = laki;
            document.getElementById('perempuan_kewarganegaraan').value = perempuan;
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('#card-etnis .edit-btn-etnis').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let etnis = this.getAttribute('data-etnis');
            let laki = this.getAttribute('data-laki');
            let perempuan = this.getAttribute('data-perempuan');

            document.getElementById('etnis').value = etnis;
            document.getElementById('laki_laki_etnis').value = laki;
            document.getElementById('perempuan_etnis').value = perempuan;
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('#card-cacat-mental-dan-fisik .edit-btn-cacat').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let jenis_cacat = this.getAttribute('data-jenis-cacat');
            let laki = this.getAttribute('data-laki');
            let perempuan = this.getAttribute('data-perempuan');

            document.getElementById('jenis_cacat').value = jenis_cacat;
            document.getElementById('laki_laki_cacat').value = laki;
            document.getElementById('perempuan_cacat').value = perempuan;
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('#card-tenaga-kerja .edit-btn-tenagakerja').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let tenaga_kerja = this.getAttribute('data-tenaga-kerja');
            let laki = this.getAttribute('data-laki');
            let perempuan = this.getAttribute('data-perempuan');

            document.getElementById('tenaga_kerja').value = tenaga_kerja;
            document.getElementById('laki_laki_tenagakerja').value = laki;
            document.getElementById('perempuan_tenagakerja').value = perempuan;
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('#card-kualitas-angkatan-kerja .edit-btn-kualitasangkatankerja').forEach(
        button => {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                let angkatan_kerja = this.getAttribute('data-angkatan-kerja');
                let laki = this.getAttribute('data-laki');
                let perempuan = this.getAttribute('data-perempuan');

                document.getElementById('angkatan_kerja').value = angkatan_kerja;
                document.getElementById('laki_laki_kualitasangkatankerja').value = laki;
                document.getElementById('perempuan_kualitasangkatankerja').value = perempuan;
            });
        });
});
</script>



@endsection