-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2021 at 09:05 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gmkorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gambar_produk`
--

CREATE TABLE `gambar_produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(100) DEFAULT NULL,
  `nama` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gambar_produk`
--

INSERT INTO `gambar_produk` (`id`, `kode_produk`, `nama`) VALUES
(14, 'asdfsdf', '1611488237-11.jpg'),
(15, 'asdfsdf', '1611488237-10.jpg'),
(16, 'asdfsdf', '1611488237-9.jpg'),
(17, 'baju0000001', '1615468249-diagram-level-1.3.png'),
(18, 'baju0000001', '1615468249-proposal---diagram-context.png'),
(19, 'baju0000001', '1615468249-proposal---diagram-level-0-(1).png');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `status` enum('Aktif','Non Aktif') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`id`, `nama`, `slug`, `gambar`, `status`) VALUES
(1, 'Kaos Polos', 'kaos-polos', '1614399062-1568615155-09_polos_02.png', 'Aktif'),
(2, 'KEMEJA MOTIF', 'kemeja-motif', '1614399094-1582345057-gmk_kemeja_m9.jpeg', 'Aktif'),
(3, 'Celana Cinos', 'celana-cinos', '1616233409-men.jpg', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `log_admin`
--

CREATE TABLE `log_admin` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jam_login` time DEFAULT NULL,
  `jam_logout` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_admin`
--

INSERT INTO `log_admin` (`id`, `user_id`, `tgl`, `jam_login`, `jam_logout`) VALUES
(13, 1, '2021-03-23', '15:50:41', '20:50:52'),
(14, 1, '2021-03-23', '20:51:34', '20:52:17'),
(15, 1, '2021-03-23', '21:37:39', '22:38:39'),
(16, 5, '2021-03-23', '22:38:50', NULL),
(17, 1, '2021-03-30', '08:08:35', NULL),
(18, 1, '2021-04-02', '19:13:02', '19:19:19'),
(19, 5, '2021-04-02', '19:19:33', NULL),
(20, 1, '2021-04-03', '10:36:46', '12:01:46'),
(21, 5, '2021-04-03', '12:02:37', NULL),
(22, 1, '2021-04-03', '20:26:03', '22:33:01'),
(23, 5, '2021-04-03', '22:33:16', NULL),
(24, 1, '2021-04-04', '12:40:52', '14:03:23'),
(25, 1, '2021-04-04', '14:02:47', '14:03:23'),
(26, 1, '2021-04-04', '14:03:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_06_30_022914_create_pengguna_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `nama`, `email`, `telp`, `gambar`, `alamat`, `password`, `remember_token`) VALUES
(2, 'deva', 'deva', 'satriosuklun@gmail.com', '08230', '1611149584-sicuan-1.jpeg', 'gurah', '$2y$10$.f2D5qmNHfh4lB3SkcXXueOr9KouCRdhcTOLOWOOdTBEN8wnkvBEG', NULL),
(3, 'devasatrio', 'halo', 'satriosuklun2@gmail.com', '038092', '1615287675-hasil-1.jpg', 'gurah', '$2y$10$h8Y9pOc7xXtVJ9Vw2JWDXui1l12MJLF3B4TyNVUL9Np8RQCmzHymW', NULL),
(4, 'hadi', 'hadi', NULL, '03842', NULL, 'mojoroto', NULL, NULL),
(5, 'ikwan', 'ikwan', NULL, '0320923', NULL, 'gurah', NULL, NULL),
(6, 'joni', 'joni', NULL, '9238902', NULL, 'bringin', NULL, NULL),
(7, 'hadi', 'hadi', NULL, '03842', NULL, 'mojoroto', NULL, NULL),
(8, 'nina', 'nina', NULL, '0948092809', NULL, 'gurah', '$2y$10$Co53GaKX0E1x34rreL.MkeuJVvVdPXKSiDfX8LDSA5sIJS.yuwj4O', NULL),
(9, 'muslim', 'muslim', NULL, '09258092', NULL, 'gurah', '$2y$10$3virX8MxQ8vQt30qr7.uHe1pLZp8zV1C.fgjUZmpkLScbCL.vnZ2W', NULL),
(10, 'JUNET', 'JUNET', NULL, '324567545', NULL, NULL, '$2y$10$RyRxcTABDQp85xLH//FMGeHrJ107UxrSe5TdH0RXT6N2hMxjZ0Dj2', NULL),
(11, 'Bandi', 'Bandi', NULL, '02948209802', NULL, NULL, '$2y$10$9bBo69OVvqxcO9nCX/LBEOjXarGfPqO9DH6qQbF7zz6qK3pkhTlp.', NULL),
(12, 'doni', 'doni', 'doni@gmail.com', '8126737919', NULL, 'gurah', NULL, NULL),
(13, 'hadi', 'hadi', 'hadi@gmail.com', '8126737919', NULL, 'gurah', NULL, NULL),
(14, 'yusup', 'yusup', 'yusup@gmail.com', '9023809', NULL, 'gurah', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) NOT NULL,
  `kode` text DEFAULT NULL,
  `kategori_produk` int(11) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar_utama` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `status` enum('Aktif','Non Aktif','Habis') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode`, `kategori_produk`, `nama`, `deskripsi`, `gambar_utama`, `slug`, `status`) VALUES
(8, 'brg02', 2, 'JAKET POLOS', 'asdfj', '1614514533-1571027178-grosirmurahkediri_kb_amarilly_14102019.jpeg', 'jaket-polos', 'Non Aktif'),
(15, 'Brg0005', 2, 'KEMEJA MOTIF', 'KEMEJA ENAK DIPAKAI', '1614365348-1571027287-grosirmurahkediri_kb_chicorium_14102019.jpeg', 'kemeja-motif', 'Habis'),
(16, 'Brg0004', 2, 'Jaket HOODIE', 'asdfj', '1614514552-1571027545-grosirmurahkediri_kb_longviolla_14102019.jpeg', 'jaket-hoodie', 'Aktif'),
(17, 'Brg0006', 1, 'Jaket Parka', 'asdfj', '1614365248-1575526138-grosir_murah_kediri_lumino_06_122019.jpeg', 'jaket-parka', 'Aktif'),
(18, 'asdfsdf', 2, 'KAOS SALUR', 'Kaos salur motif salur', '1614365198-1571217715-grosir_murah_kediri_ks3_05102019.jpeg', 'kaos-salur', 'Habis'),
(19, 'kjsfkj', 2, 'KAOS SALUR', 'Kaos salur motif salur', '1614365198-1571217715-grosir_murah_kediri_ks3_05102019.jpeg', 'kaos-salur', 'Aktif'),
(20, 'Brg0008', 2, 'KEMEJA MOTIF', 'asdfj', '1614365348-1571027287-grosirmurahkediri_kb_chicorium_14102019.jpeg', 'kemeja-motif', 'Aktif'),
(21, 'Brg0004', 2, 'Jaket HOODIE', 'asdfj', '1614514552-1571027545-grosirmurahkediri_kb_longviolla_14102019.jpeg', 'jaket-hoodie', 'Aktif'),
(22, 'Brg0006', 1, 'Jaket Parka', 'asdfj', '1614365248-1575526138-grosir_murah_kediri_lumino_06_122019.jpeg', 'jaket-parka', 'Aktif'),
(23, 'brg02', 2, 'JAKET POLOS', 'asdfj', '1614514533-1571027178-grosirmurahkediri_kb_amarilly_14102019.jpeg', 'jaket-polos', 'Aktif'),
(24, 'baju0000001', 1, 'asdfsadf', 'sdfijoik', '1615468246-Logo Sicuan Car Wash3.png', 'asdfsadf', 'Aktif'),
(25, 'cinos001', 3, 'Cinos Pria Mantab', 'Celana cinos pria mantab terbaru dari GMK', NULL, 'cinos-pria-mantab', 'Non Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `produk_varian`
--

CREATE TABLE `produk_varian` (
  `id` bigint(20) NOT NULL,
  `produk_kode` text DEFAULT NULL,
  `warna_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `hpp` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT 0,
  `diskon` int(11) DEFAULT 0,
  `gambar` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_varian`
--

INSERT INTO `produk_varian` (`id`, `produk_kode`, `warna_id`, `size_id`, `hpp`, `harga`, `stok`, `diskon`, `gambar`) VALUES
(1, 'asdfsdf', 2, 4, 2000, 25000, 0, 0, NULL),
(2, 'asdfsdf', 2, 4, 90000, 92000, 0, 0, NULL),
(3, 'asdfsdf', 1, 1, 50000, 61000, 0, 0, NULL),
(4, 'Brg0005', 3, 4, 35000, 50000, 0, 0, '1614600344-1571027545-grosirmurahkediri_kb_longviolla_14102019.jpeg'),
(5, 'Brg0005', 1, 3, 40000, 55000, 0, 0, '1614600334-1571027287-grosirmurahkediri_kb_chicorium_14102019.jpeg'),
(6, 'baju0000001', 1, 4, 25000, 26000, 46, 0, '1615468249-logo-sicuan-car-wash3.png'),
(7, 'baju0000001', 3, 2, 3000, 50000, 21, 10, '1615468249-logo-sicuan-car-wash3.png'),
(8, 'baju0000001', 2, 1, 25000, 30000, 0, 3, '1615468627-Logo Sicuan Car Wash3.png'),
(9, 'cinos001', 2, 1, 160000, 170000, 10, 10, NULL),
(10, 'cinos001', 1, 1, 100000, 120000, 10, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `nama`) VALUES
(1, 'XL'),
(2, 'M'),
(3, 'L'),
(4, 'S'),
(5, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selected` enum('active','') COLLATE utf8mb4_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_log`
--

CREATE TABLE `stok_log` (
  `id` bigint(20) NOT NULL,
  `kode_produk` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `aksi` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jumlah` varchar(100) DEFAULT NULL,
  `jumlah_akhir` varchar(100) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_log`
--

INSERT INTO `stok_log` (`id`, `kode_produk`, `user_id`, `status`, `aksi`, `deskripsi`, `keterangan`, `jumlah`, `jumlah_akhir`, `tanggal`) VALUES
(1, 'Brg0003', 1, 'Import Penyesuaian Stok', 'Mengurangi', 'Mengedit stok produk', NULL, '1', '11', '2021-01-18 11:18:13'),
(2, 'Brg0002', 1, 'Import Penyesuaian Stok', 'Menambahkan', 'Mengedit stok produk', NULL, '15', '41', '2021-01-18 11:18:13'),
(3, 'asdfsdf', 1, 'Penyesuaian Stok', 'Mengurangi', 'Menghapus varian produk asdfsdf - coba warna putih size XL', NULL, '4', '21', '2021-01-24 12:38:43'),
(4, 'asdfsdf', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk KAOS SALUR (asdfsdf) - merah - XL', NULL, '3', '0', '2021-03-12 11:43:56'),
(5, 'Brg0005', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - merah - L', NULL, '2', '8', '2021-03-12 11:43:56'),
(6, 'baju0000001 - asdfsadf - putih - M', 1, 'Penyesuaian Stok', 'Menambahkan', 'Mengedit stok produk barang baju0000001 - asdfsadf warna putih size M', NULL, '50', '50', '2021-03-13 03:48:17'),
(7, 'baju0000001 - asdfsadf - merah - S', 1, 'Penyesuaian Stok', 'Menambahkan', 'Mengedit stok produk barang baju0000001 - asdfsadf warna merah size S', NULL, '59', '59', '2021-03-13 03:48:41'),
(8, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - putih - M', NULL, '2', '48', '2021-03-13 04:03:31'),
(9, 'asdfsdf', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk KAOS SALUR (asdfsdf) - hitam - S', NULL, '1', '2', '2021-03-13 11:35:02'),
(10, 'asdfsdf', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk KAOS SALUR (asdfsdf) - hitam - S', NULL, '1', '1', '2021-03-13 11:47:31'),
(11, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - putih - M', NULL, '2', '46', '2021-03-13 11:58:26'),
(12, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - merah - S', NULL, '3', '56', '2021-03-13 12:09:14'),
(13, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - putih - M', NULL, '2', '44', '2021-03-13 12:09:14'),
(14, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - putih - M', NULL, '2', '42', '2021-03-17 11:58:05'),
(15, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - merah - S', NULL, '1', '55', '2021-03-17 11:58:05'),
(16, 'asdfsdf', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk KAOS SALUR (asdfsdf) - hitam - S', NULL, '1', '9', '2021-03-17 11:58:05'),
(17, 'Brg0005', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - putih - S', NULL, '1', '6', '2021-03-17 12:03:25'),
(18, 'baju0000001', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - hitam - XL', NULL, '1', '-1', '2021-03-17 12:03:25'),
(19, 'Brg0005', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - merah - L', NULL, '1', '7', '2021-03-17 12:03:25'),
(20, 'Brg0005', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - putih - S', NULL, '1', '5', '2021-03-17 12:03:35'),
(21, 'baju0000001', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - hitam - XL', NULL, '1', '-2', '2021-03-17 12:03:35'),
(22, 'Brg0005', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - merah - L', NULL, '1', '6', '2021-03-17 12:03:35'),
(23, 'Brg0005', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - putih - S', NULL, '1', '4', '2021-03-17 12:05:24'),
(24, 'Brg0005', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - merah - L', NULL, '1', '5', '2021-03-17 12:05:24'),
(25, 'baju0000001', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - hitam - XL', NULL, '1', '-3', '2021-03-17 12:05:24'),
(26, 'Brg0005', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - putih - S', NULL, '1', '3', '2021-03-17 12:14:20'),
(27, 'Brg0005', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - merah - L', NULL, '1', '4', '2021-03-17 12:14:20'),
(28, 'baju0000001', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - hitam - XL', NULL, '1', '-4', '2021-03-17 12:14:20'),
(29, 'baju0000001', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - putih - M', NULL, '2', '40', '2021-03-17 12:19:48'),
(30, 'baju0000001', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - merah - S', NULL, '1', '54', '2021-03-17 12:19:48'),
(31, 'asdfsdf - KAOS SALUR - hitam - S', 1, 'Penyesuaian Stok', 'Menambahkan', 'Mengedit stok produk barang asdfsdf - KAOS SALUR warna hitam size S', NULL, '5', '14', '2021-03-18 13:07:38'),
(32, 'cinos001 - Cinos Pria Mantab - merah - XL', 1, 'Import Penyesuaian Stok', 'Menambahkan', 'Mengedit stok produk', NULL, '10', '10', '2021-03-20 10:39:25'),
(33, 'cinos001 - Cinos Pria Mantab - hitam - XL', 1, 'Import Penyesuaian Stok', 'Menambahkan', 'Mengedit stok produk', NULL, '10', '10', '2021-03-20 10:39:25'),
(34, 'baju0000001 - asdfsadf - hitam - XL', 1, 'Penyesuaian Stok', 'Menambahkan', 'Mengedit stok produk barang baju0000001 - asdfsadf warna hitam size XL', NULL, '10', '6', '2021-03-20 10:44:02'),
(35, 'baju0000001 - asdfsadf - merah - S', 1, 'Penyesuaian Stok', 'Menambahkan', 'Mengedit stok produk barang baju0000001 - asdfsadf warna merah size S', 'asdf', '6', '60', '2021-03-20 10:44:44'),
(36, 'baju0000001', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - putih - M', NULL, '1', '39', '2021-03-22 13:42:56'),
(37, 'Brg0005', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - putih - S', NULL, '2', '1', '2021-03-22 13:42:56'),
(38, 'baju0000001', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - hitam - XL', NULL, '2', '4', '2021-03-22 13:45:17'),
(39, 'Brg0005', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk KEMEJA MOTIF (Brg0005) - merah - L', NULL, '2', '2', '2021-03-22 13:49:22'),
(40, 'asdfsdf', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk KAOS SALUR (asdfsdf) - hitam - S', NULL, '2', '12', '2021-03-23 19:21:25'),
(41, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - putih - M', NULL, '2', '37', '2021-03-23 19:25:35'),
(42, 'asdfsdf', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk KAOS SALUR (asdfsdf) - hitam - S', NULL, '1', '0', '2021-03-23 20:16:50'),
(43, 'asdfsdf', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk KAOS SALUR (asdfsdf) - hitam - S', NULL, '2', '10', '2021-03-23 20:51:58'),
(44, 'baju0000001', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - hitam - XL', NULL, '2', '2', '2021-03-30 08:37:16'),
(45, 'baju0000001', 1, 'Menjual Via Online', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - merah - S', NULL, '2', '58', '2021-03-30 08:37:16'),
(46, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - hitam - XL', NULL, '1', '1', '2021-04-04 13:21:25'),
(47, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - merah - S', NULL, '3', '55', '2021-04-04 13:33:02'),
(48, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - merah - S', NULL, '3', '52', '2021-04-04 13:33:20'),
(49, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - merah - S', NULL, '3', '49', '2021-04-04 13:33:42'),
(50, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - putih - M', NULL, '4', '30', '2021-04-04 13:35:45'),
(51, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - putih - M', NULL, '4', '26', '2021-04-04 13:35:59'),
(52, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - merah - S', NULL, '2', '47', '2021-04-04 13:37:35'),
(53, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - merah - S', NULL, '1', '46', '2021-04-04 13:43:41'),
(54, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - hitam - XL', NULL, '1', '0', '2021-04-04 13:45:01'),
(55, 'baju0000001', 1, 'Menjual Via Offline', 'Mengurangi', 'Menjual produk asdfsadf (baju0000001) - putih - M', NULL, '5', '21', '2021-04-04 13:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `thumb_detail_transaksi`
--

CREATE TABLE `thumb_detail_transaksi` (
  `id` bigint(20) NOT NULL,
  `kode_transaksi` text DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT 0,
  `subtotal` int(11) DEFAULT NULL,
  `tgl` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thumb_detail_transaksi`
