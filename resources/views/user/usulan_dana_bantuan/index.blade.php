@extends('layouts.app_user')

@section('content')

<div class="card">
    <div class="card-header warna-pns">{{ __('Usulan Data Bantuan') }}</div>

    <div class="card-body">
        <div class="card mb-3">
            <div class="card-body">
                <a class="btn btn-sm btn-success" href="{{ route('usulan_dana_bantuan.create') }}">Ajukan Usulan Data
                    Bantuan Baru</a>
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
                            <!-- <th>Foto</th> -->
                            <th>Nama</th>
                            <th>KTP</th>
                            <th>Surat Pernyataan Kaling</th>
                            <th>Alamat</th>
                            <th>Usulan Bantuan</th>
                            <!-- <th>Lingkungan</th> -->
                            <th>Tgl Pengajuan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($UsulanDanaBantuans as $UsulanDanaBantuan)
                        <tr>
                            <td>{{ ++$i }}</td>

                            <td>{{ $UsulanDanaBantuan->nama }}</td>
                            <td>
                                <img src="{{ asset('storage/usulan_ktp/'.$UsulanDanaBantuan->usulan_ktp) }}" alt="foto"
                                    width="50" height="50" class="img-fluid">
                            </td>
                            <td>
                                <a href="{{ asset('storage/surat_pernyataan_kaling/'.$UsulanDanaBantuan->surat_pernyataan_kaling) }}"
                                    target='_blank'>{{ $UsulanDanaBantuan->surat_pernyataan_kaling }}</a>
                            </td>
                            <td>{{ $UsulanDanaBantuan->alamat }}</td>
                            <td>{{ $UsulanDanaBantuan->bantuan->nama_bantuan }}</td>
                            <td>{{ $UsulanDanaBantuan->created_at_formatted }}</td>
                            <!-- <td>{{ $UsulanDanaBantuan->banjar->nama_banjar }}</td> -->
                            @php
                            $badgeColors = [
                            0 => 'danger', // Merah
                            1 => 'success', // Hijau
                            2 => 'primary', // Biru
                            3 => 'warning text-dark' // Kuning
                            ];
                            @endphp

                            <td>
                                <span class="badge bg-{{ $badgeColors[$UsulanDanaBantuan->status] }}">
                                    {{ $UsulanDanaBantuan->status_label }}
                                </span>
                            </td>
                            <td>{!! $UsulanDanaBantuan->keterangan !!}</td>
                            <td>

                                @if($UsulanDanaBantuan->status == 3)
                                <!-- Tampilkan Tombol Ajukan Ulang dan Hapus -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#ajukanUlangModal{{ $UsulanDanaBantuan->id }}">
                                    Ajukan
                                </button>

                                @elseif($UsulanDanaBantuan->status == 2)
                                <!-- Tampilkan hanya Tombol Hapus -->
                                <button type="button" tooltip="Hapus" class="btn btn-sm btn-danger"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $UsulanDanaBantuan->id }}">
                                    Hapus
                                </button>
                                @endif

                                <!-- Modal Ajukan Ulang -->
                                <div class="modal fade" id="ajukanUlangModal{{ $UsulanDanaBantuan->id }}" tabindex="-1"
                                    aria-labelledby="ajukanUlangModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ajukanUlangModalLabel">Ajukan Ulang Usulan
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('usulan_dana_bantuan.ajukan_ulang', $UsulanDanaBantuan->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group mb-2">
                                                        <label for="nama{{ $UsulanDanaBantuan->id }}">Nama:</label>
                                                        <input type="text" class="form-control"
                                                            id="nama{{ $UsulanDanaBantuan->id }}" name="nama"
                                                            value="{{ $UsulanDanaBantuan->nama }}" required>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="usulan_ktp{{ $UsulanDanaBantuan->id }}">KTP:</label>
                                                        <input type="file" class="form-control"
                                                            id="usulan_ktp{{ $UsulanDanaBantuan->id }}"
                                                            name="usulan_ktp">
                                                    </div>
                                                    <img src="{{ asset('storage/usulan_ktp/'.$UsulanDanaBantuan->usulan_ktp) }}"
                                                        alt="foto" width="200" height="" class="img-fluid">


                                                    <div class="form-group mb-2">
                                                        <label for="surat_pernyataan_kaling">Surat Pernyataan kaling
                                                            (SPK):</label>
                                                        <input type="file" class="form-control"
                                                            id="surat_pernyataan_kaling" name="surat_pernyataan_kaling">
                                                    </div>

                                                    <a href="{{ asset('storage/surat_pernyataan_kaling/'.$UsulanDanaBantuan->surat_pernyataan_kaling) }}"
                                                        target='_blank'>{{ $UsulanDanaBantuan->surat_pernyataan_kaling }}</a>

                                                    <div class="form-group mb-2">
                                                        <label for="alamat{{ $UsulanDanaBantuan->id }}">Alamat:</label>
                                                        <textarea class="form-control"
                                                            id="alamat{{ $UsulanDanaBantuan->id }}" name="alamat"
                                                            required>{{ $UsulanDanaBantuan->alamat }}</textarea>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="id_bantuans{{ $UsulanDanaBantuan->id }}">Dana
                                                            Bantuan:</label>
                                                        <select class="form-control"
                                                            id="id_bantuans{{ $UsulanDanaBantuan->id }}"
                                                            name="id_bantuans" required>
                                                            <option value="">--Pilih Dana Bantuan--</option>
                                                            @foreach ($bantuans as $bantuan)
                                                            <option value="{{ $bantuan->id }}"
                                                                {{ $UsulanDanaBantuan->id_bantuans == $bantuan->id ? 'selected' : '' }}>
                                                                {{ $bantuan->nama_bantuan }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label
                                                            for="keterangan{{ $UsulanDanaBantuan->id }}">Keterangan:</label>
                                                        <textarea class="form-control html-editor"
                                                            id="keterangan{{ $UsulanDanaBantuan->id }}"
                                                            name="keterangan">{{ $UsulanDanaBantuan->keterangan }}</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Ajukan
                                                            Ulang</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal Ajukan Ulang -->


                                <!-- Modal Konfirmasi Delete -->
                                <div class="modal fade" id="deleteModal{{ $UsulanDanaBantuan->id }}" tabindex="-1"
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
                                                    action="{{ route('usulan_dana_bantuan_kaling.destroy', $UsulanDanaBantuan->id) }}"
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