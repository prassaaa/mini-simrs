-- phpMyAdmin SQL Dump
-- version 5.2.3-1.fc42.remi
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 20, 2025 at 02:53 AM
-- Server version: 10.11.11-MariaDB
-- PHP Version: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini-simrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-66306017ff8d4559daee920f211855a6', 'i:1;', 1763605715),
('laravel-cache-66306017ff8d4559daee920f211855a6:timer', 'i:1763605715;', 1763605715);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksis`
--

CREATE TABLE `detail_transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `nama_tindakan` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksis`
--

INSERT INTO `detail_transaksis` (`id`, `no_transaksi`, `nama_tindakan`, `harga`, `qty`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 'TRX-20251120022649', 'Konsultasi Dokter', 150000.00, 1, 150000.00, '2025-11-19 19:26:49', '2025-11-19 19:26:49'),
(2, 'TRX-20251120022649', 'Pemeriksaan Lab', 200000.00, 1, 200000.00, '2025-11-19 19:26:49', '2025-11-19 19:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kunjungans`
--

CREATE TABLE `kunjungans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_registrasi_kunjungan` varchar(255) NOT NULL,
  `no_rm` varchar(255) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `kode_dokter` varchar(255) NOT NULL,
  `poli` varchar(255) NOT NULL,
  `instalasi` enum('Rawat Jalan','IGD','Rawat Inap') NOT NULL,
  `penjamin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kunjungans`
--

