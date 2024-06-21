<!-- Extend dari layout utama -->
@extends('layouts.app_admin')

@section('content')
<div class="card">
                <div class="card-header warna-pns">{{ __('Form Add') }}</div>

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
    <form action="{{ route('laporan-bulan-tahuns.store') }}" method="POST">
        @csrf
        <div class="form-group mb-2">
            <label for="nama_banjar">Tahun:</label>
            <select class="form-control" id="tahun" name="tahun">
                <!-- Anda dapat menambahkan opsi tahun sesuai kebutuhan -->
                <option value="">--Tahun--</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <!-- dst. -->
            </select>
        </div>
        <div class="form-group mb-2">
            <label for="nama_banjar">Bulan:</label>
            <select class="form-control" id="bulan" name="bulan">
            <option value="">--Bulan--</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
        </div>
        <div class="form-group mb-2">
            <label for="nama_banjar">Status:</label>
            <select class="form-control" id="status" name="status">
                <!-- Anda dapat menambahkan opsi tahun sesuai kebutuhan -->
                <option value="">--Status--</option>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
                <!-- dst. -->
            </select>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
    </form>
</div>
</div>
@endsection
