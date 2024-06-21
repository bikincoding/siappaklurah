<!-- Extend dari layout utama -->
@extends('layouts.app_admin')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Form Edit') }}</div>

    <div class="card-body">
        <h2>Edit User</h2>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="role">Biodata:</label>
                <select name="id_kepala_lingkungans" id="id_kepala_lingkungans" class="form-control" required>
                    <option value="">--Pilih Biodata--</option>
                    @foreach ($biodatas as $biodata)
                    <option value="{{ $biodata->id }}"
                        {{ $user->id_kepala_lingkungans == $biodata->id ? 'selected' : '' }}>
                        {{ $biodata->nama_kepala_lingkungan }}
                        <!-- Assuming 'name' is a field in your Banjar model -->
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection