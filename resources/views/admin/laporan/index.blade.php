@extends('layouts.app_admin')

@section('content')

<div class="card">
    <div class="card-header warna-pns">{{ __('Data Laporan') }}</div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Lingkungan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Kerobokan
                    Kaja</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">Contact</button>
            </li> -->
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card-body">
                    <div class="card mb-3">
                        <div class="card-body">

                            <form action="{{ route('filter_laporan') }}" method="get">
                                <div class="row mb-3">
                                    <div class="col-12 col-md-4">
                                        <label for="id_banjar" class="form-label">Nama Lingkungan</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select class="form-control" id="id_banjar" name="id_banjar">
                                            <option value="">--Lingkungan--</option>
                                            @foreach ($banjars as $banjar)
                                            <option value="{{ $banjar->id }}"
                                                {{ old('id_banjar') == $banjar->id ? 'selected' : '' }}>
                                                {{ $banjar->nama_banjar }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12 col-md-4">
                                        <label for="bulan" class="form-label">Bulan</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select class="form-control" id="bulan" name="bulan">
                                            <option value="">--Bulan--</option>
                                            <option value="1" {{ old('bulan') == "1" ? 'selected' : '' }}>Januari
                                            </option>
                                            <option value="2" {{ old('bulan') == "2" ? 'selected' : '' }}>Februari
                                            </option>
                                            <option value="3" {{ old('bulan') == "3" ? 'selected' : '' }}>Maret</option>
                                            <option value="4" {{ old('bulan') == "4" ? 'selected' : '' }}>April</option>
                                            <option value="5" {{ old('bulan') == "5" ? 'selected' : '' }}>Mei</option>
                                            <option value="6" {{ old('bulan') == "6" ? 'selected' : '' }}>Juni</option>
                                            <option value="7" {{ old('bulan') == "7" ? 'selected' : '' }}>Juli</option>
                                            <option value="8" {{ old('bulan') == "8" ? 'selected' : '' }}>Agustus
                                            </option>
                                            <option value="9" {{ old('bulan') == "9" ? 'selected' : '' }}>September
                                            </option>
                                            <option value="10" {{ old('bulan') == "10" ? 'selected' : '' }}>Oktober
                                            </option>
                                            <option value="11" {{ old('bulan') == "11" ? 'selected' : '' }}>November
                                            </option>
                                            <option value="12" {{ old('bulan') == "12" ? 'selected' : '' }}>Desember
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12 col-md-4">
                                        <label for="tahun" class="form-label">Tahun</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select class="form-control" id="tahun" name="tahun">
                                            <option value="">--Tahun--</option>
                                            <option value="2023" {{ old('tahun') == "2023" ? 'selected' : '' }}>2023
                                            </option>
                                            <option value="2024" {{ old('tahun') == "2024" ? 'selected' : '' }}>2024
                                            </option>
                                            <option value="2025" {{ old('tahun') == "2025" ? 'selected' : '' }}>2025
                                            </option>
                                            <!-- dst. -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-4"></div>
                                    <div class="col-12 col-md-8">
                                        <input type="submit" name="btn-filter" class="btn btn-sm btn-success"
                                            value="Filter">
                                    </div>
                                </div>
                            </form>
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
                            <table class=" table table-sm table-striped table-bordered mt-3 mb-3 table-untuk-data">
                                <thead class="table-bordered ">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lingkungan</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $data->nama_banjar }}</td>

                                        <td> @php
                                            $bulan = [
                                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                            ];
                                            @endphp
                                            {{ $bulan[$data->bulan ]}}</td>
                                        <td>{{ $data->tahun }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('cetak_laporan_sumber_daya_manusia', ['id_banjars' => $data->id_banjars, 'id' => $data->id]) }}"
                                                target="_blank">Cetak</a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card-body">

                    <!-- Pesan Sukses -->
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <!-- Tabel Banjar -->
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class=" table table-sm table-striped table-bordered mt-3 mb-3 table-untuk-data">
                                <thead class="table-bordered ">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lingkungan</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas_all as $data)
                                    <tr>
                                        <td>{{ ++$j }}</td>
                                        <td>Kerobokan Kaja</td>

                                        <td> @php
                                            $bulan = [
                                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                            ];
                                            @endphp
                                            {{ $bulan[$data->bulan ]}}</td>
                                        <td>{{ $data->tahun }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('cetak_laporan_sumber_daya_manusia_all', ['id' => $data->id]) }}"
                                                target="_blank">Cetak</a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
    </div>
</div>

@endsection