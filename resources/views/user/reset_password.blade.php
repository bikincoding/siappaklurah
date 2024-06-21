@extends('layouts.app_user')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Reset Password') }}</div>
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

        <!-- Form untuk mengedit kepala lingkungan -->
        <form action="{{ route('users.changePassword2', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Kolom -->
                <div class="col-md-6">

                    <div class="form-group mb-2">
                        <label for="nama_kepala_lingkungan">Email:</label>
                        {{ $user->email }}
                    </div>
                    <div class="form-group mb-2">
                        <label for="nama_kepala_lingkungan">New Password:</label>
                        <input type="password" class="form-control" id="password{{ $user->id }}" name="password"
                            required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="nama_kepala_lingkungan">Confirm New Password:</label>
                        <input type="password" class="form-control" id="password-confirm{{ $user->id }}"
                            name="password_confirmation" required>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
        </form>
    </div>
</div>


@endsection