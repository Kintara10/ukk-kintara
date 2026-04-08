-- Database: parkir_cafe
-- Created: 2026-02-11
-- Description: Database schema for Parking Cafe Management System

-- Create database
CREATE DATABASE IF NOT EXISTS parkir_cafe;
USE parkir_cafe;

-- Table 1: users (Admin, Petugas, Owner)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    role ENUM('admin', 'petugas', 'owner') NOT NULL,
    email VARCHAR(100),
    no_telp VARCHAR(20),
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table 2: tarif_parkir (Parking Rates)
CREATE TABLE tarif_parkir (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis_kendaraan ENUM('motor', 'mobil', 'bus', 'truk') NOT NULL,
    tarif_per_jam DECIMAL(10,2) NOT NULL,
    tarif_harian DECIMAL(10,2),
    denda_kehilangan DECIMAL(10,2),
    keterangan TEXT,
    status ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table 3: area_parkir (Parking Areas)
CREATE TABLE area_parkir (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_area VARCHAR(100) NOT NULL,
    kode_area VARCHAR(20) NOT NULL UNIQUE,
    kapasitas INT NOT NULL,
    terisi INT DEFAULT 0,
    jenis_kendaraan ENUM('motor', 'mobil', 'bus', 'truk', 'semua') DEFAULT 'semua',
    lokasi VARCHAR(200),
    status ENUM('aktif', 'nonaktif', 'maintenance') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table 4: kendaraan (Vehicles)
CREATE TABLE kendaraan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_polisi VARCHAR(20) NOT NULL,
    jenis_kendaraan ENUM('motor', 'mobil', 'bus', 'truk') NOT NULL,
    merk VARCHAR(50),
    warna VARCHAR(30),
    nama_pemilik VARCHAR(100),
    no_telp_pemilik VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_no_polisi (no_polisi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table 5: transaksi (Parking Transactions)
CREATE TABLE transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_tiket VARCHAR(50) NOT NULL UNIQUE,
    kendaraan_id INT NOT NULL,
    area_parkir_id INT NOT NULL,
    petugas_masuk_id INT NOT NULL,
    petugas_keluar_id INT,
    waktu_masuk DATETIME NOT NULL,
    waktu_keluar DATETIME,
    durasi_jam DECIMAL(10,2),
    tarif_id INT NOT NULL,
    total_bayar DECIMAL(10,2),
    status ENUM('parkir', 'selesai', 'hilang') DEFAULT 'parkir',
    catatan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kendaraan_id) REFERENCES kendaraan(id) ON DELETE CASCADE,
    FOREIGN KEY (area_parkir_id) REFERENCES area_parkir(id) ON DELETE RESTRICT,
    FOREIGN KEY (petugas_masuk_id) REFERENCES users(id) ON DELETE RESTRICT,
    FOREIGN KEY (petugas_keluar_id) REFERENCES users(id) ON DELETE RESTRICT,
    FOREIGN KEY (tarif_id) REFERENCES tarif_parkir(id) ON DELETE RESTRICT,
    INDEX idx_kode_tiket (kode_tiket),
    INDEX idx_status (status),
    INDEX idx_waktu_masuk (waktu_masuk)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default users
INSERT INTO users (username, password, nama_lengkap, role, email) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin', 'admin@parkircafe.com'),
('petugas1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Petugas Satu', 'petugas', 'petugas1@parkircafe.com'),
('owner', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Owner Cafe', 'owner', 'owner@parkircafe.com');
-- Default password for all: password

-- Insert default tarif parkir
INSERT INTO tarif_parkir (jenis_kendaraan, tarif_per_jam, tarif_harian, denda_kehilangan, keterangan) VALUES
('motor', 2000, 15000, 50000, 'Tarif parkir motor'),
('mobil', 5000, 40000, 100000, 'Tarif parkir mobil'),
('bus', 10000, 80000, 200000, 'Tarif parkir bus'),
('truk', 10000, 80000, 200000, 'Tarif parkir truk');

-- Insert default area parkir
INSERT INTO area_parkir (nama_area, kode_area, kapasitas, jenis_kendaraan, lokasi) VALUES
('Area A - Motor', 'A-MTR', 50, 'motor', 'Depan Cafe'),
('Area B - Mobil', 'B-MBL', 30, 'mobil', 'Samping Cafe'),
('Area C - Bus/Truk', 'C-BIG', 10, 'semua', 'Belakang Cafe');

-- Insert sample kendaraan for testing
INSERT INTO kendaraan (no_polisi, jenis_kendaraan, merk, warna, nama_pemilik, no_telp_pemilik) VALUES
('B 1234 ABC', 'motor', 'Honda Beat', 'Hitam', 'Budi Santoso', '081234567890'),
('B 5678 DEF', 'mobil', 'Toyota Avanza', 'Putih', 'Siti Rahayu', '081234567891'),
('B 9012 GHI', 'motor', 'Yamaha Mio', 'Merah', 'Ahmad Fauzi', '081234567892'),
('B 3456 JKL', 'mobil', 'Honda Jazz', 'Silver', 'Dewi Lestari', '081234567893');

-- Insert sample completed transactions for testing
INSERT INTO transaksi (kode_tiket, kendaraan_id, area_parkir_id, petugas_masuk_id, petugas_keluar_id, waktu_masuk, waktu_keluar, durasi_jam, tarif_id, total_bayar, status) VALUES
('PKR-20260211-TEST01', 1, 1, 2, 2, '2026-02-11 08:00:00', '2026-02-11 10:30:00', 2.50, 1, 6000, 'selesai'),
('PKR-20260211-TEST02', 2, 2, 2, 2, '2026-02-11 09:00:00', '2026-02-11 12:00:00', 3.00, 2, 15000, 'selesai'),
('PKR-20260211-TEST03', 3, 1, 2, 2, '2026-02-11 10:00:00', '2026-02-11 11:00:00', 1.00, 1, 2000, 'selesai');
