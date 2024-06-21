@extends('layouts.app_admin')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Edit Kepala Lingkungan') }}</div>
    <div class="card-body">
        <!-- Menampilkan pesan error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form untuk mengedit kepala lingkungan -->
        <form action="{{ route('kepala_lingkungans.update', $kepala_lingkungan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Kolom -->
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="foto">Foto Kepala Lingkungan (current):</label><br>
                        <img src="{{ asset('storage/foto_kepala_lingkungan/'.$kepala_lingkungan->foto) }}" alt="current-photo" width="100"><br>
                        <label for="foto" class="mt-2">Update Foto:</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <div class="form-group mb-2">
                        <label for="nama_kepala_lingkungan">Nama Kepala Lingkungan:</label>
                        <input type="text" class="form-control" id="nama_kepala_lingkungan" name="nama_kepala_lingkungan" value="{{ old('nama_kepala_lingkungan', $kepala_lingkungan->nama_kepala_lingkungan) }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat', $kepala_lingkungan->alamat) }}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="id_banjars">ID Banjars:</label>
                        <select class="form-control" id="id_banjars" name="id_banjars" required>
                            <option value="">--Pilih Banjar--</option>
                            @foreach ($banjars as $banjar)
                                <option value="{{ $banjar->id }}" {{ (old('id_banjars', $kepala_lingkungan->id_banjars) == $banjar->id) ? 'selected' : '' }}>
                                    {{ $banjar->nama_banjar }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="telepon">Telepon:</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $kepala_lingkungan->telepon) }}" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
