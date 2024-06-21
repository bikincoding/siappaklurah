@extends('layouts.app_admin')

@section('content')
<div class="card">
                <div class="card-header warna-pns">{{ __('Dashboard') }}</div>

                <div class="card-body">
                <div class="text-center mb-3 border">
                    <h5 class="pt-2">Gambaran Umum Kelurahan</h5> 
                    </div>
                    <div class="text-justify mt-3 mb-3 border p-3">
               
                    <p>Kelurahan Kerobokan Kaja merupakan salah satu kelurahan dari 16 Kelurahan di Kabupaten Badung yang ada diwilayah Kecamatan Kuta Utara, Kabupaten Badung, Provinsi Bali. Kelurahan Kerobokan Kaja terletak di sebelah timur Kecamatan Kuta Utara dan berbatasan langsung dengan Kota Denpasar, sekaligus menjadi pintu gerbang untuk memasuki Kabupaten Badung Mangupura dari Ibukota Provinsi Bali serta menjadi daerah penopang ibu kota kabupaten Badung yaitu Mangupura. Sebagian besar wilayah Kelurahan Kerobokan Kaja adalah daerah perumahan penduduk yang meliputi 23 lingkungan yaitu: lingkungan Batuculung, lingkungan Babakan, lingkungan Beluraan, lingkungan Gadon, lingkungan Jambe, lingkungan Batubidak, lingkungan Petingan, lingkungan Muding Mekar, lingkungan Muding Kaja, lingkungan Muding Tengah, lingkungan Muding Kelod, lingkungan Padang Lestari, lingkungan Surya Bhuana, lingkungan Tegal Sari, lingkungan Tegal Permai, lingkungan Wira Bhuana, lingkungan Blubuh Sari, lingkungan Buana Asri, lingkungan Buana Graha, lingkungan Buana Shanti, lingkungan Bumi Kertha, lingkungan Bumi Mekar Sari, serta lingkungan Bhineka Asri.</p>
                    </div>

                    <div class="text-center mt-3 mb-3 border">
                    <h5 class="pt-2">Pegawai Negeri Sipil / ASN. Kelurahan Kerobokan Kaja Kec. Kuta Utara, Kab. Badung</h5> 
                    </div>
                    
                    <div class="container mt-4">
    <div class="row">
        @foreach ($pegawais as $pegawai) <!-- Iterasi atas setiap pegawai -->
            <!-- Mulai pegawai -->
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <img src="{{ asset('storage/foto_pegawai/'.$pegawai->foto_pegawai) }}" class="card-img-top" alt="{{ $pegawai->nama_pegawai }}" style="height: 350px; object-fit: cover;">
                   
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $pegawai->nama_pegawai }}</h5>
                        <p class="card-text">
                            <table class="table table-borderless table-sm">
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
                </div><div class="row"> <!-- Setiap 3 card, mulai row baru -->
            @endif
        @endforeach
    </div>
</div>

                </div>
            </div>
@endsection
