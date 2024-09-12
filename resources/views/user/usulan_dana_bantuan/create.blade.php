@extends('layouts.app_user')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Add Usulan Dana Bantuan') }}</div>
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

        <!-- Form untuk menambah Usulan Dana Bantuan -->
        <form action="{{ route('usulan_dana_bantuan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Kolom -->
                <div class="col-md-6">

                    <div class="form-group mb-2">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="foto">Foto KTP:</label>
                        <input type="file" class="form-control" id="usulan_ktp" name="usulan_ktp">
                    </div>
                    <div class="form-group mb-2">
                        <label for="surat_pernyataan_kaling">Surat Pernyataan kaling (SPK):</label>
                        <input type="file" class="form-control" id="surat_pernyataan_kaling"
                            name="surat_pernyataan_kaling">
                    </div>
                    <div class="form-group mb-2">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="id_bantuans">Dana Bantuan:</label>
                        <select class="form-control" id="id_bantuans" name="id_bantuans">
                            <option value="">--Pilih Dana Bantuan--</option>
                            @foreach ($bantuans as $bantuan)
                            <option value="{{ $bantuan->id }}"
                                {{ old('id_bantuans') == $bantuan->id ? 'selected' : '' }}>
                                {{ $bantuan->nama_bantuan }}
                                <!-- Assuming 'name' is a field in your Banjar model -->
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <!-- <label for="status">Status:</label> -->
                        <input type="hidden" class="form-control" id="status" name="status" value="2">
                    </div>

                    <div class="form-group mb-2">
                        <!-- <label for="id_banjars">id_banjars:</label> -->
                        <input type="hidden" class="form-control" id="id_banjars" name="id_banjars"
                            value="{{ Auth::user()->kepala_lingkungan->banjar->id }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="keterangan">Keterangan:</label>
                        <textarea class="form-control html-editor" id="keterangan"
                            name="keterangan">{{ old('keterangan') }}</textarea>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Ajukan</button>
        </form>
    </div>
</div>

@endsection