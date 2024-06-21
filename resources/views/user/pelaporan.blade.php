@extends('layouts.app_user')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Pelaporan') }}</div>

    <div class="card-body">
        <div class="border p-3 mb-3">
            Form pelaporan data lingkungan ke kelurahan
        </div>
        <div class="border p-3">
        <div class="row ">
        @foreach ($laporans as $laporan)
     
            <div class="col-md-4 mb-3">
                
            
            <div class="card h-100">
    <div class="card-body text-center">
        <div class="d-flex justify-content-around">
            <a href="{{ route('pelaporan.data_pokok', $laporan->id) }}" class="btn btn-primary w-100 me-1">
                @php
                    $bulan = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                @endphp
                {{ $bulan[$laporan->bulan] }} {{ $laporan->tahun }}
            </a>
            <a href="{{ route('cetak_laporan_lingkungan', $laporan->id) }}" target="_blank" class="btn btn-success">
                <i class="bi bi-printer"></i>
            </a>
        </div>
    </div>
</div>

            

        
            </div>
      
        @endforeach
        </div>
        </div>
        
    </div>
</div>
@endsection
