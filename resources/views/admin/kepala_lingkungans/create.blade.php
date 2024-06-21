@extends('layouts.app_admin')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Add Kepala Lingkungan') }}</div>
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

        <!-- Form untuk menambah kepala lingkungan -->
        <form action="{{ route('kepala_lingkungans.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Kolom -->
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="foto">Foto Kepala Lingkungan:</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <div class="form-group mb-2">
                        <label for="nama_kepala_lingkungan">Nama Kepala Lingkungan:</label>
                        <input type="text" class="form-control" id="nama_kepala_lingkungan"
                            name="nama_kepala_lingkungan" value="{{ old('nama_kepala_lingkungan') }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="id_banjars">Lingkungan:</label>
                        <select class="form-control" id="id_banjars" name="id_banjars" required>
                            <option value="">--Pilih Banjar--</option>
                            @foreach ($banjars as $banjar)
                            <option value="{{ $banjar->id }}" {{ old('id_banjars') == $banjar->id ? 'selected' : '' }}>
                                {{ $banjar->nama_banjar }}
                                <!-- Assuming 'name' is a field in your Banjar model -->
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="telepon">Telepon:</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon') }}"
                            required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
        </form>
    </div>
</div>
@endsection