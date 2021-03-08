-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_gmkorder
CREATE DATABASE IF NOT EXISTS `db_gmkorder` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_gmkorder`;

-- Dumping structure for table db_gmkorder.detail_transaksi
CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` text,
  `produk_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.detail_transaksi: ~0 rows (approximately)
DELETE FROM `detail_transaksi`;
/*!40000 ALTER TABLE `detail_transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_transaksi` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_gmkorder.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.gambar_produk
CREATE TABLE IF NOT EXISTS `gambar_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(100) DEFAULT NULL,
  `nama` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.gambar_produk: ~3 rows (approximately)
DELETE FROM `gambar_produk`;
/*!40000 ALTER TABLE `gambar_produk` DISABLE KEYS */;
INSERT INTO `gambar_produk` (`id`, `kode_produk`, `nama`) VALUES
	(14, 'asdfsdf', '1611488237-11.jpg'),
	(15, 'asdfsdf', '1611488237-10.jpg'),
	(16, 'asdfsdf', '1611488237-9.jpg');
/*!40000 ALTER TABLE `gambar_produk` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.kategori_produk
CREATE TABLE IF NOT EXISTS `kategori_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) DEFAULT NULL,
  `slug` text,
  `gambar` text,
  `status` enum('Aktif','Non Aktif') DEFAULT 'Aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.kategori_produk: ~2 rows (approximately)
DELETE FROM `kategori_produk`;
/*!40000 ALTER TABLE `kategori_produk` DISABLE KEYS */;
INSERT INTO `kategori_produk` (`id`, `nama`, `slug`, `gambar`, `status`) VALUES
	(1, 'Kaos Polos', 'kaos-polos', '1614399062-1568615155-09_polos_02.png', 'Aktif'),
	(2, 'KEMEJA MOTIF', 'kemeja-motif', '1614399094-1582345057-gmk_kemeja_m9.jpeg', 'Aktif');
/*!40000 ALTER TABLE `kategori_produk` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_gmkorder.migrations: ~4 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_06_30_022914_create_pengguna_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_gmkorder.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_gmkorder.pengguna: ~0 rows (approximately)
DELETE FROM `pengguna`;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` (`id`, `username`, `nama`, `email`, `telp`, `gambar`, `password`, `remember_token`) VALUES
	(2, 'deva', 'deva', 'satriosuklun@gmail.com', '08230', '1611149584-sicuan-1.jpeg', '$2y$10$.f2D5qmNHfh4lB3SkcXXueOr9KouCRdhcTOLOWOOdTBEN8wnkvBEG', NULL);
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode` text,
  `kategori_produk` int(11) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `deskripsi` text,
  `gambar_utama` text,
  `slug` text,
  `status` enum('Aktif','Non Aktif','Habis') DEFAULT 'Aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.produk: ~8 rows (approximately)
DELETE FROM `produk`;
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` (`id`, `kode`, `kategori_produk`, `nama`, `deskripsi`, `gambar_utama`, `slug`, `status`) VALUES
	(8, 'brg02', 2, 'JAKET POLOS', 'asdfj', '1614514533-1571027178-grosirmurahkediri_kb_amarilly_14102019.jpeg', 'jaket-polos', 'Aktif'),
	(15, 'Brg0005', 2, 'KEMEJA MOTIF', 'KEMEJA ENAK DIPAKAI', '1614365348-1571027287-grosirmurahkediri_kb_chicorium_14102019.jpeg', 'kemeja-motif', 'Aktif'),
	(16, 'Brg0004', 2, 'Jaket HOODIE', 'asdfj', '1614514552-1571027545-grosirmurahkediri_kb_longviolla_14102019.jpeg', 'jaket-hoodie', 'Aktif'),
	(17, 'Brg0006', 1, 'Jaket Parka', 'asdfj', '1614365248-1575526138-grosir_murah_kediri_lumino_06_122019.jpeg', 'jaket-parka', 'Aktif'),
	(18, 'asdfsdf', 2, 'KAOS SALUR', 'Kaos salur motif salur', '1614365198-1571217715-grosir_murah_kediri_ks3_05102019.jpeg', 'kaos-salur', 'Aktif'),
	(19, 'kjsfkj', 2, 'KAOS SALUR', 'Kaos salur motif salur', '1614365198-1571217715-grosir_murah_kediri_ks3_05102019.jpeg', 'kaos-salur', 'Aktif'),
	(20, 'Brg0008', 2, 'KEMEJA MOTIF', 'asdfj', '1614365348-1571027287-grosirmurahkediri_kb_chicorium_14102019.jpeg', 'kemeja-motif', 'Aktif'),
	(21, 'Brg0004', 2, 'Jaket HOODIE', 'asdfj', '1614514552-1571027545-grosirmurahkediri_kb_longviolla_14102019.jpeg', 'jaket-hoodie', 'Aktif'),
	(22, 'Brg0006', 1, 'Jaket Parka', 'asdfj', '1614365248-1575526138-grosir_murah_kediri_lumino_06_122019.jpeg', 'jaket-parka', 'Aktif'),
	(23, 'brg02', 2, 'JAKET POLOS', 'asdfj', '1614514533-1571027178-grosirmurahkediri_kb_amarilly_14102019.jpeg', 'jaket-polos', 'Aktif');
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.produk_varian
CREATE TABLE IF NOT EXISTS `produk_varian` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `produk_kode` text,
  `warna_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `hpp` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT '0',
  `diskon` int(11) DEFAULT '0',
  `gambar` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.produk_varian: ~5 rows (approximately)
DELETE FROM `produk_varian`;
/*!40000 ALTER TABLE `produk_varian` DISABLE KEYS */;
INSERT INTO `produk_varian` (`id`, `produk_kode`, `warna_id`, `size_id`, `hpp`, `harga`, `stok`, `diskon`, `gambar`) VALUES
	(1, 'asdfsdf', 2, 4, 2000, 25000, 10, 0, NULL),
	(2, 'asdfsdf', 2, 4, 90000, 92000, 5, 0, NULL),
	(3, 'asdfsdf', 1, 1, 50000, 61000, 6, 0, NULL),
	(4, 'Brg0005', 3, 4, 35000, 50000, 10, 0, '1614600344-1571027545-grosirmurahkediri_kb_longviolla_14102019.jpeg'),
	(5, 'Brg0005', 1, 3, 40000, 55000, 12, 0, '1614600334-1571027287-grosirmurahkediri_kb_chicorium_14102019.jpeg');
