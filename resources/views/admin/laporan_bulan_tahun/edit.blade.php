<!-- Extend dari layout utama -->
@extends('layouts.app_admin')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Form Edit') }}</div>

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

        <!-- Form untuk mengedit data -->
        <form action="{{ route('laporan-bulan-tahuns.update', $laporan->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Method Spoofing untuk mengirim sebagai PUT karena HTML forms tidak mendukung PUT/PATCH -->

            <div class="form-group mb-2">
                <label for="tahun">Tahun:</label>
                <select class="form-control" id="tahun" name="tahun">
                    <!-- Anda dapat menambahkan opsi tahun sesuai kebutuhan -->
                    <option value="">--Tahun--</option>
                    <!-- Loop melalui opsi tahun, pilih tahun sesuai dengan data -->
                  
                        <option value="2023" {{ $laporan->tahun == '2023' ? 'selected' : '' }}>2023</option>
                        <option value="2024" {{ $laporan->tahun == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2025" {{ $laporan->tahun == '2025' ? 'selected' : '' }}>2025</option>
                 
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="bulan">Bulan:</label>
                <select class="form-control" id="bulan" name="bulan">
                    <!-- Loop melalui bulan, pilih bulan sesuai dengan data -->
               
                    <option value="1" {{ $laporan->bulan == '1' ? 'selected' : '' }}>Januari</option>
                    <option value="2" {{ $laporan->bulan == '2' ? 'selected' : '' }}>Februari</option>
                    <option value="3" {{ $laporan->bulan == '3' ? 'selected' : '' }}>Maret</option>
                    <option value="4" {{ $laporan->bulan == '4' ? 'selected' : '' }}>April</option>
                    <option value="5" {{ $laporan->bulan == '5' ? 'selected' : '' }}>Mei</option>
                    <option value="6" {{ $laporan->bulan == '6' ? 'selected' : '' }}>Juni</option>
                    <option value="7" {{ $laporan->bulan == '7' ? 'selected' : '' }}>Juli</option>
                    <option value="8" {{ $laporan->bulan == '8' ? 'selected' : '' }}>Agustus</option>
                    <option value="9" {{ $laporan->bulan == '9' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ $laporan->bulan == '10' ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ $laporan->bulan == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ $laporan->bulan == '12' ? 'selected' : '' }}>Desember</option>

              
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                    <option value="1" {{ $laporan->status == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $laporan->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