--

INSERT INTO `thumb_detail_transaksi` (`id`, `kode_transaksi`, `produk_id`, `jumlah`, `harga`, `diskon`, `subtotal`, `tgl`) VALUES
(1, 'TRX.2021/03/05-00003', 4, 1, 50000, 0, 50000, '2021-03-05'),
(2, 'TRX.2021/03/05-00003', 5, 1, 55000, 0, 55000, '2021-03-05'),
(59, '00001-TRXM.2021/04/04', 8, 1, 30000, 3, 29100, '2021-04-04'),
(60, '00002-TRXM.2021/04/04', 6, 3, 26000, 0, 78000, '2021-04-04'),
(61, '00002-TRXM.2021/04/04', 6, 3, 26000, 0, 78000, '2021-04-04'),
(62, '00002-TRXM.2021/04/04', 6, 3, 26000, 0, 78000, '2021-04-04'),
(63, '00002-TRXM.2021/04/04', 7, 4, 50000, 10, 180000, '2021-04-04'),
(64, '00002-TRXM.2021/04/04', 7, 4, 50000, 10, 180000, '2021-04-04'),
(65, '00002-TRXM.2021/04/04', 6, 2, 26000, 0, 52000, '2021-04-04'),
(66, '00003-TRXM.2021/04/04', 6, 1, 26000, 0, 26000, '2021-04-04'),
(67, '00004-TRXM.2021/04/04', 8, 1, 30000, 3, 29100, '2021-04-04'),
(68, '00005-TRXM.2021/04/04', 7, 5, 50000, 10, 225000, '2021-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `thumb_transaksi_manual`
--

CREATE TABLE `thumb_transaksi_manual` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `produk_kode` varchar(100) DEFAULT NULL,
  `varian` varchar(100) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT 0,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trx_umum`
--

CREATE TABLE `trx_umum` (
  `id` int(11) NOT NULL,
  `faktur` varchar(50) DEFAULT NULL,
  `tgl` varchar(50) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `nama` varchar(300) DEFAULT NULL,
  `telp` varchar(300) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `jns_ambil` enum('Toko','Kirim') DEFAULT 'Kirim',
  `subtotal` varchar(50) DEFAULT NULL,
  `ongkir` varchar(50) DEFAULT NULL,
  `diskon` varchar(50) DEFAULT NULL,
  `total` varchar(300) DEFAULT NULL,
  `dibayar_cash` varchar(300) DEFAULT NULL,
  `dibayar_voucher` varchar(300) DEFAULT NULL,
  `dibayar_transfer` varchar(300) DEFAULT NULL,
  `sts` enum('sudah','belum','terbayar','cancel') DEFAULT 'belum',
  `kurir` varchar(50) DEFAULT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `alamat_penerima` varchar(100) DEFAULT NULL,
  `telp_penerima` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `admin_acc` varchar(300) DEFAULT '-',
  `sts_notif` enum('y','n') DEFAULT 'n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_umum`
--

INSERT INTO `trx_umum` (`id`, `faktur`, `tgl`, `id_pengguna`, `nama`, `telp`, `alamat`, `jns_ambil`, `subtotal`, `ongkir`, `diskon`, `total`, `dibayar_cash`, `dibayar_voucher`, `dibayar_transfer`, `sts`, `kurir`, `nama_penerima`, `alamat_penerima`, `telp_penerima`, `keterangan`, `admin_acc`, `sts_notif`, `created_at`, `updated_at`) VALUES
(28, '00001-TRXM.2021/04/04', '2021-04-04', 5, 'ikwan', '0320923', 'gurah', 'Toko', '29100', '3000', '1100', '31000', NULL, NULL, NULL, 'sudah', NULL, 'ikwan', 'gurah', '0320923', NULL, '1', 'y', '2021-04-04 06:21:25', '2021-04-04 06:21:25'),
(29, '00002-TRXM.2021/04/04', '2021-04-04', 4, 'hadi', '03842', 'mojoroto', 'Toko', '52000', '2000', '0', '54000', '4000', '25000', '25000', 'sudah', NULL, 'hadi', 'mojoroto', '03842', NULL, '1', 'y', '2021-04-04 06:37:37', '2021-04-04 06:37:37'),
(30, '00003-TRXM.2021/04/04', '2021-04-04', 3, 'halo', '038092', 'gurah', 'Toko', '26000', '0', '0', '26000', '26000', '0', '0', 'sudah', NULL, 'halo', 'gurah', '038092', NULL, '1', 'y', '2021-04-04 06:43:42', '2021-04-04 06:43:42'),
(31, '00004-TRXM.2021/04/04', '2021-04-04', 4, 'hadi', '03842', 'mojoroto', 'Toko', '29100', '0', '0', '29100', '0', '29100', '0', 'sudah', NULL, 'hadi', 'mojoroto', '03842', NULL, '1', 'y', '2021-04-04 06:45:02', '2021-04-04 06:45:02'),
(32, '00005-TRXM.2021/04/04', '2021-04-04', 11, 'Bandi', '02948209802', NULL, 'Toko', '225000', '0', '0', '225000', '0', '0', '225000', 'sudah', NULL, 'Bandi', NULL, '02948209802', NULL, '1', 'y', '2021-04-04 06:45:32', '2021-04-04 06:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_cs` enum('Aktif','Non Aktif') COLLATE utf8mb4_unicode_ci DEFAULT 'Non Aktif',
  `gambar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `telp`, `level`, `status_cs`, `gambar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'deva', 'deva', 'damarasatrio@gmail.com', '6281220380607', 'Super Admin', 'Non Aktif', '1610715217-user4-128x128.jpg', NULL, '$2y$10$F0HeSONFPSbJxRpR6XAovuL5AUlodmYe59oiyTHnfqV6Q4Pe7Egs.', NULL, '2021-01-09 12:20:55', '2021-03-04 12:18:30'),
(2, 'koreng', 'Admin Koreng', 'koreng@gmail.com', '6285748747597', 'Super Admin', 'Non Aktif', '1614910767-1571027178-grosirmurahkediri_kb_amarilly_14102019.jpeg', NULL, '$2y$10$qiASc13qjXVFGxBcDj/Bg.ejq.zDjXDm12YVD88BFwzC.ZEcPT2DK', NULL, NULL, NULL),
(3, 'deva', 'deva', 'satriosuklun2@gmail.com', '2489209348902', 'Super Admin', 'Aktif', '1616237807-qw.png', NULL, '$2y$10$4vlRIqDhPUxNMZ60HFNyFeXrzp0mH0PARXxVsYtxDc3jPDyiR9YNm', NULL, '2021-03-08 08:26:49', '2021-03-19 21:04:02'),
(4, 'superadmin', 'superadmin', 'superadmin@gmail.com', '2394882390', 'Super Admin', 'Non Aktif', '1616504048-skripsiimage.jpg', NULL, '$2y$10$.XPCSD6dx46q0z9xDxD4JOawwGSeeVmig1O3ScNMF8WDdAyCrZvSu', NULL, NULL, NULL),
(5, 'admin', 'admin', 'admin2@gmail.com', '29348902', 'Admin', 'Non Aktif', '1616513707-skripsiimage.jpg', NULL, '$2y$10$zyZiut.Le9ehQqwynU3QHOVc/61qhOecuykA4tOghF35HBKqO.BEq', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` bigint(20) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `os` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `ip`, `date`, `time`, `os`) VALUES
(1, '127.0.0.1', '2021-03-19', '01:29:17', 'windows'),
(2, '127.0.0.1', '2021-03-20', '11:32:39', 'windows'),
(3, '127.0.0.1', '2021-03-22', '02:44:50', 'windows'),
(4, '127.0.0.1', '2021-03-23', '10:38:40', 'windows'),
(5, '127.0.0.1', '2021-03-30', '08:37:00', 'windows'),
(6, '127.0.0.1', '2021-04-02', '08:59:36', 'windows'),
(7, '127.0.0.1', '2021-04-03', '10:33:01', 'windows'),
(8, '127.0.0.1', '2021-04-04', '02:03:23', 'windows');

-- --------------------------------------------------------

--
-- Table structure for table `warna`
--

CREATE TABLE `warna` (
  `id` int(11) NOT NULL,
  `nama` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warna`
--

INSERT INTO `warna` (`id`, `nama`) VALUES
(1, 'merah'),
(2, 'hitam'),
(3, 'putih'),
(4, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `web_setting`
--

CREATE TABLE `web_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `singkatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `moto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_satu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_dua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_fb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_ig` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_android` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_iphone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_setting`
--

INSERT INTO `web_setting` (`id`, `nama`, `singkatan`, `deskripsi`, `moto`, `email`, `telp_satu`, `telp_dua`, `logo`, `favicon`, `link_fb`, `link_ig`, `link_youtube`, `link_android`, `link_iphone`, `meta`) VALUES
(1, 'GMK ORDER NEW', 'GO', '<p><font face=\"sans-serif\"><span style=\"font-size: 14px;\">Klik Desa adalah Sebuah Aplikasi berbasis web yang terintegrasi dengan aplikasi berbasis mobile (android) yang berguna untuk mempermudah interaksi administrasi, pelayanan publik dan usaha desa antara Pemerintah Desa dan Masyarakat Desa.Â </span></font></p><p><font face=\"sans-serif\"><span style=\"font-size: 14px;\">Selain terwujudnya komunikasi dan sebagai media informasi, aplikasi klik desa secara tidak langsung dapat meningkatkan ekonomi kreatif dan usaha mikro atau makro masyarakat desa yang akan berdampak pada bertumbuhnya unit-unit usaha BUMDes.</span></font></p>', 'akan berdampak pada bertumbuhnya unit-unit usaha BUMDes.', 'SEKDA@gmail.com', '08209284902841', '08209284902840', '1616237608-qw.png', '1616237608-qw.png', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.youtube.com/', 'android', 'apple', 'KlikDesa Adalah Aplikasi Desa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambar_produk`
--
ALTER TABLE `gambar_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_admin`
--
ALTER TABLE `log_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_varian`
--
ALTER TABLE `produk_varian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_log`
--
ALTER TABLE `stok_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumb_detail_transaksi`
--
ALTER TABLE `thumb_detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumb_transaksi_manual`
--
ALTER TABLE `thumb_transaksi_manual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_umum`
--
ALTER TABLE `trx_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_setting`
--
ALTER TABLE `web_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gambar_produk`
--
ALTER TABLE `gambar_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log_admin`
--
ALTER TABLE `log_admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `produk_varian`
--
ALTER TABLE `produk_varian`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_log`
--
ALTER TABLE `stok_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `thumb_detail_transaksi`
--
ALTER TABLE `thumb_detail_transaksi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `thumb_transaksi_manual`
--
ALTER TABLE `thumb_transaksi_manual`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `trx_umum`
--
ALTER TABLE `trx_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `warna`
--
ALTER TABLE `warna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `web_setting`
--
ALTER TABLE `web_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
