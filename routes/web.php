<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataDasarKeluargaController;
use App\Http\Controllers\DataDasarKeluargaDetailController;
use App\Http\Controllers\LaporanBulanTahunController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PegawaisController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KepalaLingkunganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DataKerobokanKajaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('dashboard');
        } elseif (Auth::user()->hasRole('user')) {
            return redirect()->route('dashboard_user');
        }
    } else {
        return redirect('/login');
    }
});

Route::get('/data_kerobokan_kaja', [App\Http\Controllers\DataKerobokanKajaController::class, 'index'])->name('data_kerobokan_kaja.index');
Route::get('/cetak_lingkungan_kerobokan_kaja/{id}', [DataKerobokanKajaController::class, 'cetak_lingkungan_kerobokan_kaja'])->name('cetak_lingkungan_kerobokan_kaja');
Route::get('/cetak_lingkungan_kaling/{id}', [DataKerobokanKajaController::class, 'cetak_lingkungan_kaling'])->name('cetak_lingkungan_kaling');
Route::get('/cetak_lingkungan_kaling_laporan/{id}/{id2}', [DataKerobokanKajaController::class, 'cetak_lingkungan_kaling_laporan'])->name('cetak_lingkungan_kaling_laporan');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard_user', [App\Http\Controllers\DashboardUserController::class, 'index'])->name('dashboard_user');
});

// Rute untuk pengguna tidak terautentikasi
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});


