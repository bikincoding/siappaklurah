<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    body {

        /* Light brown background */
        color: #4b3621;
        /* Dark brown text */
    }

    .navbar,
    .footer {
        background-color: #343a40;
        /* Saddle brown for navbar and footer */
        color: white;
    }

    .section {
        padding: 60px 0;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
    }


    .biodata-container {
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        padding: 20px;
    }

    .photo {
        flex: 1;
        text-align: center;
    }

    .photo img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .details {
        flex: 2;
        padding-left: 20px;
    }

    .details .detail-item {
        margin-bottom: 10px;
        text-align: left;
    }

    .image-container {
        height: 300px;
        /* Set the desired height */
        overflow: hidden;
    }

    .image-container img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        /* Cover the container while maintaining the aspect ratio */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .box-grey {
        border: 2px solid #D3D3D3;
        padding: 15px;
        border-radius: 10px;

    }

    .header-hero {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 60vh;
        /* Adjust the height as needed */
        background-color: #343a40;
        /* Optional: Add a background color */
        color: white
    }

    .header-hero .container {
        text-align: center;
    }


    .nav-link:hover {
        color: orange !important;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <!-- <img src="path/to/your/logo.png" alt="Logo" style="height: 40px;"> -->
                SIAPPAKLURAH
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#kerobokanKaja">Data Kerobokan Kaja</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#kepalaLingkungan">Data Kepala Lingkungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sumberDayaManusia">Data Lingkungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white"
                            href="https://siappaklurah.bikincoding.com/login">Login</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <header class="text-center py-5 mb-4 header-hero">
        <div class="container">
            <h1 class="fw-light">Selamat Datang di SiapPakLurah</h1>
            <p class="lead">Informasi mengenai Data Kerobokan Kaja, Data Kepala Lingkungan, dan Data Lingkungan</p>
        </div>
    </header>

    <section id="kerobokanKaja" class="section text-center">
        <div class="container">
            <h2 class="">Data Kerobokan Kaja</h2>
            <p class="card-text">Detail informasi mengenai Kerobokan Kaja akan ditampilkan di sini.</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                                        <div class="nav flex-column nav-pills border p-3" id="v-pills-tab"
                                            role="tablist" aria-orientation="vertical">
                                            @foreach ($datas_all as $index => $data)
                                            @php
                                            $bulan = [
                                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                            ];
                                            @endphp

                                            <button class="nav-link show-data {{ $index === 0 ? 'active' : '' }}"
                                                data-id="{{ $data->id }}" data-bulan="{{ $bulan[$data->bulan] }}"
                                                data-tahun="{{ $data->tahun }}">
                                                {{ $bulan[$data->bulan] }} {{ $data->tahun }}
                                            </button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-showdata" role="tabpanel"
                                                aria-labelledby="v-pills-showdata-tab">
                                                <div class="border p-3">
                                                    <div id="showdata">Pilih laporan bulanan yang ingin anda lihat
                                                        dengan cara memilih/klik menu bulan yang tersedia</div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kepalaLingkungan" class="section text-center">
        <div class="container">
            <h2 class="">Data Kepala Lingkungan</h2>
            <p class="card-text">Detail informasi mengenai Kepala Lingkungan.
            </p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">





                            <div class="container mt-4">
                                <div class="row">
                                    @foreach ($kepalaLingkungans as $kepalaLingkungan)

                                    <div class="col-md-3 mb-3">
                                        <div class="border h-100">
                                            <div class="image-container">
                                                <img src="{{ asset('storage/foto_kepala_lingkungan/'.$kepalaLingkungan->foto) }}"
                                                    class="card-img-top"
                                                    alt="{{ $kepalaLingkungan->nama_kepala_lingkungan }}">
                                            </div>
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <div>
                                                    <h5 class="card-title text-center">
                                                        {{ $kepalaLingkungan->nama_kepala_lingkungan }}</h5>
                                                    <p class="card-text">
                                                    <table class="table table-borderless table-sm">
                                                        <tbody>
                                                            <tr>
                                                                <th>Alamat</th>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $kepalaLingkungan->alamat }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Lingkungan</th>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $kepalaLingkungan->banjar->nama_banjar }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Telp</th>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ $kepalaLingkungan->telepon }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="sumberDayaManusia" class="section text-center">
        <div class="container">
            <h2 class="">Data Lingkungan</h2>
            <p class="card-text">Detail informasi mengenai Lingkungan.
            </p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">



                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                                        <div class="nav flex-column nav-pills border p-3" id="v-pills-tab"
                                            role="tablist" aria-orientation="vertical">
                                            @foreach ($lingkungans as $index => $data)


                                            <button
                                                class="nav-link show-data-lingkungan {{ $index === 0 ? 'active' : '' }}"
                                                data-id="{{ $data->id }}">
                                                {{ $data->nama_banjar }}
                                            </button>
                                            @endforeach
                                            <!-- <button class="nav-link active" id="v-pills-batuculung1-tab"
                                                data-bs-toggle="pill" data-bs-target="#v-pills-batuculung1"
                                                type="button" role="tab" aria-controls="v-pills-batuculung1"
                                                aria-selected="true">Batuculung
                                            </button> -->

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-show-data-lingkungan"
                                                role="tabpanel" aria-labelledby="v-pills-show-data-lingkungan-tab">

                                                <div id="showdatalingkungan"></div>
                                                <div class="border p-3">

                                                    <div id="showdatalingkunganlaporan">Pilih laporan bulanan yang ingin
                                                        anda lihat dengan cara memilih/klik menu bulan
                                                        yang tersedia</div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer py-3">
        <div class="container text-center">
            <span>&copy; 2024 Data Kerobokan Kaja. All Rights Reserved.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- <script>
    $(document).ready(function() {
        $(' .show-data').click(function(event) { event.preventDefault(); // Get data attributes (if needed for further
                                                    use) let id=$(this).data('id'); let bulan=$(this).data('bulan'); let
                                                    tahun=$(this).data('tahun'); // Manipulate the #showdata div
                                                    $('#showdata').html(bulan); }); }); </script> -->

    <script>
    $(document).ready(function() {
        $('.show-data').click(function(event) {
            event.preventDefault();

            let id = $(this).data('id');

            $.ajax({
                url: '/cetak_lingkungan_kerobokan_kaja/' +
                    id,
                type: 'GET',
                success: function(response) {
                    $('#showdata').html(
                        response);
                },
                error: function(xhr) {
                    console.error('Error:',
                        xhr);
                    $('#showdata').html(
                        'An error occurred while retrieving the data.'
                    );
                }
            });
        });
    });
    </script>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.show-data');

        buttons.forEach(button => {
            button.addEventListener('click',
                function() {
                    // Remove active class from all buttons
                    buttons.forEach(btn => btn
                        .classList.remove(
                            'active'));

                    // Add active class to the clicked button
                    this.classList.add('active');
                });
        });

        // Automatically make the first button active (if not set in the HTML)
        if (buttons.length > 0) {
            buttons[0].classList.add('active');
        }
    });
    </script>

    <!-- -------------------------------------------------------------------------------------------------------------------------- -->

    <script>
    $(document).ready(function() {
        $('.show-data-lingkungan').click(function(event) {
            event.preventDefault();

            let id = $(this).data('id');

            // Reset the content of #showdatalingkunganlaporan
            $('#showdatalingkunganlaporan').html(
                'Pilih laporan bulanan yang ingin anda lihat dengan cara memilih/klik menu bulan yang tersedia'
            );

            $.ajax({
                url: '/cetak_lingkungan_kaling/' + id,
                type: 'GET',
                success: function(response) {
                    $('#showdatalingkungan').html(response);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    $('#showdatalingkungan').html(
                        'An error occurred while retrieving the data.');
                }
            });
        });
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll(
            '.show-data-lingkungan');

        buttons.forEach(button => {
            button.addEventListener('click',
                function() {
                    // Remove active class from all buttons
                    buttons.forEach(btn => btn
                        .classList.remove(
                            'active'));

                    // Add active class to the clicked button
                    this.classList.add('active');
                });
        });

        // Automatically make the first button active (if not set in the HTML)
        if (buttons.length > 0) {
            buttons[0].classList.add('active');
        }
    });
    </script>

    <!-- -------------------------------------------------------------------------------------------------------------------------- -->

    <script>
    $(document).ready(function() {
        // Event delegation for dynamically added elements
        $(document).on('click', '.show-data-lingkungan-laporan',
            function(event) {
                event.preventDefault();

                // Remove active class from all buttons
                $('.show-data-lingkungan-laporan')
                    .removeClass('active');

                // Add active class to the clicked button
                $(this).addClass('active');

                let id = $(this).data('id');
                let id2 = $(this).data('id2');

                $.ajax({
                    url: '/cetak_lingkungan_kaling_laporan/' +
                        id + '/' + id2,
                    type: 'GET',
                    success: function(response) {
                        $('#showdatalingkunganlaporan')
                            .html(response);
                    },
                    error: function(xhr) {
                        console.error('Error:',
                            xhr);
                        $('#showdatalingkunganlaporan')
                            .html(
                                'An error occurred while retrieving the data.'
                            );
                    }
                });
            });
    });
    </script>

</body>

</html>