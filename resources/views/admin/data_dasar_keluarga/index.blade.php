@extends('layouts.app_admin')

@section('content')

    <div class="card">
        <!-- <div class="card-header">{{ __('Data Keluarga') }}</div> -->
        <div class="card-header">{{ __('Sumber  Daya Manusia') }}</div>

        <div class="card-body">
            <div class="card mb-3">
                <div class="card-body">
                <!-- <a href="{{ route('data-dasar-keluarga.create') }}" class="btn btn-sm btn-success">Add New Keluarga</a> -->
                <a href="{{ route('data-dasar-keluarga.create') }}" class="btn btn-sm btn-success">Add New Sumber Daya Manusia</a>
                </div>
            </div>
        
        <div class="card">
        <div class="card-body">
    <table class="table table-sm mt-3 mb-3">
        <thead>
            <tr>
                <th>ID</th>
                <!-- <th>No KK</th>
                <th>Kepala Keluarga</th>
                <th>Lingkungan</th>
                <th>Alamat</th> -->
                <th>Usia</th>
                <th>Laki-laki</th>
                <th>Perempuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($keluargas as $keluarga)
            <tr>
                <td>{{ $keluarga->id }}</td>
                <td>{{ $keluarga->no_kartu_keluarga }}</td>
                <td>Data kepala keluarga belum diisi</td>
                <td>{{ $keluarga->banjar->nama_banjar }}</td>
                <td>{{ $keluarga->alamat }}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $keluarga->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $keluarga->id }}">
                       

                            <li><a class="dropdown-item" href="{{ route('data-dasar-keluarga.tambah_anggota', $keluarga->id) }}"><i class="bi bi-plus me-1"></i> Anggota</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-dasar-keluarga.show', $keluarga->id) }}"><i class="bi bi-eye me-1"></i> Show</a></li>
                            <li><a class="dropdown-item" href="{{ route('data-dasar-keluarga.edit', $keluarga->id) }}"><i class="bi bi-pencil me-1"></i> Edit</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $keluarga->id }}"><i class="bi bi-trash me-1"></i> Delete</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>

<!-- Delete Confirmation Modal -->
@foreach ($keluargas as $keluarga)
<div class="modal fade" id="deleteModal{{ $keluarga->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus Keluarga ini?
            </div>
            <div class="modal-footer">
                <form action="{{ route('data-dasar-keluarga.destroy', $keluarga->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
        </div>
   
@endforeach
    </div>

@endsection
