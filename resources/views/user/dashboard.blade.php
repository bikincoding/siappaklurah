@extends('layouts.app_user')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Dashboard') }}</div>

    <div class="card-body">
        <div class="border p-3">
            Selamat datang <b>Kepala Lingkungan {{ Auth::user()->kepala_lingkungan->banjar->nama_banjar }} -
                {{ Auth::user()->kepala_lingkungan->nama_kepala_lingkungan }} </b> di Aplikasi SiapPakLurah
        </div>


        <!-- <div class="container mt-4">
                    <div class="row">
                        @foreach ($kepalaLingkungans as $kepalaLingkungan)
                        
                            <div class="col-md-3 mb-3">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/foto_kepala_lingkungan/'.$kepalaLingkungan->foto) }}" class="card-img-top" alt="{{ $kepalaLingkungan->nama_kepala_lingkungan }}">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-center">{{ $kepalaLingkungan->nama_kepala_lingkungan }}</h5>
                                        <p class="card-text">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <th>Alamat</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $kepalaLingkungan->alamat }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Lingkungan</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $kepalaLingkungan->banjar->nama_banjar }}</td> 
                                                    </tr>
                                                    <tr>
                                                        <th>Telp</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $kepalaLingkungan->telepon }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </p>
                                    </div>
                                </div>
                            </div>
                         
                        @endforeach
                    </div>
                </div> -->


    </div>
</div>
</div>
@endsection