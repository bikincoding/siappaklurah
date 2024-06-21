@extends('layouts.app_admin')

@section('content')
<div class="card">
    <div class="card-header warna-pns">{{ __('Data Users') }}</div>

    <div class="card-body">
        <div class="card mb-3">
            <div class="card-body">
                <a class="btn btn-sm btn-success" href="{{ route('users.create') }}">Add New User</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                <table class=" table table-untuk-data mb-3 mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->kepala_lingkungan->nama_kepala_lingkungan }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                                <a class="btn btn-sm btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                <!-- Tombol yang memicu modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $user->id }}">
                                    Delete
                                </button>
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#changePasswordModal{{ $user->id }}">
                                    Password
                                </button>

                                <!-- Modal Konfirmasi Delete -->
                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Confirm
                                                    Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this user?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Change Password -->
                                <div class="modal fade" id="changePasswordModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="changePasswordModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changePasswordModalLabel{{ $user->id }}">
                                                    Change Password</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('users.changePassword', $user->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="password{{ $user->id }}" class="col-form-label">New
                                                            Password:</label>
                                                        <input type="password" class="form-control"
                                                            id="password{{ $user->id }}" name="password" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password-confirm{{ $user->id }}"
                                                            class="col-form-label">Confirm New Password:</label>
                                                        <input type="password" class="form-control"
                                                            id="password-confirm{{ $user->id }}"
                                                            name="password_confirmation" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Change
                                                        Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection