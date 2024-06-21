@extends('layouts.app_admin')

@section('content')

<div class="card">
    <div class="card-header warna-pns">{{ __('Set Laporan Bulanan') }}</div>

    <div class="card-body">
        <div class="card mb-3">
            <div class="card-body">
                <a class="btn btn-sm btn-success" href="{{ route('laporan-bulan-tahuns.create') }}">Add New Laporan
                    Bulanan</a>
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
            <div class="card-body table-responsive">
                <table class="table table-sm table-striped table-bordered mt-3 mb-3 table-untuk-data">
                    <thead class="table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporans as $laporan)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                @php
                                $bulan = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ];
                                @endphp
                                {{ $bulan[$laporan->bulan] }}
                            </td>
                            <td>{{ $laporan->tahun }}</td>
                            <td>{{ $laporan->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td>
                                <a class="btn btn-sm btn-info"
                                    href="{{ route('laporan-bulan-tahuns.show', $laporan->id) }}">Show</a>
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('laporan-bulan-tahuns.edit', $laporan->id) }}">Edit</a>

                                <!-- Tombol yang memicu modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $laporan->id }}">
                                    Delete
                                </button>

                                <!-- Modal Konfirmasi Delete -->
                                <div class="modal fade" id="deleteModal{{ $laporan->id }}" tabindex="-1"
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
                                                <form action="{{ route('laporan-bulan-tahuns.destroy', $laporan->id) }}"
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