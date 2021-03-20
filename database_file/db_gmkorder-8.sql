-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2021 at 12:04 PM
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
(8, 'nina', 'nina', NULL, '0948092809', NULL, 'gurah', '$2y$10$Co53GaKX0E1x34rreL.MkeuJVvVdPXKSiDfX8LDSA5sIJS.yuwj4O', NULL);

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
(15, 'Brg0005', 2, 'KEMEJA MOTIF', 'KEMEJA ENAK DIPAKAI', '1614365348-1571027287-grosirmurahkediri_kb_chicorium_14102019.jpeg', 'kemeja-motif', 'Aktif'),
(16, 'Brg0004', 2, 'Jaket HOODIE', 'asdfj', '1614514552-1571027545-grosirmurahkediri_kb_longviolla_14102019.jpeg', 'jaket-hoodie', 'Aktif'),
(17, 'Brg0006', 1, 'Jaket Parka', 'asdfj', '1614365248-1575526138-grosir_murah_kediri_lumino_06_122019.jpeg', 'jaket-parka', 'Aktif'),
(18, 'asdfsdf', 2, 'KAOS SALUR', 'Kaos salur motif salur', '1614365198-1571217715-grosir_murah_kediri_ks3_05102019.jpeg', 'kaos-salur', 'Aktif'),
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
(1, 'asdfsdf', 2, 4, 2000, 25000, 14, 0, NULL),
(2, 'asdfsdf', 2, 4, 90000, 92000, 1, 0, NULL),
(3, 'asdfsdf', 1, 1, 50000, 61000, 0, 0, NULL),
(4, 'Brg0005', 3, 4, 35000, 50000, 3, 0, '1614600344-1571027545-grosirmurahkediri_kb_longviolla_14102019.jpeg'),
(5, 'Brg0005', 1, 3, 40000, 55000, 4, 0, '1614600334-1571027287-grosirmurahkediri_kb_chicorium_14102019.jpeg'),
(6, 'baju0000001', 1, 4, 25000, 26000, 60, 0, '1615468249-logo-sicuan-car-wash3.png'),
(7, 'baju0000001', 3, 2, 3000, 50000, 40, 10, '1615468249-logo-sicuan-car-wash3.png'),
(8, 'baju0000001', 2, 1, 25000, 30000, 6, 3, '1615468627-Logo Sicuan Car Wash3.png'),
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
(4, 'S');

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
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
(35, 'baju0000001 - asdfsadf - merah - S', 1, 'Penyesuaian Stok', 'Menambahkan', 'Mengedit stok produk barang baju0000001 - asdfsadf warna merah size S', 'asdf', '6', '60', '2021-03-20 10:44:44');

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
(3, '00001-TRX.2021/03/05', 5, 1, 55000, 0, 55000, '2021-03-05'),
(4, '00001-TRX.2021/03/05', 4, 1, 50000, 0, 50000, '2021-03-05'),
(5, '00001-TRXM.2021/03/11', 5, 2, 55000, 0, 110000, '2021-03-11'),
(6, '00002-TRXM.2021/03/11', 4, 3, 50000, 0, 150000, '2021-03-11'),
(7, '00002-TRXM.2021/03/11', 3, 3, 61000, 0, 183000, '2021-03-11'),
(8, '00003-TRXM.2021/03/11', 2, 2, 92000, 0, 184000, '2021-03-11'),
(9, '00001-TRXM.2021/03/12', 3, 3, 61000, 0, 183000, '2021-03-12'),
(10, '00001-TRXM.2021/03/12', 5, 2, 55000, 0, 110000, '2021-03-12'),
(11, '00001-TRXM.2021/03/13', 7, 2, 50000, 10, 90000, '2021-03-13'),
(12, '00002-TRXM.2021/03/13', 2, 1, 92000, 0, 92000, '2021-03-13'),
(13, '00003-TRXM.2021/03/13', 2, 1, 92000, 0, 92000, '2021-03-13'),
(14, '00004-TRXM.2021/03/13', 7, 2, 50000, 10, 90000, '2021-03-13'),
(15, '00005-TRXM.2021/03/13', 6, 3, 26000, 0, 78000, '2021-03-13'),
(16, '00005-TRXM.2021/03/13', 7, 2, 50000, 10, 90000, '2021-03-13'),
(33, '00001-TRX.2021/03/15', 4, 1, 50000, 0, 50000, '2021-03-17'),
(34, '00001-TRX.2021/03/15', 5, 1, 55000, 0, 55000, '2021-03-17'),
(35, '00001-TRX.2021/03/15', 8, 1, 30000, 0, 30000, '2021-03-17'),
(36, '00001-TRX.2021/03/17', 7, 2, 50000, 10, 90000, '2021-03-17'),
(37, '00001-TRX.2021/03/17', 6, 1, 26000, 0, 26000, '2021-03-17'),
(38, '00001-TRX.2021/03/19', 7, 1, 50000, 10, 45000, '2021-03-19');

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

