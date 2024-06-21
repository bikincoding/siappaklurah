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
    <form action="{{ route('banjars.store') }}" method="POST">
        @csrf
        <div class="form-group mb-2">
            <label for="nama_banjar">Nama Banjar:</label>
            <input type="text" class="form-control" id="nama_banjar" name="nama_banjar">
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
    </form>
</div>
</div>
@endsection
