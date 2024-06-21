@extends('layouts.app_admin')

@section('content')
<div class="card">
                <div class="card-header">{{ __('Detail') }}</div>

                <div class="card-body">
 
            <p>{{ $banjar->nama_banjar }}</p>
            <!-- Tampilkan detail lainnya dari banjar di sini -->
       
    <!-- Link kembali ke halaman index -->
    <!-- <a href="{{ route('banjars.index') }}" class="btn btn-link">Kembali ke daftar</a> -->
    <a class="btn btn-sm btn-success" href="{{ route('banjars.index') }}">Kembali</a>
</div>
</div>
@endsection
