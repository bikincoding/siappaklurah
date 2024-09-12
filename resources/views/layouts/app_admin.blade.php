<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        color: #007bff !important;
        background-color: #ffffff !important;
        border: 1px solid #aaaaaa !important;
        border-radius: 4px !important;
    }


    .dataTables_wrapper .dataTables_scroll .dataTables_scrollHead .dataTables_scrollHeadInner table {
        background-color: #f8f9fa !important;
    }

    .dataTables_wrapper .dataTables_scroll .dataTables_scrollBody table {
        border-collapse: separate;
        border: 1px solid gray;
    }

    table.dataTable thead th,
    table.dataTable tbody td {
        border-bottom: 1px solid gray;
    }

    table.dataTable thead th {
        border-top: 1px solid gray;
    }

    .warna-pns {
        background: #f59b4c !important;
        /* Warna coklat baju PNS Indonesia */
        color: white !important;
    }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->kepala_lingkungan->nama_kepala_lingkungan }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-2">
                        <div class="card mb-4">
                            <div class="card-header warna-pns">{{ __('Menu') }}</div>

                            <div class="list-group list-group-flush">
                                <a href="{{ route('dashboard') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-house-door-fill me-3"></i>{{ __('Dashboard') }}
                                </a>

                                <!-- <a href="{{ route('data-dasar-keluarga.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-people-fill me-3"></i>{{ __('Data Penduduk') }}
                    </a> -->
                                <a href="{{ route('pegawais.index') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-person-fill me-3"></i>{{ __('Data Pegawai') }}
                                </a>
                                <a href="{{ route('kepala_lingkungans.index') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-person-fill me-3"></i>{{ __('Data Kepala Lingkungan') }}
                                </a>
                                <a href="{{ route('laporans.index') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-bar-chart-fill me-3"></i>{{ __('Laporan') }}
                                </a>

                                <!-- More menu items -->
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header warna-pns">{{ __('SiGAB') }}</div>

                            <div class="list-group list-group-flush">
                                <a href="{{ route('usulan_dana_bantuan') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-wallet-fill me-3"></i>{{ __('Usulan Data Bantuan') }}
                                </a>
                                <a href="{{ route('data_bantuan') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-wallet-fill me-3"></i>{{ __('Data Bantuan') }}
                                </a>
                            </div>

                        </div>

                        <div class="card mb-4">
                            <div class="card-header warna-pns">{{ __('Setting') }}</div>

                            <div class="list-group list-group-flush">
                                <a href="{{ route('user') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-person-fill me-3"></i>{{ __('User') }}
                                </a>
                                <a href="{{ route('banjar') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-tree-fill me-3"></i>{{ __('Lingkungan') }}
                                </a>
                                <a href="{{ route('laporan-bulan-tahuns.index') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i
                                        class="bi bi-file-earmark-bar-graph-fill me-3"></i>{{ __('Set Laporan Bulanan') }}
                                </a>
                                <!-- <a href="{{ route('laporan-bulan-tahuns.index') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-building me-3"></i>{{ __('Profil Kelurahan') }}
                                </a> -->


                                <!-- More menu items -->
                            </div>
                        </div>

                    </div>


                    <div class="col-md-9">
                        @yield('content')
                    </div>



                </div>
            </div>

        </main>
    </div>
    <script src="{{ asset('vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
    tinymce.init({
        selector: 'textarea.html-editor', // Selector untuk textarea yang ingin diubah menjadi TinyMCE editor
        plugins: 'lists link image preview textcolor colorpicker', // Tambahkan 'textcolor' dan 'colorpicker' di sini
        toolbar: 'undo redo | formatselect | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview',
        menubar: false,
        height: 300,
        setup: function(editor) {
            editor.ui.registry.addButton('myCustomButton', {
                text: 'Custom Button',
                onAction: function() {
                    editor.insertContent('<p>Button clicked!</p>');
                }
            });
        }
    });
    </script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
    // $(document).ready(function() {
    //     $('#example').DataTable({
    //         paging: true,
    //         lengthChange: true,
    //         searching: true,
    //         ordering: true,
    //         info: true,
    //         autoWidth: true
    //     });
    // } );

    $(document).ready(function() {
        $('.table-untuk-data').DataTable({
            "pagingType": "simple_numbers",
            "responsive": true,
            "language": {
                "lengthMenu": "Tampilkan _MENU_ entri",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada entri yang tersedia",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
            },
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "order": [
                [0, 'asc']
            ]
        });
    });
    </script>




    @yield('javascript')

</body>

</html>