@extends('layouts.app_user')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Data Lingkungan') }}</div>

        <div class="card-body">
            
                <a class="btn btn-sm btn-success" href="{{ route('banjars.create') }}">Add New Lingkungan</a>
        </div>
</div>
            <!-- Pesan Sukses -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <!-- Tabel Banjar -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-striped table-bordered mt-3 mb-3">
                        <thead class="table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Nama Lingkungan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banjars as $banjar)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $banjar->nama_banjar }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{ route('banjars.show', $banjar->id) }}">Show</a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('banjars.edit', $banjar->id) }}">Edit</a>
                                    
                                    <!-- Tombol yang memicu modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $banjar->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal Konfirmasi Delete -->
                                    <div class="modal fade" id="deleteModal{{ $banjar->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah yakin ingin menghapus data ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('banjars.destroy', $banjar->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Konfirmasi Delete -->
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
