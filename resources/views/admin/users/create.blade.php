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
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password">Password Confirmation:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>
            <div class="form-group">
                <label for="role">Biodata:</label>
                <select name="id_kepala_lingkungans" id="id_kepala_lingkungans" class="form-control" required>
                    <option value="">--Pilih Biodata--</option>
                    @foreach ($biodatas as $biodata)
                    <option value="{{ $biodata->id }}"
                        {{ old('id_kepala_lingkungans') == $biodata->id ? 'selected' : '' }}>
                        {{ $biodata->nama_kepala_lingkungan }}
                        <!-- Assuming 'name' is a field in your Banjar model -->
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="">--Pilih Role--</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary mt-3">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection