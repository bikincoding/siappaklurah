@extends('layouts.app_admin')

@section('content')
<div class="card">
                <div class="card-header warna-pns">{{ __('Detail') }}</div>

                <div class="card-body">
 
            <p>{{ $laporan->bulan }}</p>
            <p>{{ $laporan->tahun }}</p>
            <p>{{ $laporan->status }}</p>
            <!-- Tampilkan detail lainnya dari banjar di sini -->
       
    <!-- Link kembali ke halaman index -->
    <!-- <a href="{{ route('banjars.index') }}" class="btn btn-link">Kembali ke daftar</a> -->
    <a class="btn btn-sm btn-success" href="{{ route('laporan-bulan-tahuns.index') }}">Kembali</a>
</div>
</div>
@endsection
