@extends('layouts.app_landing_page')

@section('css')
<style>
.custom-min-height {
    min-height: 400px; /* atau nilai lain yang Anda inginkan */
}

.carousel-item img {
        height: 500px; /* Sesuaikan tinggi sesuai kebutuhan */
        object-fit: cover; /* Pastikan gambar menutupi seluruh area tanpa distorsi */
        background-color: gray;
    }
</style>
@endsection

@section('content')
<div class="container">
    
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">

          
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="your-image-url.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="your-image-url.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="your-image-url.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-4">
           
            <div class="border p-4">
            <img src="{{ asset('image/logo-badung.jpg') }}" class="img" alt="Logo Badung">
            </div>
        </div>
        <div class="col-md-8">
            <div class="border p-4">
                <h2>Kelurahan Kerobokan Kaja </h2>
                <p>Kelurahan Kerobokan Kaja merupakan salah satu kelurahan dari 16 Kelurahan di Kabupaten Badung yang ada diwilayah Kecamatan Kuta Utara, Kabupaten Badung, Provinsi Bali. Kelurahan Kerobokan Kaja terletak di sebelah timur Kecamatan Kuta Utara dan berbatasan langsung dengan Kota Denpasar, sekaligus menjadi pintu gerbang untuk memasuki Kabupaten Badung Mangupura dari Ibukota Provinsi Bali serta menjadi daerah penopang ibu kota kabupaten Badung yaitu Mangupura. Sebagian besar wilayah Kelurahan Kerobokan Kaja adalah daerah perumahan penduduk yang meliputi 23 lingkungan yaitu: lingkungan Batuculung, lingkungan Babakan, lingkungan Beluraan, lingkungan Gadon, lingkungan Jambe, lingkungan Batubidak, lingkungan Petingan, lingkungan Muding Mekar, lingkungan Muding Kaja, lingkungan Muding Tengah, lingkungan Muding Kelod, lingkungan Padang Lestari, lingkungan Surya Bhuana, lingkungan Tegal Sari, lingkungan Tegal Permai, lingkungan Wira Bhuana, lingkungan Blubuh Sari, lingkungan Buana Asri, lingkungan Buana Graha, lingkungan Buana Shanti, lingkungan Bumi Kertha, lingkungan Bumi Mekar Sari, serta lingkungan Bhineka Asri.</p>
            </div>
        </div>
      
    </div>
    <!-- <div class="row justify-content-center mb-4">
        <div class="col-md-12">
           

            <div class="border p-4">
                slide
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-4">
           
            <div class="border p-4">
                slide
            </div>
        </div>
        <div class="col-md-4">
          
            <div class="border p-4">
                slide
            </div>
        </div>
        <div class="col-md-4">
           

            <div class="border p-4">
                slide
            </div>
        </div>
    </div> -->
    
</div>
@endsection