INSERT INTO `trx_umum` (`id`, `faktur`, `tgl`, `id_pengguna`, `nama`, `telp`, `alamat`, `jns_ambil`, `subtotal`, `ongkir`, `diskon`, `total`, `sts`, `kurir`, `nama_penerima`, `alamat_penerima`, `telp_penerima`, `keterangan`, `admin_acc`, `sts_notif`, `created_at`, `updated_at`) VALUES
(3, 'TRX.2021/03/05-00003', '2021-03-05', NULL, 'Rahmat Abdul Salam', '085789654321', 'Jln margo urip no 56 Kediri JATIM', 'Kirim', '0', NULL, '0', '0', 'sudah', NULL, NULL, NULL, NULL, NULL, '-', 'y', '2021-03-05 01:20:59', '2021-03-05 01:20:59'),
(4, '00001-TRX.2021/03/05', '2021-03-05', NULL, 'Rahmat Abdul Salam', '0857236476324', 'jln Semeru mojoroto kota kediri', 'Kirim', '0', NULL, '0', '0', 'sudah', NULL, NULL, NULL, NULL, NULL, '-', 'y', '2021-03-05 04:23:03', '2021-03-05 04:23:03'),
(5, '00001-TRXM.2021/03/11', '2021-03-11', 4, 'hadi', '03842', 'mojoroto', 'Toko', '110000', '3000', '10000', '103000', 'sudah', NULL, 'hadi', 'mojoroto', '03842', 'pembelian coba', '1', 'y', NULL, NULL),
(6, '00002-TRXM.2021/03/11', '2021-03-11', 5, 'ikwan', '0320923', 'gurah', 'Kirim', '333000', '4000', '50000', '287000', 'sudah', 'JNT', 'ikwan', 'gurah', '0320923', 'halo', '1', 'y', '2021-03-10 22:45:44', '2021-03-10 22:45:44'),
(7, '00003-TRXM.2021/03/11', '2021-03-11', 4, 'hadi', '03842', 'mojoroto', 'Kirim', '184000', '8000', '2000', '190000', 'sudah', 'JNE', 'hadi', 'mojoroto', '03842', NULL, '1', 'y', '2021-03-11 05:47:36', '2021-03-11 05:47:36'),
(8, '00001-TRXM.2021/03/12', '2021-03-12', 7, 'hadi', '03842', 'mojoroto', 'Toko', '293000', '5000', '3000', '295000', 'sudah', NULL, 'hadi', 'mojoroto', '03842', NULL, '1', 'y', '2021-03-12 04:43:56', '2021-03-12 04:43:56'),
(9, '00001-TRXM.2021/03/13', '2021-03-13', 5, 'ikwan', '0320923', 'gurah', 'Toko', '90000', '4000', '0', '94000', 'sudah', NULL, 'ikwan', 'gurah', '0320923', NULL, '1', 'y', '2021-03-12 21:03:31', '2021-03-12 21:03:31'),
(10, '00002-TRXM.2021/03/13', '2021-03-13', 4, 'hadi', '03842', 'mojoroto', 'Toko', '92000', '5000', NULL, '97000', 'sudah', NULL, 'hadi', 'mojoroto', '03842', NULL, '1', 'y', '2021-03-13 04:35:02', '2021-03-13 04:35:02'),
(11, '00003-TRXM.2021/03/13', '2021-03-13', 3, 'halo', '038092', 'gurah', 'Toko', '92000', NULL, NULL, '92000', 'sudah', NULL, 'halo', 'gurah', '038092', NULL, '1', 'y', '2021-03-13 04:47:31', '2021-03-13 04:47:31'),
(12, '00004-TRXM.2021/03/13', '2021-03-13', 4, 'hadi', '03842', 'mojoroto', 'Toko', '90000', NULL, NULL, '90000', 'sudah', NULL, 'hadi', 'mojoroto', '03842', NULL, '1', 'y', '2021-03-13 04:58:26', '2021-03-13 04:58:26'),
(13, '00005-TRXM.2021/03/13', '2021-03-13', 5, 'ikwan', '0320923', 'gurah', 'Toko', '168000', '5000', '20000', '153000', 'sudah', NULL, 'ikwan', 'gurah', '0320923', 'langsung di ambil di toko oleh ikwan', '2', 'y', '2021-03-13 05:09:14', '2021-03-13 05:09:14'),
(14, '00001-TRX.2021/03/15', '2021-03-17', 0, 'a', '23432', 'ambil di toko', 'Kirim', '135000', NULL, '3000', '132000', 'sudah', 'JNE', 'Hari', 'Gurah', '2384790', 'coba trx online', '1', 'y', '2021-03-17 05:14:20', '2021-03-17 05:14:20'),
(15, '00001-TRX.2021/03/17', '2021-03-17', 0, 'hariono', '092384902', 'ambil di toko', 'Kirim', '116000', '5000', '10000', '111000', 'sudah', 'JNE', 'hadi', 'magersari gurah', '02384509', 'Coba online transaksi', '1', 'y', '2021-03-17 05:19:49', '2021-03-17 05:19:49'),
(16, '00001-TRX.2021/03/19', '2021-03-19', NULL, 'Hariantoi', '023849023890', 'ambil di toko', 'Toko', '50000', NULL, '5000', '45000', 'sudah', NULL, '-', '-', '-', NULL, '1', 'y', '2021-03-19 05:32:22', '2021-03-19 05:32:22');

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
(1, 'deva', 'deva', 'damarasatrio@gmail.com', '6281220380607', 'Super Admin', 'Non Aktif', '1610715217-user4-128x128.jpg', NULL, '$2y$10$F0HeSONFPSbJxRpR6XAovuL5AUlodmYe59oiyTHnfqV6Q4Pe7Egs.', NULL, '2021-01-09 19:20:55', '2021-03-04 19:18:30'),
(2, 'koreng', 'Admin Koreng', 'koreng@gmail.com', '6285748747597', 'Super Admin', 'Non Aktif', '1614910767-1571027178-grosirmurahkediri_kb_amarilly_14102019.jpeg', NULL, '$2y$10$qiASc13qjXVFGxBcDj/Bg.ejq.zDjXDm12YVD88BFwzC.ZEcPT2DK', NULL, NULL, NULL),
(3, 'deva', 'deva', 'satriosuklun2@gmail.com', '2489209348902', 'Super Admin', 'Aktif', '1616237807-qw.png', NULL, '$2y$10$4vlRIqDhPUxNMZ60HFNyFeXrzp0mH0PARXxVsYtxDc3jPDyiR9YNm', NULL, '2021-03-08 15:26:49', '2021-03-20 04:04:02');

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
(2, '127.0.0.1', '2021-03-20', '09:37:14', 'windows');

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
(3, 'putih');

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
(1, 'GMK ORDER NEW', 'GO', '<p><font face=\"sans-serif\"><span style=\"font-size: 14px;\">Klik Desa adalah Sebuah Aplikasi berbasis web yang terintegrasi dengan aplikasi berbasis mobile (android) yang berguna untuk mempermudah interaksi administrasi, pelayanan publik dan usaha desa antara Pemerintah Desa dan Masyarakat Desa. </span></font></p><p><font face=\"sans-serif\"><span style=\"font-size: 14px;\">Selain terwujudnya komunikasi dan sebagai media informasi, aplikasi klik desa secara tidak langsung dapat meningkatkan ekonomi kreatif dan usaha mikro atau makro masyarakat desa yang akan berdampak pada bertumbuhnya unit-unit usaha BUMDes.</span></font></p>', 'akan berdampak pada bertumbuhnya unit-unit usaha BUMDes.', 'SEKDA@gmail.com', '08209284902841', '08209284902840', '1616237608-qw.png', '1616237608-qw.png', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.youtube.com/', 'android', 'apple', 'KlikDesa Adalah Aplikasi Desa');

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_log`
--
ALTER TABLE `stok_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `thumb_detail_transaksi`
--
ALTER TABLE `thumb_detail_transaksi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `thumb_transaksi_manual`
--
ALTER TABLE `thumb_transaksi_manual`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `trx_umum`
--
ALTER TABLE `trx_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warna`
--
ALTER TABLE `warna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `web_setting`
--
ALTER TABLE `web_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
