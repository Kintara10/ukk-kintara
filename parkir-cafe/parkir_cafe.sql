-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2026 at 03:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_parkir`
--

CREATE TABLE `area_parkir` (
  `id` int(11) NOT NULL,
  `nama_area` varchar(100) NOT NULL,
  `kode_area` varchar(20) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `terisi` int(11) DEFAULT 0,
  `jenis_kendaraan` enum('motor','mobil','bus','truk','semua') DEFAULT 'semua',
  `lokasi` varchar(200) DEFAULT NULL,
  `status` enum('aktif','nonaktif','maintenance') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area_parkir`
--

INSERT INTO `area_parkir` (`id`, `nama_area`, `kode_area`, `kapasitas`, `terisi`, `jenis_kendaraan`, `lokasi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Area A - Motor', 'A-MTR', 50, 0, 'motor', 'Depan Cafe', 'aktif', '2026-02-11 02:14:22', '2026-02-11 02:15:48'),
(2, 'Area B - Mobil', 'B-MBL', 30, 0, 'mobil', 'Samping Cafe', 'aktif', '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(3, 'Area C - Bus/Truk', 'C-BIG', 10, 0, 'semua', 'Belakang Cafe', 'aktif', '2026-02-11 02:14:22', '2026-02-11 02:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int(11) NOT NULL,
  `no_polisi` varchar(20) NOT NULL,
  `jenis_kendaraan` enum('motor','mobil','bus','truk') NOT NULL,
  `merk` varchar(50) DEFAULT NULL,
  `warna` varchar(30) DEFAULT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `no_telp_pemilik` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `no_polisi`, `jenis_kendaraan`, `merk`, `warna`, `nama_pemilik`, `no_telp_pemilik`, `created_at`, `updated_at`) VALUES
(1, 'B 1234 ABC', 'motor', 'Honda Beat', 'Hitam', 'Budi Santoso', '081234567890', '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(2, 'B 5678 DEF', 'mobil', 'Toyota Avanza', 'Putih', 'Siti Rahayu', '081234567891', '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(3, 'B 9012 GHI', 'motor', 'Yamaha Mio', 'Merah', 'Ahmad Fauzi', '081234567892', '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(4, 'B 3456 JKL', 'mobil', 'Honda Jazz', 'Silver', 'Dewi Lestari', '081234567893', '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(5, 'B 1234 ABA', 'motor', 'honda', 'biru', 'ana', '0897654323', '2026-02-11 02:15:03', '2026-02-11 02:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `tarif_parkir`
--

CREATE TABLE `tarif_parkir` (
  `id` int(11) NOT NULL,
  `jenis_kendaraan` enum('motor','mobil','bus','truk') NOT NULL,
  `tarif_per_jam` decimal(10,2) NOT NULL,
  `tarif_harian` decimal(10,2) DEFAULT NULL,
  `denda_kehilangan` decimal(10,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tarif_parkir`
--

INSERT INTO `tarif_parkir` (`id`, `jenis_kendaraan`, `tarif_per_jam`, `tarif_harian`, `denda_kehilangan`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'motor', 2000.00, 15000.00, 50000.00, 'Tarif parkir motor', 'aktif', '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(2, 'mobil', 5000.00, 40000.00, 100000.00, 'Tarif parkir mobil', 'aktif', '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(3, 'bus', 10000.00, 80000.00, 200000.00, 'Tarif parkir bus', 'aktif', '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(4, 'truk', 15000.00, 80000.00, 200000.00, 'Tarif parkir truk', 'aktif', '2026-02-11 02:14:22', '2026-02-11 02:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_tiket` varchar(50) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `area_parkir_id` int(11) NOT NULL,
  `petugas_masuk_id` int(11) NOT NULL,
  `petugas_keluar_id` int(11) DEFAULT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `durasi_jam` decimal(10,2) DEFAULT NULL,
  `tarif_id` int(11) NOT NULL,
  `total_bayar` decimal(10,2) DEFAULT NULL,
  `status` enum('parkir','selesai','hilang') DEFAULT 'parkir',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_tiket`, `kendaraan_id`, `area_parkir_id`, `petugas_masuk_id`, `petugas_keluar_id`, `waktu_masuk`, `waktu_keluar`, `durasi_jam`, `tarif_id`, `total_bayar`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 'PKR-20260211-TEST01', 1, 1, 2, 2, '2026-02-11 08:00:00', '2026-02-11 10:30:00', 2.50, 1, 6000.00, 'selesai', NULL, '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(2, 'PKR-20260211-TEST02', 2, 2, 2, 2, '2026-02-11 09:00:00', '2026-02-11 12:00:00', 3.00, 2, 15000.00, 'selesai', NULL, '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(3, 'PKR-20260211-TEST03', 3, 1, 2, 2, '2026-02-11 10:00:00', '2026-02-11 11:00:00', 1.00, 1, 2000.00, 'selesai', NULL, '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(4, 'PKR-20260211-6442C4', 5, 1, 2, 2, '2026-02-11 03:15:03', '2026-02-11 03:15:47', 0.00, 1, 0.00, 'selesai', NULL, '2026-02-11 02:15:03', '2026-02-11 02:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','petugas','owner') NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `role`, `email`, `no_telp`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin', 'admin@parkircafe.com', NULL, 'aktif', '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(2, 'petugas1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Petugas Satu', 'petugas', 'petugas1@parkircafe.com', NULL, 'aktif', '2026-02-11 02:14:22', '2026-02-11 02:14:22'),
(3, 'owner', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Owner Cafe', 'owner', 'owner@parkircafe.com', NULL, 'aktif', '2026-02-11 02:14:22', '2026-02-11 02:14:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_parkir`
--
ALTER TABLE `area_parkir`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_area` (`kode_area`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_no_polisi` (`no_polisi`);

--
-- Indexes for table `tarif_parkir`
--
ALTER TABLE `tarif_parkir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_tiket` (`kode_tiket`),
  ADD KEY `kendaraan_id` (`kendaraan_id`),
  ADD KEY `area_parkir_id` (`area_parkir_id`),
  ADD KEY `petugas_masuk_id` (`petugas_masuk_id`),
  ADD KEY `petugas_keluar_id` (`petugas_keluar_id`),
  ADD KEY `tarif_id` (`tarif_id`),
  ADD KEY `idx_kode_tiket` (`kode_tiket`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_waktu_masuk` (`waktu_masuk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_parkir`
--
ALTER TABLE `area_parkir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tarif_parkir`
--
ALTER TABLE `tarif_parkir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`area_parkir_id`) REFERENCES `area_parkir` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`petugas_masuk_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`petugas_keluar_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`tarif_id`) REFERENCES `tarif_parkir` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
