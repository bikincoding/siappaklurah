@extends('layouts.app_admin')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Tambah Pegawai Baru') }}</div>
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

        <!-- Form untuk menambah pegawai -->
        <form action="{{ route('pegawais.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Kolom pertama -->
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="foto_pegawai">Foto Pegawai:</label>
                        <input type="file" class="form-control" id="foto_pegawai" name="foto_pegawai" >
                    </div>
                    <div class="form-group mb-2">
                        <label for="nama_pegawai">Nama Pegawai:</label>
                        <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value="{{ old('nama_pegawai') }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="nip">NIP:</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="jabatan">Jabatan:</label>
                        <select class="form-control" id="jabatan" name="jabatan" required>
                            <option value="">--Pilih Jabatan--</option>
                            <option value="Lurah" {{ old('jabatan') == 'Lurah' ? 'selected' : '' }}>Lurah</option>
                            <option value="Sekretaris Lurah" {{ old('jabatan') == 'Sekretaris Lurah' ? 'selected' : '' }}>Sekretaris Lurah</option>
                            <option value="Kasi Pemerintahan" {{ old('jabatan') == 'Kasi Pemerintahan' ? 'selected' : '' }}>Kasi Pemerintahan</option>
                            <option value="Kasi Pembangunan" {{ old('jabatan') == 'Kasi Pembangunan' ? 'selected' : '' }}>Kasi Pembangunan</option>
                            <option value="Kasi Sosial" {{ old('jabatan') == 'Kasi Sosial' ? 'selected' : '' }}>Kasi Sosial</option>
                            <option value="Pengadministrasi Umum" {{ old('jabatan') == 'Pengadministrasi Umum' ? 'selected' : '' }}>Pengadministrasi Umum</option>
                            <option value="Pengolah Data" {{ old('jabatan') == 'Pengolah Data' ? 'selected' : '' }}>Pengolah Data</option>
                            <option value="Analis Tata Usaha" {{ old('jabatan') == 'Analis Tata Usaha' ? 'selected' : '' }}>Analis Tata Usaha</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="pangkat_golongan">Pangkat/Golongan:</label>
                        <input type="text" class="form-control" id="pangkat_golongan" name="pangkat_golongan" value="{{ old('pangkat_golongan') }}"required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat"  required>{{ old('alamat') }}</textarea>
                    </div>
                </div>
                <!-- Kolom kedua -->
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="tgl_lahir">Tanggal Lahir:</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="no_ktp">Nomor KTP:</label>
                        <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="npwp">NPWP:</label>
                        <input type="text" class="form-control" id="npwp" name="npwp" value="{{ old('npwp') }}" >
                    </div>
                    <div class="form-group mb-2">
                        <label for="no_karpeg">Nomor Karpeg:</label>
                        <input type="text" class="form-control" id="no_karpeg" name="no_karpeg" value="{{ old('no_karpeg') }}" >
                    </div>
                    <div class="form-group mb-2">
                        <label for="no_rek">Nomor Rekening:</label>
                        <input type="text" class="form-control" id="no_rek" name="no_rek" value="{{ old('no_rek') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="telp">Telepon:</label>
                        <input type="text" class="form-control" id="telp" name="telp" value="{{ old('telp') }}" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="golongan_darah">Golongan Darah:</label>
                        <select class="form-control" id="golongan_darah" name="golongan_darah">
                            <option value="">--Pilih Golongan Darah--</option>
                            <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="O" {{ old('golongan_darah') == 'o' ? 'selected' : '' }}>O</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
        </form>
    </div>
</div>
@endsection