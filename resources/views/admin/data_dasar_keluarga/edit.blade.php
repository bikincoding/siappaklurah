<!-- Extend dari layout utama -->
@extends('layouts.app_admin')

@section('content')
<div class="card">
        <div class="card-header">
            Edit Data Keluarga
        </div>
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
            <form method="POST" action="{{ route('data-dasar-keluarga.update', $keluarga->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="no_kartu_keluarga">No Kartu Keluarga:</label>
                    <input type="text" class="form-control" id="no_kartu_keluarga" name="no_kartu_keluarga" value="{{ $keluarga->no_kartu_keluarga }}" required>
                </div>

                <div class="form-group">
                    <label for="id_banjars">Banjar:</label>
                    <select class="form-control" id="id_banjars" name="id_banjars">
                        @foreach ($banjars as $banjar)
                            <option value="{{ $banjar->id }}" {{ $keluarga->id_banjars == $banjar->id ? 'selected' : '' }}>{{ $banjar->nama_banjar }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $keluarga->alamat }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
