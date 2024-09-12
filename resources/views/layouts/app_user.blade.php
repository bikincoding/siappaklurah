<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
    .hover-effectxxx {
        text-decoration: none;
        color: inherit;
    }

    .hover-effectxxx:hover {
        background: #8B4513 !important;
        /* Warna coklat baju PNS Indonesia */
        color: white;
    }

    .warna-pns {
        background: #f59b4c !important;
        /* Warna coklat baju PNS Indonesia */
        color: white !important;
    }

    .card-section {
        display: none;
    }

    .form-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .form-group {
        flex: 1;
        min-width: 200px;
    }


    /* @media (max-width: 600px) {
        .form-container {
            flex-direction: column;
        }
    }

    @media (min-width: 1024px) {
        .container {
            width: 80%;
            max-width: 80%;
            margin: auto;
            padding-left: 15px;
            padding-right: 15px;
        }
    }

   
    @media (orientation: landscape) {
        .container {
            width: 100%;
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
        }
    } */
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-md">
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
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('kepala_lingkungans.biodata', Auth::user()->id_kepala_lingkungans) }}">Biodata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.form_reset_password', Auth::user()->id) }}">Reset
                                Password</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-md">
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-3">
                        <div class="card mb-3">
                            <div class="card-header warna-pns">{{ __('Menu') }}</div>

                            <div class="list-group list-group-flush">
                                <a href="{{ url('/dashboard_user') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-house-door-fill me-3"></i>{{ __('Dashboard') }}
                                </a>
                                <a href="{{ route('pelaporan.index') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-envelope-fill me-3"></i>{{ __('Pelaporan') }}
                                </a>

                                <!-- More menu items -->
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header warna-pns">{{ __('SiGAB') }}</div>

                            <div class="list-group list-group-flush">

                                <a href="{{ route('usulan_dana_bantuan_kaling') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="bi bi-wallet-fill me-3"></i>{{ __('Usulan Data Bantuan') }}
                                </a>
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



    <!-- Scripts for Bootstrap 5 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>


    @yield('javascripts')
    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true
        });
    });

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

</body>

</html>