@extends('layouts.app_admin')

@section('content')

<div class="card">
    <div class="card-header warna-pns">{{ __('Data Bantuan') }}</div>

    <div class="card-body">
        <div class="card mb-3">
            <div class="card-body">
                <a class="btn btn-sm btn-success" href="{{ route('cetak_laporan_dana_bantuan') }}" target="_blank">Cetak
                    Laporan</a>
                <a class="btn btn-sm btn-primary" href="{{ route('export-2.xlsx') }}">Download XLSX</a>
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

                            <th>Nama</th>
                            <th>KTP</th>
                            <th>SPK</th>
                            <th>Usulan</th>

                            <th>Lingkungan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Tgl Muskel</th>
                            <th width="80px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($DataBantuans as $UsulanDanaBantuan)
                        <tr>
                            <td>{{ ++$i }}</td>

                            <td>{{ $UsulanDanaBantuan->nama }}</td>
                            <td>
                                <!-- Thumbnail Gambar -->
                                <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#ktpModal{{ $UsulanDanaBantuan->id }}">
                                    <img src="{{ asset('storage/usulan_ktp/'.$UsulanDanaBantuan->usulan_ktp) }}"
                                        alt="foto" width="50" height="50" class="img-fluid">
                                </a>

                                <!-- Modal untuk Memperbesar Gambar -->
                                <div class="modal fade" id="ktpModal{{ $UsulanDanaBantuan->id }}" tabindex="-1"
                                    aria-labelledby="ktpModalLabel{{ $UsulanDanaBantuan->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ktpModalLabel{{ $UsulanDanaBantuan->id }}">
                                                    KTP {{ $UsulanDanaBantuan->nama }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/usulan_ktp/'.$UsulanDanaBantuan->usulan_ktp) }}"
                                                    alt="foto" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ asset('storage/surat_pernyataan_kaling/'.$UsulanDanaBantuan->surat_pernyataan_kaling) }}"
                                    target='_blank'>{{ $UsulanDanaBantuan->surat_pernyataan_kaling }}</a>
                            </td>
                            <!-- <td>{{ $UsulanDanaBantuan->alamat }}</td> -->
                            <td>{{ $UsulanDanaBantuan->bantuan->nama_bantuan }}</td>

                            <td>{{ $UsulanDanaBantuan->banjar->nama_banjar }}</td>
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
                            <td>{{ $UsulanDanaBantuan->tgl_musreng }}</td>
                            <td>
                                <a class="btn btn-sm btn-success" href="#" data-bs-toggle="modal"
                                    data-bs-target="#acceptModal{{ $UsulanDanaBantuan->id }}"><i
                                        class="bi bi-check-circle-fill"></i></a>
                                <a class="btn btn-sm btn-danger" href="#" data-bs-toggle="modal"
                                    data-bs-target="#rejectModal{{ $UsulanDanaBantuan->id }}"><i
                                        class="bi bi-x-circle-fill"></i></a>
                                <!-- Tombol untuk memicu modal konfirmasi delete -->
                                <form action="{{ route('data_bantuan.destroy', $UsulanDanaBantuan->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>


                                <!-- Modal Konfirmasi Diterima -->
                                <div class="modal fade" id="acceptModal{{ $UsulanDanaBantuan->id }}" tabindex="-1"
                                    aria-labelledby="acceptModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title" id="acceptModalLabel">Konfirmasi Penerimaan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="{{ route('usulan_dana_bantuans.accept', $UsulanDanaBantuan->id) }}"
                                                method="POST">
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label
                                                            for="keteranganDiterima{{ $UsulanDanaBantuan->id }}">Keterangan
                                                            Diterima:</label>
                                                        <textarea class="form-control html-editor"
                                                            id="keteranganDiterima{{ $UsulanDanaBantuan->id }}"
                                                            name="keterangan_diterima" rows="3"
                                                            required>{{ $UsulanDanaBantuan->keterangan }}</textarea>
                                                    </div>



                                                    <div class="form-group mt-3">
                                                        <label
                                                            for="tanggalMusrenbangDiterima{{ $UsulanDanaBantuan->id }}">Tanggal
                                                            Muskel:</label>
                                                        <input type="date" class="form-control"
                                                            id="tanggalMusrenbangDiterima{{ $UsulanDanaBantuan->id }}"
                                                            name="tanggal_musrenbang_diterima"
                                                            value="{{ $UsulanDanaBantuan->tgl_musreng }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>

                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success">Diterima</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal Konfirmasi Penolakan -->
                                <div class="modal fade" id="rejectModal{{ $UsulanDanaBantuan->id }}" tabindex="-1"
                                    aria-labelledby="rejectModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="rejectModalLabel">Konfirmasi Penolakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form
                                                action="{{ route('usulan_dana_bantuans.reject', $UsulanDanaBantuan->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menolak usulan ini?</p>
                                                    <!-- Select Box untuk Jenis Penolakan -->
                                                    <div class="form-group">
                                                        <label for="jenisPenolakan{{ $UsulanDanaBantuan->id }}">Jenis
                                                            Penolakan:</label>
                                                        <select class="form-select"
                                                            id="jenisPenolakan{{ $UsulanDanaBantuan->id }}"
                                                            name="jenis_penolakan"
                                                            onchange="toggleTanggalMusrenbang(this, '{{ $UsulanDanaBantuan->id }}')">
                                                            <option value="0">Ditolak Permanen</option>
                                                            <option value="3">Ditolak Sementara</option>
                                                        </select>
                                                    </div>
                                                    <!-- Input Textbox untuk Keterangan -->
                                                    <div class="form-group mt-3">
                                                        <label
                                                            for="keteranganPenolakan{{ $UsulanDanaBantuan->id }}">Keterangan
                                                            Ditolak:</label>
                                                        <textarea class="form-control html-editor"
                                                            id="keteranganPenolakan{{ $UsulanDanaBantuan->id }}"
                                                            name="keterangan_penolakan" rows="3"
                                                            required>{{ $UsulanDanaBantuan->keterangan }}</textarea>
                                                    </div>
                                                    <!-- Input Tanggal Musrenbang -->
                                                    <div class="form-group mt-3"
                                                        id="tanggalMusrenbangGroup{{ $UsulanDanaBantuan->id }}">
                                                        <label
                                                            for="tanggalMusrenbangDitolak{{ $UsulanDanaBantuan->id }}">Tanggal
                                                            Muskel:</label>
                                                        <input type="date" class="form-control"
                                                            id="tanggalMusrenbangDitolak{{ $UsulanDanaBantuan->id }}"
                                                            name="tanggal_musrenbang_ditolak"
                                                            value="{{ $UsulanDanaBantuan->tgl_musreng }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                </div>
                                            </form>

                                            <!-- Script JavaScript -->
                                            <script>
                                            function toggleTanggalMusrenbang(selectElement, id) {
                                                const tanggalMusrenbangGroup = document.getElementById(
                                                    'tanggalMusrenbangGroup' + id);
                                                if (selectElement.value === '0') {
                                                    tanggalMusrenbangGroup.style.display =
                                                        'block'; // Menampilkan input tanggal
                                                    tanggalMusrenbangGroup.querySelector('input').required =
                                                        true; // Menjadikan input tanggal required
                                                } else {
                                                    tanggalMusrenbangGroup.style.display =
                                                        'none'; // Menyembunyikan input tanggal
                                                    tanggalMusrenbangGroup.querySelector('input').required =
                                                        false; // Menonaktifkan required
                                                }
                                            }

                                            // Panggil fungsi untuk mengatur tampilan awal berdasarkan nilai yang sudah dipilih
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const selectElements = document.querySelectorAll(
                                                    '[id^="jenisPenolakan"]');
                                                selectElements.forEach(function(selectElement) {
                                                    const id = selectElement.id.replace(
                                                        'jenisPenolakan', '');
                                                    toggleTanggalMusrenbang(selectElement, id);
                                                });
                                            });
                                            </script>
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