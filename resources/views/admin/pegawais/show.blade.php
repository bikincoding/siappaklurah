{{-- Extend dari layout utama --}}
@extends('layouts.app_admin')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Detail Pegawai') }}</div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label"><strong>Foto Pegawai:</strong></label>
                <div>
                    <img src="{{ asset('storage/foto_pegawai/'.$pegawai->foto_pegawai) }}" alt="Foto Pegawai" class="img-fluid img-thumbnail">
                </div>
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label"><strong>Nama Pegawai:</strong></label>
                    <p>{{ $pegawai->nama_pegawai }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>NIP:</strong></label>
                    <p>{{ $pegawai->nip }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Jabatan:</strong></label>
                    <p>{{ $pegawai->jabatan }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Pangkat/Golongan:</strong></label>
                    <p>{{ $pegawai->pangkat_golongan }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Alamat:</strong></label>
                    <p>{{ $pegawai->alamat }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Tanggal Lahir:</strong></label>
                    <p>{{ $pegawai->tgl_lahir->format('d/m/Y') }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Nomor KTP:</strong></label>
                    <p>{{ $pegawai->no_ktp }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>NPWP:</strong></label>
                    <p>{{ $pegawai->npwp }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Nomor Karpeg:</strong></label>
                    <p>{{ $pegawai->no_karpeg }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Nomor Rekening:</strong></label>
                    <p>{{ $pegawai->no_rek }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Email:</strong></label>
                    <p>{{ $pegawai->email }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Telepon:</strong></label>
                    <p>{{ $pegawai->telp }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label"><strong>Golongan Darah:</strong></label>
                    <p>{{ $pegawai->golongan_darah }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
