@extends('layouts.app_admin')

@section('content')

<div class="card">
    <div class="card-header warna-pns">{{ __('Data Pegawai') }}</div>

    <div class="card-body">
        <div class="card mb-3">
            <div class="card-body">
                <a class="btn btn-sm btn-success" href="{{ route('pegawais.create') }}">Add New Pegawai</a>
            </div>
        </div>
        <!-- Pesan Sukses -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <!-- Tabel Pegawai -->
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-sm table-striped table-bordered mt-3 mb-3 table-untuk-data">
                    <thead class="table-bordered ">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Pegawai</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawais as $pegawai)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td><img src="{{ asset('storage/foto_pegawai/'.$pegawai->foto_pegawai) }}" alt="foto"
                                    width="50" height="50" class="img-fluid"> <!-- Tampilkan foto di sini -->
                            </td>
                            <td>{{ $pegawai->nama_pegawai }}</td>
                            <td>{{ $pegawai->nip }}</td>
                            <td>{{ $pegawai->email }}</td>
                            <td>
                                <a class="btn btn-sm btn-info"
                                    href="{{ route('pegawais.show', $pegawai->id) }}">Show</a>
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('pegawais.edit', $pegawai->id) }}">Edit</a>

                                <!-- Tombol yang memicu modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $pegawai->id }}">
                                    Delete
                                </button>

                                <!-- Modal Konfirmasi Delete -->
                                <div class="modal fade" id="deleteModal{{ $pegawai->id }}" tabindex="-1"
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
                                                <form action="{{ route('pegawais.destroy', $pegawai->id) }}"
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