/*!40000 ALTER TABLE `produk_varian` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.size
CREATE TABLE IF NOT EXISTS `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.size: ~4 rows (approximately)
DELETE FROM `size`;
/*!40000 ALTER TABLE `size` DISABLE KEYS */;
INSERT INTO `size` (`id`, `nama`) VALUES
	(1, 'XL'),
	(2, 'M'),
	(3, 'L'),
	(4, 'S');
/*!40000 ALTER TABLE `size` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.slider
CREATE TABLE IF NOT EXISTS `slider` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci,
  `link` text COLLATE utf8mb4_unicode_ci,
  `link_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_gmkorder.slider: ~0 rows (approximately)
DELETE FROM `slider`;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.stok_log
CREATE TABLE IF NOT EXISTS `stok_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_produk` text,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `aksi` text,
  `deskripsi` text,
  `jumlah` varchar(100) DEFAULT NULL,
  `jumlah_akhir` varchar(100) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.stok_log: ~3 rows (approximately)
DELETE FROM `stok_log`;
/*!40000 ALTER TABLE `stok_log` DISABLE KEYS */;
INSERT INTO `stok_log` (`id`, `kode_produk`, `user_id`, `status`, `aksi`, `deskripsi`, `jumlah`, `jumlah_akhir`, `tanggal`) VALUES
	(1, 'Brg0003', 1, 'Import Penyesuaian Stok', 'Mengurangi', 'Mengedit stok produk', '1', '11', '2021-01-18 11:18:13'),
	(2, 'Brg0002', 1, 'Import Penyesuaian Stok', 'Menambahkan', 'Mengedit stok produk', '15', '41', '2021-01-18 11:18:13'),
	(3, 'asdfsdf', 1, 'Penyesuaian Stok', 'Mengurangi', 'Menghapus varian produk asdfsdf - coba warna putih size XL', '4', '21', '2021-01-24 12:38:43');
/*!40000 ALTER TABLE `stok_log` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.thumb_detail_transaksi
CREATE TABLE IF NOT EXISTS `thumb_detail_transaksi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` text,
  `produk_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `tgl` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.thumb_detail_transaksi: ~4 rows (approximately)
DELETE FROM `thumb_detail_transaksi`;
/*!40000 ALTER TABLE `thumb_detail_transaksi` DISABLE KEYS */;
INSERT INTO `thumb_detail_transaksi` (`id`, `kode_transaksi`, `produk_id`, `jumlah`, `harga`, `subtotal`, `tgl`) VALUES
	(1, 'TRX.2021/03/05-00003', 4, 1, 50000, 50000, '2021-03-05'),
	(2, 'TRX.2021/03/05-00003', 5, 1, 55000, 55000, '2021-03-05'),
	(3, '00001-TRX.2021/03/05', 5, 1, 55000, 55000, '2021-03-05'),
	(4, '00001-TRX.2021/03/05', 4, 1, 50000, 50000, '2021-03-05');
