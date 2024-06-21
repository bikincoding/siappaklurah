@extends('layouts.app_admin')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Data Keluarga') }}</div>

        <div class="card-body">

        <!-- <p>No Kartu Keluarga: {{ $keluarga->no_kartu_keluarga }}</p>
        <p>Lingkungan: {{ optional($keluarga->banjar)->nama_banjar }}</p> 
        <p>Alamat: {{ $keluarga->alamat }}</p> -->
        <table>
            <tr>
                <td width="150px">No Kartu Keluarga</td>
                <td> : {{ $keluarga->no_kartu_keluarga }}</td>
            </tr>
            <tr>
                <td>Lingkungan</td>
                <td> : {{ optional($keluarga->banjar)->nama_banjar }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td> : {{ $keluarga->alamat }}</td>
            </tr>
        </table>
        <hr>
        <div class="card mb-3">
            <div class="card-body">
                <button type="submit" class="btn btn-success" >Tambah Anggota</button>
            </div>
        </div>
        <div class="card">
        <div class="card-body">
        <div class="table-responsive">
        <table class="table table-sm mt-3 mb-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Hubungan</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Status Perkawinan</th>
                    <th>Agama</th>
                    <th>Golongan Darah</th>
                    <th>Kewarganegaraan</th>
                    <th>Etnis/Suku</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>
            </table>
        </div>
        </div>
        </div>
        
        
        <form action="{{ route('data-dasar-keluarga.simpan_anggota', $keluarga->id) }}" method="POST">
        @csrf
        {{-- Asumsikan Anda ingin menambahkan nama dan hubungan dengan kepala keluarga --}}
        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="row align-items-center">
                    <label for="nama" class="col-sm-4 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
            <div class="row align-items-center">
                <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-8">
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                </div>
            </div>    
            </div>
            <div class="col-md-6 mb-2">
            <div class="row align-items-center">
                <label for="hubungan" class="col-sm-4 col-form-label">Hubungan</label>
                <div class="col-sm-8">
                <select class="form-control" id="hubungan" name="hubungan" required>
                    <option value="">Pilih Hubungan</option>
                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                    <option value="Istri">Istri</option>
                    <option value="Anak">Anak</option>
                </select>
                </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
            <div class="row align-items-center">
                <label for="tempat_lahir" class="col-sm-4 col-form-label">Tempat Lahir</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
            <div class="row align-items-center">
                <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-8">
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                </div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
            <div class="row align-items-center">
                <label for="status_perkawinan" class="col-sm-4 col-form-label">Status Perkawinan</label>
                <div class="col-sm-8">
                <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                    <option value="">Pilih Status Perkawinan</option>
                    <option value="Kawin">Kawin</option>
                    <option value="Tidak Kawin">Tidak Kawin</option>
                </select>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-6 mb-2">
                    <div class="row align-items-center">
                        <label for="agama" class="col-sm-4 col-form-label">Agama</label>
                        <div class="col-sm-8">
                        <select class="form-control" id="agama" name="agama" required>
                            <option value="">Pilih Agama</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Islam">Islam</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                            <option value="Katholik">Katholik</option>
                            <option value="Protestan">Protestan</option>
                        </select>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                    <div class="row align-items-center">
                        <label for="golongan_darah" class="col-sm-4 col-form-label">Golongan Darah</label>
                        <div class="col-sm-8">
                        <select class="form-control" id="golongan_darah" name="golongan_darah" required>
                            <option value="">Pilih Golongan Darah</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option> <!-- Ganti 0 dengan O untuk golongan darah -->
                        </select>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                    <div class="row align-items-center">
                        <label for="kewarganegaraan" class="col-sm-4 col-form-label">Kewarganegaraan</label>
                        <div class="col-sm-8">
                        <select class="form-control" id="kewarganegaraan" name="kewarganegaraan" required>
                            <option value="">Pilih Kewarganegaraan</option>
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                    <div class="row align-items-center">
                        <label for="etnis_suku" class="col-sm-4 col-form-label">Etnis/Suku</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="etnis_suku" name="etnis_suku" required>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                    <div class="row align-items-center">
                    <label for="status" class="col-sm-4 col-form-label">Status</label>
                    <div class="col-sm-8">
                    <select class="form-control" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="lahir">Lahir</option>
                        <option value="datang">Datang</option>
                        <option value="meninggal">Meninggal</option>
                        <option value="pindah">Pindah</option>
                    </select>
                    </div>
                        </div>
                </div>
                <div class="col-12">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
            </div>
    </div>
@endsection
