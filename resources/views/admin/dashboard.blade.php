@extends('layouts.app_admin')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Dashboard') }}</div>

    <div class="card-body">
        <div class="card mb-3">
            <!-- Header Card dengan tombol untuk menampilkan/menyembunyikan konten -->
            <div class="card-header warna-pns d-flex justify-content-between align-items-center">
                Gambaran Umum Kelurahan
                <!-- Tombol untuk menampilkan/menyembunyikan detail -->
                <!-- <a class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" -->
                <!-- data-bs-target="#collapseKelurahan" aria-expanded="false" aria-controls="collapseKelurahan"> -->
                <i class="bi bi-dash-lg" id="toggleIcon" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseKelurahan" aria-expanded="true" aria-controls="collapseKelurahan"></i>
                <!-- Icon awalnya minimize -->
                <!-- </a> -->
            </div>

            <!-- Konten yang dapat dilipat (collapsible content) -->
            <div id="collapseKelurahan" class="collapse">
                <div class="card-body text-justify">
                    <p class="text-justify">Kelurahan Kerobokan Kaja merupakan salah satu kelurahan dari 16 Kelurahan di
                        Kabupaten Badung
                        yang ada
                        di wilayah Kecamatan Kuta Utara, Kabupaten Badung, Provinsi Bali. Kelurahan Kerobokan Kaja
                        terletak di
                        sebelah timur Kecamatan Kuta Utara dan berbatasan langsung dengan Kota Denpasar, sekaligus
                        menjadi pintu
                        gerbang untuk memasuki Kabupaten Badung Mangupura dari Ibukota Provinsi Bali serta menjadi
                        daerah
                        penopang ibu kota kabupaten Badung yaitu Mangupura. Sebagian besar wilayah Kelurahan Kerobokan
                        Kaja
                        adalah daerah perumahan penduduk yang meliputi 23 lingkungan yaitu: lingkungan Batuculung,
                        lingkungan
                        Babakan, lingkungan Beluraan, lingkungan Gadon, lingkungan Jambe, lingkungan Batubidak,
                        lingkungan
                        Petingan, lingkungan Muding Mekar, lingkungan Muding Kaja, lingkungan Muding Tengah, lingkungan
                        Muding
                        Kelod, lingkungan Padang Lestari, lingkungan Surya Bhuana, lingkungan Tegal Sari, lingkungan
                        Tegal
                        Permai, lingkungan Wira Bhuana, lingkungan Blubuh Sari, lingkungan Buana Asri, lingkungan Buana
                        Graha,
                        lingkungan Buana Shanti, lingkungan Bumi Kertha, lingkungan Bumi Mekar Sari, serta lingkungan
                        Bhineka
                        Asri.
                    </p>
                </div>
            </div>
        </div>


        <!-- Konten lainnya tetap sama -->
        <div class="text-center mt-3 mb-3 border">
            <h5 class="pt-2">Pegawai Negeri Sipil / ASN. Kelurahan Kerobokan Kaja Kec. Kuta Utara, Kab. Badung</h5>
        </div>

        <div class="container mt-4">
            <div class="row d-flex justify-content-center">


                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('storage/foto_pegawai/'.$pak_lurah->foto_pegawai) }}" class="card-img-top"
                            alt="{{ $pak_lurah->nama_pegawai }}" style="height: 350px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $pak_lurah->nama_pegawai }}</h5>
                            <p class="card-text">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <th class="text-center">NIP</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $pak_lurah->nip }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Pangkat/Gol</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $pak_lurah->pangkat_golongan }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">No Telp</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $pak_lurah->telp }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                @foreach ($pegawais as $pegawai)
                <!-- Iterasi atas setiap pegawai -->
                <!-- Mulai pegawai -->
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('storage/foto_pegawai/'.$pegawai->foto_pegawai) }}" class="card-img-top"
                            alt="{{ $pegawai->nama_pegawai }}" style="height: 350px; object-fit: cover;">

                        <div class="card-body ">
                            <h5 class="card-title text-center">{{ $pegawai->nama_pegawai }}</h5>
                            <p class="card-text text-center">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <th class="text-center">NIP</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $pegawai->nip }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Pangkat/Gol</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $pegawai->pangkat_golongan }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">No Telp</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ $pegawai->telp }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Akhir pegawai -->

                @if ($loop->iteration % 4 == 0)
            </div>
            <div class="row">
                <!-- Setiap 4 card, mulai row baru -->
                @endif
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection

@section('javascript')

<!-- JavaScript untuk mengubah ikon saat collapse -->
<script>
const collapseElement = document.getElementById('collapseKelurahan');
const toggleButton = document.querySelector('[data-bs-toggle="collapse"]');
const toggleIcon = document.getElementById('toggleIcon');

collapseElement.addEventListener('show.bs.collapse', function() {
    toggleIcon.classList.remove('bi-plus-lg'); // Ganti dengan ikon maximize
    toggleIcon.classList.add('bi-dash-lg'); // Ganti dengan ikon minimize
});

collapseElement.addEventListener('hide.bs.collapse', function() {
    toggleIcon.classList.remove('bi-dash-lg'); // Ganti dengan ikon minimize
    toggleIcon.classList.add('bi-plus-lg'); // Ganti dengan ikon maximize
});
</script>
@endsection