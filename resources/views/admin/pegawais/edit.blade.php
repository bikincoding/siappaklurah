{{-- Extend dari layout utama --}}
@extends('layouts.app_admin')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Edit Pegawai') }}</div>

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

        {{-- Form untuk edit pegawai --}}
        <form action="{{ route('pegawais.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-2">
                <label for="foto_pegawai">Foto Pegawai:</label>
                <input type="file" class="form-control" id="foto_pegawai" name="foto_pegawai">
                @if($pegawai->foto_pegawai)
                    <img src="{{ asset('storage/foto_pegawai/'.$pegawai->foto_pegawai) }}" alt="foto" width="100" class="img-thumbnail mt-2">
                @endif
            </div>

            <div class="form-group mb-2">
                <label for="nama_pegawai">Nama Pegawai:</label>
                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="nip">NIP:</label>
                <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $pegawai->nip) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="jabatan">Jabatan:</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="pangkat_golongan">Pangkat/Golongan:</label>
                <input type="text" class="form-control" id="pangkat_golongan" name="pangkat_golongan" value="{{ old('pangkat_golongan', $pegawai->pangkat_golongan) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat', $pegawai->alamat) }}</textarea>
            </div>

            <div class="form-group mb-2">
                <label for="tgl_lahir">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', $pegawai->tgl_lahir ? $pegawai->tgl_lahir->toDateString() : null) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="no_ktp">Nomor KTP:</label>
                <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $pegawai->no_ktp) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="npwp">NPWP:</label>
                <input type="text" class="form-control" id="npwp" name="npwp" value="{{ old('npwp', $pegawai->npwp) }}">
            </div>

            <div class="form-group mb-2">
                <label for="no_karpeg">Nomor Karpeg:</label>
                <input type="text" class="form-control" id="no_karpeg" name="no_karpeg" value="{{ old('no_karpeg', $pegawai->no_karpeg) }}">
            </div>

            <div class="form-group mb-2">
                <label for="no_rek">Nomor Rekening:</label>
                <input type="text" class="form-control" id="no_rek" name="no_rek" value="{{ old('no_rek', $pegawai->no_rek) }}">
            </div>

            <div class="form-group mb-2">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $pegawai->email) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="telp">Telepon:</label>
                <input type="text" class="form-control" id="telp" name="telp" value="{{ old('telp', $pegawai->telp) }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="golongan_darah">Golongan Darah:</label>
                <select class="form-control" id="golongan_darah" name="golongan_darah">
                    <option value="">--Pilih Golongan Darah--</option>
                    <option value="A" {{ old('golongan_darah', $pegawai->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('golongan_darah', $pegawai->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                    <option value="AB" {{ old('golongan_darah', $pegawai->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                    <option value="O" {{ old('golongan_darah', $pegawai->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
                </select>
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