Route::middleware(['admin', 'auto.logout'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/data_penduduk', [App\Http\Controllers\DataPendudukController::class, 'index'])->name('data_penduduk');
    Route::get('/banjar', [App\Http\Controllers\BanjarController::class, 'index'])->name('banjar');
    Route::resource('banjars', App\Http\Controllers\BanjarController::class);
    
    Route::resource('data-dasar-keluarga', DataDasarKeluargaController::class);
    Route::resource('data_dasar_keluarga_detail', DataDasarKeluargaDetailController::class);
    Route::resource('laporan-bulan-tahuns', App\Http\Controllers\LaporanBulanTahunController::class);
    Route::resource('pegawais', App\Http\Controllers\PegawaisController::class);
    Route::resource('laporans', App\Http\Controllers\LaporanController::class);
    Route::get('/laporan/lingkungan', [LaporanController::class, 'laporanPerLingkungan'])->name('laporan.lingkungan');
    Route::get('/laporan/kerobokan_kaja', [LaporanController::class, 'laporanKerobokanKaja'])->name('laporan.kerobokan_kaja');

    // Route::resource('kepala_lingkungans', App\Http\Controllers\KepalaLingkunganController::class);
    
    Route::get('data-dasar-keluarga/{data_dasar_keluarga}/tambah-anggota', [DataDasarKeluargaController::class, 'tambahAnggota'])->name('data-dasar-keluarga.tambah_anggota');
    Route::post('data-dasar-keluarga/{data_dasar_keluarga}/simpan-anggota', [DataDasarKeluargaController::class, 'simpanAnggota'])->name('data-dasar-keluarga.simpan_anggota');

    Route::get('/cetak_laporan_sumber_daya_manusia/{id_banjars}/{id}', [App\Http\Controllers\LaporanController::class, 'cetak_laporan_sumber_daya_manusia'])->name('cetak_laporan_sumber_daya_manusia');
    Route::get('/cetak_laporan_sumber_daya_manusia_all/{id}', [App\Http\Controllers\LaporanController::class, 'cetak_laporan_sumber_daya_manusia_all'])->name('cetak_laporan_sumber_daya_manusia_all');

    Route::get('/filter_laporan', [LaporanController::class, 'filter'])->name('filter_laporan');
    Route::put('/users/{user}/changePassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('users.changePassword');

    Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('home');
    Route::resource('kepala_lingkungans', App\Http\Controllers\KepalaLingkunganController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);

});








Route::middleware(['user', 'auto.logout'])->group(function () {
    Route::get('/dashboard_user', [App\Http\Controllers\DashboardUserController::class, 'index'])->name('dashboard_user');
    // Route::get('/pelaporan', [App\Http\Controllers\PelaporanController::class, 'index'])->name('pelaporan');
    Route::resource('pelaporan', App\Http\Controllers\PelaporanController::class);
    Route::get('/pelaporan/data-pokok/{id}', [PelaporanController::class, 'data_pokok'])->name('pelaporan.data_pokok');
    Route::post('/pelaporan/store_sumber_daya_manusia/{id}', [PelaporanController::class, 'store_sumber_daya_manusia'])->name('pelaporan.store_sumber_daya_manusia');
    Route::post('/laporan/{id}/usias', [PelaporanController::class, 'store_usias'])->name('pelaporan.store_usias');
    Route::delete('/laporan/{id}/usias/{usiaId}', [PelaporanController::class, 'destroy_usia'])->name('pelaporan.destroy_usia');
    Route::post('/pelaporan/{id}/store-pendidikan', [PelaporanController::class, 'store_pendidikan'])->name('pelaporan.store_pendidikan');
    Route::delete('/pelaporan/{id}/pendidikan/{pendidikanId}', [PelaporanController::class, 'destroy_pendidikan'])->name('pelaporan.destroy_pendidikan');
    Route::post('/pelaporan/{id}/store-matapencaharianpokok', [PelaporanController::class, 'store_matapencaharianpokok'])->name('pelaporan.store_matapencaharianpokok');
    Route::delete('/pelaporan/{id}/matapencaharianpokok/{mpId}', [PelaporanController::class, 'destroy_matapencaharianpokok'])->name('pelaporan.destroy_matapencaharianpokok');

    Route::post('/pelaporan/{id}/store-agama', [PelaporanController::class, 'store_agama'])->name('pelaporan.store_agama');
    Route::delete('/pelaporan/{id}/agama/{agamaId}', [PelaporanController::class, 'destroy_agama'])->name('pelaporan.destroy_agama');

    Route::post('/pelaporan/{id}/store-kewarganegaraan', [PelaporanController::class, 'store_kewarganegaraan'])->name('pelaporan.store_kewarganegaraan');
    Route::delete('/pelaporan/{id}/kewarganegaraan/{kewarganegaraanId}', [PelaporanController::class, 'destroy_kewarganegaraan'])->name('pelaporan.destroy_kewarganegaraan');

    Route::post('/pelaporan/{id}/store-etnis', [PelaporanController::class, 'store_etnis'])->name('pelaporan.store_etnis');
    Route::delete('/pelaporan/{id}/etnis/{etnisId}', [PelaporanController::class, 'destroy_etnis'])->name('pelaporan.destroy_etnis');

    Route::post('/pelaporan/{id}/store-cacat', [PelaporanController::class, 'store_cacat'])->name('pelaporan.store_cacat');
    Route::delete('/pelaporan/{id}/cacat/{cacatId}', [PelaporanController::class, 'destroy_cacat'])->name('pelaporan.destroy_cacat');

    Route::post('/pelaporan/{id}/store-tenagakerja', [PelaporanController::class, 'store_tenagakerja'])->name('pelaporan.store_tenagakerja');
    Route::delete('/pelaporan/{id}/tenagakerja/{tenagakerjaId}', [PelaporanController::class, 'destroy_tenagakerja'])->name('pelaporan.destroy_tenagakerja');

    Route::post('/pelaporan/{id}/store-kualitasangkatankerja', [PelaporanController::class, 'store_kualitasangkatankerja'])->name('pelaporan.store_kualitasangkatankerja');
    Route::delete('/pelaporan/{id}/kualitasangkatankerja/{kualitasangkatankerjaId}', [PelaporanController::class, 'destroy_kualitasangkatankerja'])->name('pelaporan.destroy_kualitasangkatankerja');
    // Route::resource('kepala_lingkungans', App\Http\Controllers\KepalaLingkunganController::class);
    Route::get('/kepala_lingkungans/{id}/biodata', [KepalaLingkunganController::class, 'biodata'])->name('kepala_lingkungans.biodata');
    Route::put('/kepala_lingkungans/{id}/update_biodata', [KepalaLingkunganController::class, 'update_biodata'])->name('kepala_lingkungans.update_biodata');

    Route::get('/users/{id}/reset_password', [UserController::class, 'form_reset_password'])->name('users.form_reset_password');
    Route::put('/users/{id}/change_password', [UserController::class, 'changePassword2'])->name('users.changePassword2');
    Route::get('/cetak-laporan-lingkungan/{id}', [PelaporanController::class, 'cetak_laporan_lingkungan'])->name('cetak_laporan_lingkungan');
    
    
});