/*!40000 ALTER TABLE `thumb_detail_transaksi` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode` text,
  `admin` int(11) DEFAULT NULL,
  `pengguna` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL,
  `tambahan` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `keterangan` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` text,
  `last_update_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.transaksi: ~0 rows (approximately)
DELETE FROM `transaksi`;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.trx_umum
CREATE TABLE IF NOT EXISTS `trx_umum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(50) DEFAULT NULL,
  `tgl` varchar(50) DEFAULT NULL,
  `nama` varchar(300) DEFAULT NULL,
  `telp` varchar(300) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `jns_ambil` enum('Toko','Kirim') DEFAULT 'Kirim',
  `subtotal` varchar(50) DEFAULT NULL,
  `diskon` varchar(50) DEFAULT NULL,
  `total` varchar(300) DEFAULT NULL,
  `sts` enum('sudah','belum','terbayar') DEFAULT 'belum',
  `admin_acc` varchar(300) DEFAULT '-',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.trx_umum: ~2 rows (approximately)
DELETE FROM `trx_umum`;
/*!40000 ALTER TABLE `trx_umum` DISABLE KEYS */;
INSERT INTO `trx_umum` (`id`, `faktur`, `tgl`, `nama`, `telp`, `alamat`, `jns_ambil`, `subtotal`, `diskon`, `total`, `sts`, `admin_acc`, `created_at`, `updated_at`) VALUES
	(3, 'TRX.2021/03/05-00003', '2021-03-05', 'Rahmat Abdul Salam', '085789654321', 'Jln margo urip no 56 Kediri JATIM', 'Kirim', '0', '0', '0', 'belum', '-', '2021-03-05 08:20:59', '2021-03-05 08:20:59'),
	(4, '00001-TRX.2021/03/05', '2021-03-05', 'Rahmat Abdul Salam', '0857236476324', 'jln Semeru mojoroto kota kediri', 'Kirim', '0', '0', '0', 'belum', '-', '2021-03-05 11:23:03', '2021-03-05 11:23:03');
/*!40000 ALTER TABLE `trx_umum` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_gmkorder.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `name`, `email`, `telp`, `level`, `gambar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'deva', 'deva', 'damarasatrio@gmail.com', '6281220380607', 'Super Admin', '1610715217-user4-128x128.jpg', NULL, '$2y$10$F0HeSONFPSbJxRpR6XAovuL5AUlodmYe59oiyTHnfqV6Q4Pe7Egs.', NULL, '2021-01-10 02:20:55', '2021-03-05 02:18:30'),
	(2, 'koreng', 'Admin Koreng', 'koreng@gmail.com', '6285748747597', 'Super Admin', '1614910767-1571027178-grosirmurahkediri_kb_amarilly_14102019.jpeg', NULL, '$2y$10$qiASc13qjXVFGxBcDj/Bg.ejq.zDjXDm12YVD88BFwzC.ZEcPT2DK', NULL, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.warna
CREATE TABLE IF NOT EXISTS `warna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_gmkorder.warna: ~3 rows (approximately)
DELETE FROM `warna`;
/*!40000 ALTER TABLE `warna` DISABLE KEYS */;
INSERT INTO `warna` (`id`, `nama`) VALUES
	(1, 'merah'),
	(2, 'hitam'),
	(3, 'putih');
/*!40000 ALTER TABLE `warna` ENABLE KEYS */;

-- Dumping structure for table db_gmkorder.web_setting
CREATE TABLE IF NOT EXISTS `web_setting` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `singkatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `moto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_satu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_dua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `favicon` text COLLATE utf8mb4_unicode_ci,
  `link_fb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_ig` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_android` text COLLATE utf8mb4_unicode_ci,
  `link_iphone` text COLLATE utf8mb4_unicode_ci,
  `meta` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_gmkorder.web_setting: ~0 rows (approximately)
DELETE FROM `web_setting`;
/*!40000 ALTER TABLE `web_setting` DISABLE KEYS */;
INSERT INTO `web_setting` (`id`, `nama`, `singkatan`, `deskripsi`, `moto`, `email`, `telp_satu`, `telp_dua`, `logo`, `favicon`, `link_fb`, `link_ig`, `link_youtube`, `link_android`, `link_iphone`, `meta`) VALUES
	(1, 'GMK ORDER NEW', 'Sicuan', '<p><font face="sans-serif"><span style="font-size: 14px;">Klik Desa adalah Sebuah Aplikasi berbasis web yang terintegrasi dengan aplikasi berbasis mobile (android) yang berguna untuk mempermudah interaksi administrasi, pelayanan publik dan usaha desa antara Pemerintah Desa dan Masyarakat Desa. </span></font></p><p><font face="sans-serif"><span style="font-size: 14px;">Selain terwujudnya komunikasi dan sebagai media informasi, aplikasi klik desa secara tidak langsung dapat meningkatkan ekonomi kreatif dan usaha mikro atau makro masyarakat desa yang akan berdampak pada bertumbuhnya unit-unit usaha BUMDes.</span></font></p>', 'akan berdampak pada bertumbuhnya unit-unit usaha BUMDes.', 'SEKDA@gmail.com', '08209284902841', '08209284902840', '1610449223-sicuan-logo.png', '1610449244-sicuan-logo.png', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.youtube.com/', 'android', 'apple', 'KlikDesa Adalah Aplikasi Desa');
/*!40000 ALTER TABLE `web_setting` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
