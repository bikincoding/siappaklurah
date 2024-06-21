<!-- Extend dari layout utama -->
@extends('layouts.app_admin')

@section('content')
<div class="card">
                <div class="card-header">{{ __('Form Add') }}</div>

                <div class="card-body">


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk menambah banjar -->
    <form action="{{ route('data-dasar-keluarga.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="no_kartu_keluarga" class="form-label">No Kartu Keluarga</label>
            <input type="text" class="form-control" id="no_kartu_keluarga" name="no_kartu_keluarga" required>
        </div>
        <div class="mb-3">
            <label for="id_banjars" class="form-label">Banjar</label>
            <select class="form-control" id="id_banjars" name="id_banjars" required>
                <option value="">Pilih Banjar</option>
                @foreach ($banjars as $banjar)
                    <option value="{{ $banjar->id }}">{{ $banjar->nama_banjar }}</option> <!-- Sesuaikan dengan kolom nama banjar -->
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</div>
@endsection