INSERT INTO `kunjungans` (`id`, `no_registrasi_kunjungan`, `no_rm`, `tanggal_kunjungan`, `kode_dokter`, `poli`, `instalasi`, `penjamin_id`, `created_at`, `updated_at`) VALUES
(1, '20251120022620', 'RM-2025-0001', '2025-11-20', 'DOK-001', 'POLI-UMUM', 'Rawat Jalan', 1, '2025-11-19 19:26:20', '2025-11-19 19:26:20'),
(3, '20251120024210', 'RM-2025-0002', '2025-11-20', 'DOK-002', 'POLI-ANAK', 'Rawat Jalan', 2, '2025-11-19 19:42:10', '2025-11-19 19:42:10'),
(4, '20251120024405', 'RM-2025-0002', '2025-11-20', 'DOK-001', 'POLI-UMUM', 'Rawat Jalan', 1, '2025-11-19 19:44:05', '2025-11-19 19:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `master_dokters`
--

CREATE TABLE `master_dokters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_dokter` varchar(255) NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `spesialisasi` varchar(255) NOT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_dokters`
--

INSERT INTO `master_dokters` (`id`, `kode_dokter`, `nama_dokter`, `spesialisasi`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'DOK-001', 'dr. Ahmad Fauzi, Sp.PD', 'Spesialis Penyakit Dalam', '081234567801', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(2, 'DOK-002', 'dr. Siti Nurhaliza, Sp.A', 'Spesialis Anak', '081234567802', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(3, 'DOK-003', 'dr. Budi Santoso, Sp.OG', 'Spesialis Kandungan & Kebidanan', '081234567803', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(4, 'DOK-004', 'drg. Dewi Lestari, Sp.KG', 'Spesialis Konservasi Gigi', '081234567804', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(5, 'DOK-005', 'dr. Eko Prasetyo, Sp.M', 'Spesialis Mata', '081234567805', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(6, 'DOK-006', 'dr. Fitri Handayani, Sp.THT', 'Spesialis THT', '081234567806', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(7, 'DOK-007', 'dr. Gunawan Wijaya, Sp.JP', 'Spesialis Jantung dan Pembuluh Darah', '081234567807', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(8, 'DOK-008', 'dr. Hendra Kusuma, Sp.P', 'Spesialis Paru', '081234567808', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(9, 'DOK-009', 'dr. Indah Permata, Sp.S', 'Spesialis Saraf', '081234567809', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(10, 'DOK-010', 'dr. Joko Widodo, Sp.KK', 'Spesialis Kulit dan Kelamin', '081234567810', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(11, 'DOK-011', 'dr. Kartika Sari, Sp.B', 'Spesialis Bedah', '081234567811', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(12, 'DOK-012', 'dr. Lukman Hakim, Sp.OT', 'Spesialis Ortopedi', '081234567812', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(13, 'DOK-013', 'dr. Maya Anggraini', 'Dokter Umum', '081234567813', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(14, 'DOK-014', 'dr. Nurul Hidayah', 'Dokter Umum', '081234567814', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(15, 'DOK-015', 'dr. Oki Setiawan, Sp.KJ', 'Spesialis Kesehatan Jiwa', '081234567815', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(16, 'DOK-016', 'dr. Putri Maharani, M.Gizi', 'Spesialis Gizi Klinik', '081234567816', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(17, 'DOK-017', 'dr. Raden Mas Surya', 'Dokter Umum', '081234567817', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(18, 'DOK-018', 'dr. Sri Mulyani, Sp.PD', 'Spesialis Penyakit Dalam', '081234567818', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(19, 'DOK-019', 'dr. Taufik Hidayat, Sp.A', 'Spesialis Anak', '081234567819', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(20, 'DOK-020', 'dr. Umi Kalsum', 'Dokter Umum', '081234567820', '2025-11-19 19:26:07', '2025-11-19 19:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `master_penjamins`
--

CREATE TABLE `master_penjamins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_penjamin` varchar(255) NOT NULL,
  `nama_penjamin` varchar(255) NOT NULL,
  `jenis` enum('BPJS','Umum','Asuransi') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_penjamins`
--

INSERT INTO `master_penjamins` (`id`, `kode_penjamin`, `nama_penjamin`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'BPJS-KES', 'BPJS Kesehatan', 'BPJS', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(2, 'UMUM', 'Umum / Tunai', 'Umum', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(3, 'BPJS-TK', 'BPJS Ketenagakerjaan', 'BPJS', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(4, 'PRUDENTIAL', 'Prudential Indonesia', 'Asuransi', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(5, 'ALLIANZ', 'Allianz Indonesia', 'Asuransi', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(6, 'MANDIRI-INHEALTH', 'Mandiri Inhealth', 'Asuransi', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(7, 'AXA', 'AXA Mandiri', 'Asuransi', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(8, 'MANULIFE', 'Manulife Indonesia', 'Asuransi', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(9, 'JAMSOSTEK', 'Jamsostek', 'BPJS', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(10, 'ASKES', 'Askes (PT Askes Indonesia)', 'Asuransi', '2025-11-19 19:26:07', '2025-11-19 19:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `master_polis`
--

CREATE TABLE `master_polis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_poli` varchar(255) NOT NULL,
  `nama_poli` varchar(255) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_polis`
--

INSERT INTO `master_polis` (`id`, `kode_poli`, `nama_poli`, `lokasi`, `created_at`, `updated_at`) VALUES
(1, 'POLI-UMUM', 'Poli Umum', 'Gedung A Lantai 1', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(2, 'POLI-ANAK', 'Poli Anak', 'Gedung A Lantai 2', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(3, 'POLI-KANDUNGAN', 'Poli Kandungan & Kebidanan', 'Gedung B Lantai 1', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(4, 'POLI-GIGI', 'Poli Gigi', 'Gedung A Lantai 1', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(5, 'POLI-MATA', 'Poli Mata', 'Gedung B Lantai 2', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(6, 'POLI-THT', 'Poli THT (Telinga Hidung Tenggorokan)', 'Gedung B Lantai 2', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(7, 'POLI-JANTUNG', 'Poli Jantung', 'Gedung C Lantai 1', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(8, 'POLI-PARU', 'Poli Paru', 'Gedung C Lantai 1', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(9, 'POLI-SARAF', 'Poli Saraf (Neurologi)', 'Gedung C Lantai 2', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(10, 'POLI-KULIT', 'Poli Kulit & Kelamin', 'Gedung B Lantai 1', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(11, 'POLI-BEDAH', 'Poli Bedah', 'Gedung C Lantai 2', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(12, 'POLI-ORTOPEDI', 'Poli Ortopedi (Tulang)', 'Gedung C Lantai 3', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(13, 'POLI-DALAM', 'Poli Penyakit Dalam', 'Gedung A Lantai 2', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(14, 'POLI-JIWA', 'Poli Kesehatan Jiwa', 'Gedung D Lantai 1', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(15, 'POLI-GIZI', 'Poli Gizi', 'Gedung A Lantai 1', '2025-11-19 19:26:07', '2025-11-19 19:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_26_100418_add_two_factor_columns_to_users_table', 1),
(5, '2025_11_20_004029_create_personal_access_tokens_table', 1),
(6, '2025_11_20_005157_create_pasiens_table', 1),
(7, '2025_11_20_011630_create_master_dokters_table', 1),
(8, '2025_11_20_011754_create_master_polis_table', 1),
(9, '2025_11_20_011923_create_master_penjamins_table', 1),
(10, '2025_11_20_012029_create_kunjungans_table', 1),
(11, '2025_11_20_014229_create_transaksis_table', 1),
(12, '2025_11_20_014230_create_detail_transaksis_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasiens`
--

CREATE TABLE `pasiens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_rm` varchar(255) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pasiens`
--

INSERT INTO `pasiens` (`id`, `no_rm`, `nama_pasien`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'RM-2025-0001', 'Budi Santoso', '1985-03-15', 'L', 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(2, 'RM-2025-0002', 'Siti Nurhaliza', '1990-07-22', 'P', 'Jl. Gatot Subroto No. 45, Bandung, Jawa Barat', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(3, 'RM-2025-0003', 'Ahmad Fauzi', '1978-11-08', 'L', 'Jl. Diponegoro No. 67, Surabaya, Jawa Timur', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(4, 'RM-2025-0004', 'Dewi Lestari', '1995-05-30', 'P', 'Jl. Ahmad Yani No. 89, Semarang, Jawa Tengah', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(5, 'RM-2025-0005', 'Eko Prasetyo', '1982-09-12', 'L', 'Jl. Malioboro No. 12, Yogyakarta, DI Yogyakarta', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(6, 'RM-2025-0006', 'Fitri Handayani', '1988-02-18', 'P', 'Jl. Pahlawan No. 34, Medan, Sumatera Utara', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(7, 'RM-2025-0007', 'Gunawan Wijaya', '1975-12-25', 'L', 'Jl. Veteran No. 56, Makassar, Sulawesi Selatan', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(8, 'RM-2025-0008', 'Hendra Kusuma', '1992-06-14', 'L', 'Jl. Gajah Mada No. 78, Denpasar, Bali', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(9, 'RM-2025-0009', 'Indah Permata Sari', '1987-04-09', 'P', 'Jl. Thamrin No. 90, Palembang, Sumatera Selatan', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(10, 'RM-2025-0010', 'Joko Widodo', '1980-08-20', 'L', 'Jl. Pemuda No. 101, Solo, Jawa Tengah', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(11, 'RM-2025-0011', 'Kartika Putri', '1993-10-05', 'P', 'Jl. Merdeka No. 23, Bogor, Jawa Barat', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(12, 'RM-2025-0012', 'Lukman Hakim', '1984-01-17', 'L', 'Jl. Kartini No. 45, Tangerang, Banten', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(13, 'RM-2025-0013', 'Maya Anggraini', '1991-07-28', 'P', 'Jl. Hasanuddin No. 67, Bekasi, Jawa Barat', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(14, 'RM-2025-0014', 'Nurul Hidayah', '1986-03-11', 'P', 'Jl. Imam Bonjol No. 89, Depok, Jawa Barat', '2025-11-19 19:26:07', '2025-11-19 19:26:07'),
(15, 'RM-2025-0015', 'Oki Setiawan', '1979-11-23', 'L', 'Jl. Cendrawasih No. 12, Balikpapan, Kalimantan Timur', '2025-11-19 19:26:07', '2025-11-19 19:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('n9Rvn8Hs5hqYzq2M302bt4DcU4F3lk9Db1GNWjCs', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZm14YTNkN09XVkg0dWNhTkNKWlY5Y25jNE5BNUJKaFRYOGdEd1pkRSI7czozOiJ1cmwiO2E6MDp7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9fQ==', 1763607139);

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `no_registrasi_kunjungan` varchar(255) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `no_transaksi`, `no_registrasi_kunjungan`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 'TRX-20251120022649', '20251120022620', 350000.00, '2025-11-19 19:26:49', '2025-11-19 19:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin RS', 'admin@simrs.com', '2025-11-19 19:26:06', '$2y$12$VG6Gk5VBMQkg9XEJ2TfMh.PpP8T/he7F/M8ktFDONtbooiOYmaHNK', NULL, NULL, NULL, NULL, '2025-11-19 19:26:07', '2025-11-19 19:26:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_transaksis_no_transaksi_foreign` (`no_transaksi`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kunjungans`
--
ALTER TABLE `kunjungans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kunjungans_no_registrasi_kunjungan_unique` (`no_registrasi_kunjungan`),
  ADD KEY `kunjungans_no_rm_foreign` (`no_rm`),
  ADD KEY `kunjungans_kode_dokter_foreign` (`kode_dokter`),
  ADD KEY `kunjungans_poli_foreign` (`poli`),
  ADD KEY `kunjungans_penjamin_id_foreign` (`penjamin_id`);

--
-- Indexes for table `master_dokters`
--
ALTER TABLE `master_dokters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_dokters_kode_dokter_unique` (`kode_dokter`);

--
-- Indexes for table `master_penjamins`
--
ALTER TABLE `master_penjamins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_penjamins_kode_penjamin_unique` (`kode_penjamin`);

--
-- Indexes for table `master_polis`
--
ALTER TABLE `master_polis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_polis_kode_poli_unique` (`kode_poli`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pasiens_no_rm_unique` (`no_rm`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksis_no_transaksi_unique` (`no_transaksi`),
  ADD KEY `transaksis_no_registrasi_kunjungan_foreign` (`no_registrasi_kunjungan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kunjungans`
--
ALTER TABLE `kunjungans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_dokters`
--
ALTER TABLE `master_dokters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `master_penjamins`
--
ALTER TABLE `master_penjamins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_polis`
--
ALTER TABLE `master_polis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD CONSTRAINT `detail_transaksis_no_transaksi_foreign` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksis` (`no_transaksi`) ON DELETE CASCADE;

--
-- Constraints for table `kunjungans`
--
ALTER TABLE `kunjungans`
  ADD CONSTRAINT `kunjungans_kode_dokter_foreign` FOREIGN KEY (`kode_dokter`) REFERENCES `master_dokters` (`kode_dokter`) ON DELETE CASCADE,
  ADD CONSTRAINT `kunjungans_no_rm_foreign` FOREIGN KEY (`no_rm`) REFERENCES `pasiens` (`no_rm`) ON DELETE CASCADE,
  ADD CONSTRAINT `kunjungans_penjamin_id_foreign` FOREIGN KEY (`penjamin_id`) REFERENCES `master_penjamins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kunjungans_poli_foreign` FOREIGN KEY (`poli`) REFERENCES `master_polis` (`kode_poli`) ON DELETE CASCADE;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_no_registrasi_kunjungan_foreign` FOREIGN KEY (`no_registrasi_kunjungan`) REFERENCES `kunjungans` (`no_registrasi_kunjungan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
