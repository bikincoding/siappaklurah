-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Feb 2024 pada 02.28
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lurah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agamas`
--

CREATE TABLE `agamas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laki_laki` int(10) UNSIGNED NOT NULL,
  `perempuan` int(10) UNSIGNED NOT NULL,
  `id_laporan_bulan_tahuns` int(10) UNSIGNED NOT NULL,
  `id_banjars` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `agamas`
--

INSERT INTO `agamas` (`id`, `agama`, `laki_laki`, `perempuan`, `id_laporan_bulan_tahuns`, `id_banjars`, `created_at`, `updated_at`) VALUES
(1, 'Hindu', 345, 1, 1, 13, '2024-01-23 06:34:58', '2024-01-22 22:48:36'),
(3, 'Islam', 335, 456, 1, 13, '2024-01-22 22:49:20', '2024-01-22 22:49:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banjars`
--

CREATE TABLE `banjars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_banjar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banjars`
--

INSERT INTO `banjars` (`id`, `nama_banjar`, `created_at`, `updated_at`) VALUES
(8, 'Batuculung', '2024-01-06 03:51:05', '2024-01-17 00:48:24'),
(9, 'Babakan', '2024-01-06 04:03:54', '2024-01-06 22:05:57'),
(10, 'Beluran', '2024-01-06 22:06:03', '2024-01-06 22:06:03'),
(11, 'Gadon', '2024-01-06 22:06:11', '2024-01-06 22:06:11'),
(12, 'Jambe', '2024-01-06 22:06:31', '2024-01-06 22:06:31'),
(13, 'Batubidak', '2024-01-06 22:06:44', '2024-01-06 22:06:44'),
(14, 'Petingan', '2024-01-06 22:06:53', '2024-01-06 22:06:53'),
(15, 'Muding Mekar', '2024-01-06 22:07:02', '2024-01-06 22:07:02'),
(16, 'Muding Kaja', '2024-01-06 22:07:11', '2024-01-06 22:07:11'),
(17, 'Muding Tengah', '2024-01-06 22:07:17', '2024-01-06 22:07:17'),
(18, 'Muding Kelod', '2024-01-06 22:07:28', '2024-01-06 22:07:28'),
(19, 'Surya Bhuana', '2024-01-06 22:07:38', '2024-01-06 22:07:38'),
(20, 'Tegal Sari', '2024-01-06 22:07:46', '2024-01-06 22:07:46'),
(21, 'Tegal Permai', '2024-01-06 22:07:58', '2024-01-06 22:07:58'),
(22, 'Wira Bhuana', '2024-01-06 22:08:10', '2024-01-06 22:08:10'),
(23, 'Blubuh Sari', '2024-01-06 22:08:19', '2024-01-06 22:08:19'),
(24, 'Bhuana Graha', '2024-01-06 22:08:51', '2024-01-06 22:09:31'),
(25, 'Bhuana Asri', '2024-01-06 22:09:41', '2024-01-06 22:10:01'),
(26, 'Bhuana Shanti', '2024-01-06 22:10:12', '2024-01-06 22:10:12'),
(27, 'Bumi Kerta', '2024-01-06 22:10:20', '2024-01-06 22:10:20'),
(28, 'Bumi Mekar Sari', '2024-01-06 22:10:31', '2024-01-06 22:10:31'),
(29, 'Bhineka Asri', '2024-01-06 22:10:41', '2024-01-06 22:10:41'),
(30, 'Padang Lestari', '2024-01-06 22:10:51', '2024-01-06 22:10:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cacat_mental_fisiks`
--

CREATE TABLE `cacat_mental_fisiks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_cacat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laki_laki` int(10) UNSIGNED NOT NULL,
  `perempuan` int(10) UNSIGNED NOT NULL,
  `id_laporan_bulan_tahuns` int(10) UNSIGNED NOT NULL,
  `id_banjars` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cacat_mental_fisiks`
--

INSERT INTO `cacat_mental_fisiks` (`id`, `jenis_cacat`, `laki_laki`, `perempuan`, `id_laporan_bulan_tahuns`, `id_banjars`, `created_at`, `updated_at`) VALUES
(1, 'Cacat Fisik', 54, 1, 1, 13, NULL, '2024-01-22 23:27:06'),
(3, 'Cacat Sensorik', 347, 326, 1, 13, '2024-01-22 23:27:13', '2024-01-22 23:27:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_dasar_keluargas`
--

CREATE TABLE `data_dasar_keluargas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_kartu_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_banjars` bigint(20) UNSIGNED NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_dasar_keluargas`
--

INSERT INTO `data_dasar_keluargas` (`id`, `no_kartu_keluarga`, `id_banjars`, `alamat`, `created_at`, `updated_at`) VALUES
(1, '5123254545', 8, 'Jl Tegal Dukuh', NULL, NULL),
(3, '5123254547', 15, 'Jl Merpati', '2024-01-07 07:01:27', '2024-01-07 16:27:25'),
(4, '535345435345', 8, 'Jln Tegah Dukuh IX Utara No A3', '2024-01-07 05:11:56', '2024-01-07 05:11:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_dasar_keluarga_details`
--

CREATE TABLE `data_dasar_keluarga_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_data_dasar_keluargas` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'L untuk Laki-laki, P untuk Perempuan',
  `hubungan_dengan_kepala_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `status_perkawinan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_darah` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kewarganegaraan` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etnis_suku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `etniss`
--

CREATE TABLE `etniss` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `etnis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laki_laki` int(10) UNSIGNED NOT NULL,
  `perempuan` int(10) UNSIGNED NOT NULL,
  `id_laporan_bulan_tahuns` int(10) UNSIGNED NOT NULL,
  `id_banjars` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `etniss`
--

INSERT INTO `etniss` (`id`, `etnis`, `laki_laki`, `perempuan`, `id_laporan_bulan_tahuns`, `id_banjars`, `created_at`, `updated_at`) VALUES
(1, 'Bali', 345, 100, 1, 13, '2024-01-23 07:02:19', '2024-01-22 23:10:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepala_lingkungans`
--

CREATE TABLE `kepala_lingkungans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kepala_lingkungan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_banjars` int(11) NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kepala_lingkungans`
--

INSERT INTO `kepala_lingkungans` (`id`, `foto`, `nama_kepala_lingkungan`, `alamat`, `id_banjars`, `telepon`, `created_at`, `updated_at`) VALUES
(1, 'If7zRaHK1tl4WaUh7vfK43C9j9QznmVhaHCVaaDr.jpg', 'I Nyoman Anom Suyogo, A Md', '-', 13, '081338312455', '2024-01-24 22:22:03', '2024-01-25 14:44:41'),
(3, 'itPyYlDg9SLQETpgztHlEsrqfO4UwGpVYvUJlE9k.jpg', 'I Wayan Kardana', '-', 9, '082144998644', '2024-01-25 14:36:50', '2024-01-25 14:44:51'),
(4, 'g5AA5mQRo2VvyP1gCZAbktC5eWYquDy1tFsjFtom.jpg', 'I Putu Sudarta,SE', '-', 24, '082144879930', '2024-01-25 14:37:37', '2024-01-25 14:45:06'),
(5, 'y4PQLwZIOr1LkdhF7fBgWC6ad20NUQCI8nlchhsf.jpg', 'I Nyoman Sudirka, SE', '-', 26, '087761450225', '2024-01-25 14:38:28', '2024-01-25 14:45:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kewarganegaraans`
--

CREATE TABLE `kewarganegaraans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kewarganegaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laki_laki` int(10) UNSIGNED NOT NULL,
  `perempuan` int(10) UNSIGNED NOT NULL,
  `id_laporan_bulan_tahuns` int(10) UNSIGNED NOT NULL,
  `id_banjars` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kewarganegaraans`
--

INSERT INTO `kewarganegaraans` (`id`, `kewarganegaraan`, `laki_laki`, `perempuan`, `id_laporan_bulan_tahuns`, `id_banjars`, `created_at`, `updated_at`) VALUES
(1, 'WNA', 345, 456, 1, 13, '2024-01-23 06:55:09', '2024-01-23 06:55:09'),
(2, 'WNI', 435, 12, 1, 13, '2024-01-22 23:00:26', '2024-01-22 23:01:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kualitas_angkatan_kerjas`
--

CREATE TABLE `kualitas_angkatan_kerjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `angkatan_kerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laki_laki` int(10) UNSIGNED NOT NULL,
  `perempuan` int(10) UNSIGNED NOT NULL,
  `id_laporan_bulan_tahuns` int(10) UNSIGNED NOT NULL,
  `id_banjars` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kualitas_angkatan_kerjas`
--

INSERT INTO `kualitas_angkatan_kerjas` (`id`, `angkatan_kerja`, `laki_laki`, `perempuan`, `id_laporan_bulan_tahuns`, `id_banjars`, `created_at`, `updated_at`) VALUES
(1, 'Penduduk usia 18 - 56 tahun yang buta aksara dan huruf/angka latin', 36, 456, 1, 13, NULL, NULL),
(2, 'Penduduk usia 18 - 56 tahun yang tamat SD', 2, 2, 1, 13, '2024-01-23 00:02:04', '2024-01-23 00:03:52'),
(4, 'Penduduk usia 18 - 56 tahun yang tamat SLTP', 345, 634, 1, 13, '2024-01-25 14:46:09', '2024-01-25 14:46:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_bulan_tahuns`
--

CREATE TABLE `laporan_bulan_tahuns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan_bulan_tahuns`
--

INSERT INTO `laporan_bulan_tahuns` (`id`, `bulan`, `tahun`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '2024', '1', NULL, NULL),
(3, '2', '2024', '1', '2024-01-17 16:42:20', '2024-01-17 17:00:08'),
(4, '3', '2024', '1', '2024-01-17 17:33:20', '2024-01-17 17:33:20'),
(5, '4', '2024', '1', '2024-01-17 17:33:29', '2024-01-17 17:33:29'),
(6, '5', '2024', '1', '2024-01-17 17:33:57', '2024-01-17 17:33:57'),
(7, '6', '2024', '1', '2024-01-18 17:30:27', '2024-01-18 17:30:27'),
(8, '7', '2024', '1', '2024-01-18 17:30:40', '2024-01-18 17:30:40'),
(9, '8', '2024', '1', '2024-01-18 17:30:53', '2024-01-18 17:30:53'),
(10, '9', '2024', '1', '2024-01-18 18:30:40', '2024-01-18 18:30:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pencaharian_pokoks`
--

CREATE TABLE `mata_pencaharian_pokoks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laki_laki` int(10) UNSIGNED NOT NULL,
  `perempuan` int(10) UNSIGNED NOT NULL,
  `id_laporan_bulan_tahuns` int(10) UNSIGNED NOT NULL,
  `id_banjars` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_pencaharian_pokoks`
--

INSERT INTO `mata_pencaharian_pokoks` (`id`, `jenis_pekerjaan`, `laki_laki`, `perempuan`, `id_laporan_bulan_tahuns`, `id_banjars`, `created_at`, `updated_at`) VALUES
(1, 'Pegawai Swasta', 240, 234, 1, 13, '2024-01-22 23:10:45', '2024-01-22 15:18:01'),
(3, 'Guru', 12, 14, 1, 13, '2024-01-22 15:20:36', '2024-01-22 15:20:36'),
(4, 'Pengacara', 1, 0, 1, 13, '2024-01-23 15:06:30', '2024-01-23 15:06:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_02_133442_banjar', 2),
(6, '2014_10_12_100000_create_password_resets_table', 3),
(7, '2024_01_06_132911_add_role_to_users_table', 3),
(8, '2024_01_07_063810_create_data_dasar_keluargas_table', 4),
(9, '2024_01_07_063824_create_data_dasar_keluarga_details_table', 4),
(10, '2024_01_07_070641_add_no_kartu_keluarga_to_data_dasar_keluargas_table', 5),
(11, '2024_01_10_085001_create_sumber_daya_manusias_table', 6),
(12, '2024_01_10_085048_create_pendidikans_table', 6),
(13, '2024_01_10_085115_create_mata_pencaharian_pokoks_table', 6),
(14, '2024_01_10_085123_create_agamas_table', 6),
(15, '2024_01_10_085130_create_kewarganegaraans_table', 6),
(16, '2024_01_10_085136_create_etniss_table', 6),
(17, '2024_01_10_085144_create_cacat_mental_fisiks_table', 6),
(18, '2024_01_10_085151_create_tenaga_kerjas_table', 6),
(19, '2024_01_10_085201_create_kualitas_angkatan_kerjas_table', 6),
(20, '2024_01_10_085209_create_laporan_bulan_tahuns_table', 6),
(21, '2024_01_17_001049_add_id_banjars_to_users_table', 6),
(22, '2024_01_17_003431_create_laporan_bulan_tahuns_table', 7),
(23, '2024_01_19_062645_create_pegawais_table', 8),
(24, '2024_01_21_041400_add_columns_to_pendidikans_table', 9),
(25, '2024_01_21_041654_add_columns_to_mata_pencaharian_pokoks_table', 10),
(26, '2024_01_21_041859_add_columns_to_agamas_table', 11),
(27, '2024_01_21_042112_add_columns_to_kewarganegaraans_table', 12),
(28, '2024_01_21_042305_add_columns_to_etniss_table', 13),
(29, '2024_01_21_042517_add_columns_to_cacat_mental_fisiks_table', 14),
(30, '2024_01_21_042918_add_columns_to_tenaga_kerjas_table', 15),
(31, '2024_01_21_043243_add_columns_to_kualitas_angkatan_kerjas_table', 16),
(32, '2024_01_25_052718_create_kepala_lingkungan_table', 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_karpeg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rek` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_darah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawais`
--

INSERT INTO `pegawais` (`id`, `foto_pegawai`, `nama_pegawai`, `nip`, `jabatan`, `pangkat_golongan`, `alamat`, `tgl_lahir`, `no_ktp`, `npwp`, `no_karpeg`, `no_rek`, `email`, `telp`, `golongan_darah`, `created_at`, `updated_at`) VALUES
(4, '1705713785_igan marhaena yasana putra.jpg', 'I G.A.N. Marhaena Yasana Putra, S.STP., M.A.P.', '198703012006021001', 'Lurah', 'Penata Tk. I,  (III/d)', 'Jl. Pantai Pererenan No. 37 Br. Jempinis Pererenan, Mengwi - Badung', '2024-01-16', '1234567890123455', '345565', '3453', '3453', 'yasanaputra@gmail.com', '081236627887', 'AB', '2024-01-19 01:51:02', '2024-01-19 17:28:50'),
(5, '1705714998_drs i gusti agung komang wibawa.jpg', 'Drs. I Gusti Agung Komang Wibawa', '196704051992031008', 'Sekretaris Lurah', 'Penata Tk. I,  (III/d)', 'Jl. Oleg, Gg. Jepun A7, Br. Dajan Peken Ds. Penarungan - Badung', '1967-04-05', '5103060504670005', '470602913901000', 'E 990538', '0090212012113', 'wibawaagung67@gmail.com', '082145338850', 'O', '2024-01-19 17:31:23', '2024-01-19 17:43:18'),
(6, '1705715472_gusti putu antoni, se.jpg', 'Gusti Putu Antoni, SE.', '196902281993031014', 'Kasi Pemerintahan', 'Penata Tk. I,  (III/d)', 'Br. Kwanji, Kel. Sempidi Kec. Mengwi Badung', '1969-02-28', '5103022802690006', '471572693906000', 'G 009375', '009.02.12.01213-7', 'ant0n1gstpt@gmail.com', '087860080044', 'O', '2024-01-19 17:51:12', '2024-01-19 17:51:12'),
(7, '1705716378_i gusti agung rai sridewi. se.jpg', 'I Gusti Agung Rai Sri Dewi, SE', '197805232000032004', 'Kasi Pembangunan', 'Penata Tk. I,  (III/d)', 'Jl. I Gst. Ngr. Rai No 76, Ds. Mengwi, Kec. Mengwi-Badung', '1978-05-23', '5103026305780001', '144033917906000', 'J 136634', '026.02.15.00162-0', 'sridewirai@gmail.com', '081239585097', 'O', '2024-01-19 18:06:18', '2024-01-19 18:06:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendidikans`
--

CREATE TABLE `pendidikans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tingkatan_pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laki_laki` int(10) UNSIGNED NOT NULL,
  `perempuan` int(10) UNSIGNED NOT NULL,
  `id_laporan_bulan_tahuns` int(10) UNSIGNED NOT NULL,
  `id_banjars` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pendidikans`
--

INSERT INTO `pendidikans` (`id`, `tingkatan_pendidikan`, `laki_laki`, `perempuan`, `id_laporan_bulan_tahuns`, `id_banjars`, `created_at`, `updated_at`) VALUES
(1, 'Usia 3 - 6 tahun yang belum masuk TK', 3, 10, 1, 13, '2024-01-21 04:50:46', '2024-01-22 14:48:35'),
(8, 'Usia 3 - 6 tahun yang sedang TK/play group', 345, 345, 1, 13, '2024-01-22 14:48:41', '2024-01-22 14:48:41'),
(9, 'Usia 7 - 18 tahun yang sedang sekolah', 345, 534, 1, 13, '2024-01-22 14:48:47', '2024-01-22 14:48:47'),
(10, 'Tamat S2/sederajat', 18, 15, 1, 13, '2024-01-25 18:40:49', '2024-01-25 18:40:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumber_daya_manusias`
--

CREATE TABLE `sumber_daya_manusias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_laki_laki` int(11) NOT NULL,
  `jumlah_perempuan` int(11) NOT NULL,
  `jumlah_total` int(11) NOT NULL,
  `jumlah_kepala_keluarga` int(11) NOT NULL,
  `kepadatan_penduduk` int(11) NOT NULL,
  `id_laporan_bulan_tahuns` int(11) NOT NULL,
  `id_banjars` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sumber_daya_manusias`
--

INSERT INTO `sumber_daya_manusias` (`id`, `jumlah_laki_laki`, `jumlah_perempuan`, `jumlah_total`, `jumlah_kepala_keluarga`, `kepadatan_penduduk`, `id_laporan_bulan_tahuns`, `id_banjars`, `created_at`, `updated_at`) VALUES
(1, 123, 200, 323, 200, 30, 1, 13, NULL, '2024-01-25 18:40:08'),
(2, 50, 345, 675, 23, 43, 3, 13, NULL, '2024-01-18 02:29:07'),
(4, 109, 0, 0, 0, 0, 4, 13, '2024-01-18 02:48:11', '2024-01-18 02:48:11'),
(5, 50, 50, 50, 34, 70, 1, 10, '2024-01-18 02:49:49', '2024-01-18 17:29:12'),
(6, 90, 90, 90, 90, 90, 3, 10, '2024-01-18 17:29:34', '2024-01-18 17:29:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tenaga_kerjas`
--

CREATE TABLE `tenaga_kerjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenaga_kerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laki_laki` int(10) UNSIGNED NOT NULL,
  `perempuan` int(10) UNSIGNED NOT NULL,
  `id_laporan_bulan_tahuns` int(10) UNSIGNED NOT NULL,
  `id_banjars` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tenaga_kerjas`
--

INSERT INTO `tenaga_kerjas` (`id`, `tenaga_kerja`, `laki_laki`, `perempuan`, `id_laporan_bulan_tahuns`, `id_banjars`, `created_at`, `updated_at`) VALUES
(2, 'Penduduk usia 18 - 56 tahun yang bekerja', 22, 33, 1, 13, '2024-01-22 23:43:36', '2024-01-22 23:46:10'),
(3, 'Penduduk usia 18 - 56 tahun yang belum atau tidak bekerja', 234, 53, 1, 13, '2024-01-22 23:46:16', '2024-01-22 23:46:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_banjars` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_banjars`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 13, 'Ade Pranata', 'adehpo@gmail.com', NULL, '$2y$12$BMwu6HyuMFZ7.O3nN04oU.G5i/W3vS8qmwiwy9rAoPhB36hfgGliu', NULL, '2024-01-02 06:14:40', '2024-01-02 06:14:40', 'user'),
(3, 24, 'Yoko Damaro', 'yoko@gmail.com', NULL, '$2y$12$P2/gQv62fTzBuqU2pWyG1udvosFIsnKa2N4MBS9ONZy0pkSiapxb.', 'wPKcQ2cdJhQwj11WKwZTvsHtVWZMnRv2v7dADCGpqMldOH04XIc9WrB1l9KE', '2024-01-06 19:05:49', '2024-01-24 20:59:04', 'admin'),
(4, 10, 'Gyan Vigyani', 'gyan@gmail.com', NULL, '$2y$12$UzumhhqsHHTH1O/19DI3wuuujFmZdu8dflkTBxi2o1I6g68sQXlC6', NULL, '2024-01-06 19:12:01', '2024-01-06 19:12:01', 'user'),
(5, 14, 'Sintya Putri', 'sintya@gmail.com', NULL, '$2y$12$KFx.C.elkJ/D7EQBcQVLtOuXyJlcGtqDanYH9EG5dDj1PloAKtueG', NULL, '2024-01-06 19:18:16', '2024-01-06 19:18:16', 'user'),
(6, 18, 'Joko Anwar', 'joko@gmail.com', NULL, '$2y$12$bpQSAghwoVA.el2CwxaPNOS/UqC382myLnIrw8unB8RjAusv4aOLe', NULL, '2024-01-06 19:20:37', '2024-01-06 19:20:37', 'user'),
(7, 30, 'Prajuru Awan', 'awan@gmail.com', NULL, '$2y$12$MvtYEh0uPPw/SABtsGQd3.BEAVMhTi9IzxNu8BftPOwcHtZyMYeUS', NULL, '2024-01-06 19:21:14', '2024-01-06 19:21:14', 'admin'),
(8, 27, 'sinto', 'sinto@gmail.com', NULL, '$2y$12$JCq75naEtgBZRGY2jJceJ.MiR.1Ngq17TKnsk.ot59PI3M08KdiZy', NULL, '2024-01-07 15:53:59', '2024-01-07 15:54:46', 'admin'),
(9, 25, 'Rama Jaya', 'rama@gmail.com', NULL, '$2y$12$3Fdcq2fPgZcLeZA6NK5j6.kowujE4aPbKOY/lgZimyJ6sAD4cZB26', NULL, '2024-01-07 17:08:36', '2024-01-17 01:22:32', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usias`
--

CREATE TABLE `usias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laki_laki` int(11) NOT NULL,
  `perempuan` int(11) NOT NULL,
  `id_laporan_bulan_tahuns` bigint(20) UNSIGNED NOT NULL,
  `id_banjars` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `usias`
--

INSERT INTO `usias` (`id`, `usia`, `laki_laki`, `perempuan`, `id_laporan_bulan_tahuns`, `id_banjars`, `created_at`, `updated_at`) VALUES
(1, '0 - 12 Bulan', 30, 40, 1, 13, NULL, NULL),
(2, '1', 2, 2, 1, 13, '2024-01-20 03:07:04', '2024-01-20 20:03:06'),
(3, '2', 45, 34, 1, 13, '2024-01-20 03:07:19', '2024-01-20 03:07:19'),
(4, '0 - 12 Bulan', 65, 76, 3, 13, '2024-01-20 03:08:39', '2024-01-20 03:08:39'),
(7, '1', 345, 786, 3, 13, '2024-01-20 04:37:19', '2024-01-20 04:37:19'),
(10, '3', 34, 45, 1, 13, '2024-01-25 14:46:56', '2024-01-25 14:46:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agamas`
--
ALTER TABLE `agamas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `banjars`
--
ALTER TABLE `banjars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cacat_mental_fisiks`
--
ALTER TABLE `cacat_mental_fisiks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_dasar_keluargas`
--
ALTER TABLE `data_dasar_keluargas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_dasar_keluargas_no_kartu_keluarga_unique` (`no_kartu_keluarga`),
  ADD KEY `data_dasar_keluargas_id_banjars_foreign` (`id_banjars`);

--
-- Indeks untuk tabel `data_dasar_keluarga_details`
--
ALTER TABLE `data_dasar_keluarga_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_dasar_keluarga_details_id_data_dasar_keluargas_foreign` (`id_data_dasar_keluargas`);

--
-- Indeks untuk tabel `etniss`
--
ALTER TABLE `etniss`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kepala_lingkungans`
--
ALTER TABLE `kepala_lingkungans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kewarganegaraans`
--
ALTER TABLE `kewarganegaraans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kualitas_angkatan_kerjas`
--
ALTER TABLE `kualitas_angkatan_kerjas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_bulan_tahuns`
--
ALTER TABLE `laporan_bulan_tahuns`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_pencaharian_pokoks`
--
ALTER TABLE `mata_pencaharian_pokoks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawais_nip_unique` (`nip`),
  ADD UNIQUE KEY `pegawais_no_ktp_unique` (`no_ktp`),
  ADD UNIQUE KEY `pegawais_email_unique` (`email`),
  ADD UNIQUE KEY `pegawais_npwp_unique` (`npwp`),
  ADD UNIQUE KEY `pegawais_no_karpeg_unique` (`no_karpeg`),
  ADD UNIQUE KEY `pegawais_no_rek_unique` (`no_rek`);

--
-- Indeks untuk tabel `pendidikans`
--
ALTER TABLE `pendidikans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `sumber_daya_manusias`
--
ALTER TABLE `sumber_daya_manusias`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tenaga_kerjas`
--
ALTER TABLE `tenaga_kerjas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_banjars_foreign` (`id_banjars`);

--
-- Indeks untuk tabel `usias`
--
ALTER TABLE `usias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agamas`
--
ALTER TABLE `agamas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `banjars`
--
ALTER TABLE `banjars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `cacat_mental_fisiks`
--
ALTER TABLE `cacat_mental_fisiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_dasar_keluargas`
--
ALTER TABLE `data_dasar_keluargas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_dasar_keluarga_details`
--
ALTER TABLE `data_dasar_keluarga_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `etniss`
--
ALTER TABLE `etniss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kepala_lingkungans`
--
ALTER TABLE `kepala_lingkungans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kewarganegaraans`
--
ALTER TABLE `kewarganegaraans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kualitas_angkatan_kerjas`
--
ALTER TABLE `kualitas_angkatan_kerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `laporan_bulan_tahuns`
--
ALTER TABLE `laporan_bulan_tahuns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mata_pencaharian_pokoks`
--
ALTER TABLE `mata_pencaharian_pokoks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pendidikans`
--
ALTER TABLE `pendidikans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sumber_daya_manusias`
--
ALTER TABLE `sumber_daya_manusias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tenaga_kerjas`
--
ALTER TABLE `tenaga_kerjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `usias`
--
ALTER TABLE `usias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_dasar_keluargas`
--
ALTER TABLE `data_dasar_keluargas`
  ADD CONSTRAINT `data_dasar_keluargas_id_banjars_foreign` FOREIGN KEY (`id_banjars`) REFERENCES `banjars` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_dasar_keluarga_details`
--
ALTER TABLE `data_dasar_keluarga_details`
  ADD CONSTRAINT `data_dasar_keluarga_details_id_data_dasar_keluargas_foreign` FOREIGN KEY (`id_data_dasar_keluargas`) REFERENCES `data_dasar_keluargas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_banjars_foreign` FOREIGN KEY (`id_banjars`) REFERENCES `banjars` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
