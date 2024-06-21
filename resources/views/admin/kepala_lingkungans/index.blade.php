@extends('layouts.app_admin')

@section('content')

<div class="card">
    <div class="card-header warna-pns">{{ __('Data Kepala Lingkungan') }}</div>

    <div class="card-body">
        <div class="card mb-3">
            <div class="card-body">
                <a class="btn btn-sm btn-success" href="{{ route('kepala_lingkungans.create') }}">Add New Kepala
                    Lingkungan</a>
            </div>
        </div>
        <!-- Pesan Sukses -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <!-- Tabel Kepala Lingkungan -->
        <div class="card">
            <div class="card-body table-responsive">
                <table class=" table table-sm table-striped table-bordered mt-3 mb-3 table-untuk-data">
                    <thead class="table-bordered ">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Kepala Lingkungan</th>
                            <th>Alamat</th>
                            <th>Lingkungan</th>
                            <th>Telepon</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kepala_lingkungans as $kepala_lingkungan)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                <img src="{{ asset('storage/foto_kepala_lingkungan/'.$kepala_lingkungan->foto) }}"
                                    alt="foto" width="50" height="50" class="img-fluid">



                            </td>
                            <td>{{ $kepala_lingkungan->nama_kepala_lingkungan }}</td>
                            <td>{{ $kepala_lingkungan->alamat }}</td>
                            <td>{{ $kepala_lingkungan->banjar->nama_banjar }}</td>
                            <td>{{ $kepala_lingkungan->telepon }}</td>
                            <td>
                                <a class="btn btn-sm btn-info"
                                    href="{{ route('kepala_lingkungans.show', $kepala_lingkungan->id) }}">Show</a>
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('kepala_lingkungans.edit', $kepala_lingkungan->id) }}">Edit</a>

                                <!-- Tombol yang memicu modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $kepala_lingkungan->id }}">
                                    Delete
                                </button>

                                <!-- Modal Konfirmasi Delete -->
                                <div class="modal fade" id="deleteModal{{ $kepala_lingkungan->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form
                                                    action="{{ route('kepala_lingkungans.destroy', $kepala_lingkungan->id) }}"
                                                    method="POST">
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