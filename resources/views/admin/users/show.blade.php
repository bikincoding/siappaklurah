@extends('layouts.app_admin')

@section('content')
<div class="card">
                <div class="card-header warna-pns">{{ __('Detail') }}</div>

                <div class="card-body">
 
                <h2>User Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>
        </div>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-link">Back to list</a>
</div>
</div>
@endsection
