{{-- Extend dari layout utama --}}
@extends('layouts.app_admin')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Detail Kepala Lingkungan') }}</div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label"><strong>Foto Kepala Lingkungan:</strong></label>
                <div>
                    <img src="{{ asset('storage/foto_kepala_lingkungan/'.$kepalaLingkungan->foto) }}" alt="Foto Kepala Lingkungan" class="img-fluid img-thumbnail">
                </div>
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label"><strong>Nama Kepala Lingkungan:</strong></label>
                    <p>{{ $kepalaLingkungan->nama_kepala_lingkungan }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Alamat:</strong></label>
                    <p>{{ $kepalaLingkungan->alamat }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Lingkungan:</strong></label>
                    <p>{{ $kepalaLingkungan->banjar->nama_banjar }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Telepon:</strong></label>
                    <p>{{ $kepalaLingkungan->telepon }}</p>
                </div>
                <!-- Add other fields as necessary -->
            </div>
        </div>
    </div>
</div>
@endsection
