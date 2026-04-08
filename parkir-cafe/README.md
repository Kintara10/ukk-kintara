# Aplikasi Parkir Cafe

Sistem manajemen parkir cafe dengan arsitektur **Native PHP OOP dan MVC**.

## 📋 Fitur Utama

### Database (5 Tabel)
- `users` - Manajemen user (admin, petugas, owner)
- `tarif_parkir` - Konfigurasi tarif parkir
- `area_parkir` - Manajemen area parkir
- `kendaraan` - Data kendaraan
- `transaksi` - Rekaman transaksi parkir

### 3 Dashboard Role-Based

#### 1. Admin Dashboard
- ✅ CRUD User
- ✅ CRUD Tarif Parkir
- ✅ CRUD Area Parkir
- ✅ CRUD Kendaraan
- ✅ Log Aktivitas

#### 2. Petugas Dashboard
- ✅ Input Kendaraan Masuk
- ✅ Proses Kendaraan Keluar
- ✅ Cetak Struk Parkir
- ✅ Monitor Parkir Aktif

#### 3. Owner Dashboard
- ✅ Statistik Pendapatan
- ✅ Laporan Transaksi
- ✅ Analytics per Jenis Kendaraan
- ✅ Filter Laporan by Date

## 🚀 Instalasi

### 1. Clone/Copy Project
```bash
# Copy folder ke htdocs
c:\xampp\htdocs\parkir-cafe
```

### 2. Import Database
```bash
# Buka phpMyAdmin: http://localhost/phpmyadmin
# Create database baru: parkir_cafe
# Import file: database.sql
```

### 3. Konfigurasi (Opsional)
Edit `config/Database.php` jika perlu:
```php
private $host = 'localhost';
private $dbname = 'parkir_cafe';
private $username = 'root';
private $password = '';
```

### 4. Akses Aplikasi
```
http://localhost/parkir-cafe/
```

## 🔐 Demo Accounts

| Role | Username | Password |
|------|----------|----------|
| Admin | admin | password |
| Petugas | petugas1 | password |
| Owner | owner | password |

## 📁 Struktur Folder

```
parkir-cafe/
├── config/
│   └── Database.php          # Database connection
├── core/
│   ├── App.php              # Router
│   ├── Controller.php       # Base controller
│   └── Model.php            # Base model
├── controllers/
│   ├── AuthController.php   # Authentication
│   ├── AdminController.php  # Admin CRUD
│   ├── PetugasController.php # Transactions
│   └── OwnerController.php  # Reports
├── models/
│   ├── UserModel.php
│   ├── TarifModel.php
│   ├── AreaModel.php
│   ├── KendaraanModel.php
│   └── TransaksiModel.php
├── views/
│   ├── layouts/             # Header & Footer
│   ├── auth/                # Login
│   ├── admin/               # Admin views
│   ├── petugas/             # Petugas views
│   └── owner/               # Owner views
├── public/
│   ├── css/style.css        # Styling
│   └── js/main.js           # JavaScript
├── .htaccess                # URL rewriting
├── index.php                # Entry point
└── database.sql             # Database schema
```

## 🎯 Cara Menggunakan

### Login
1. Buka `http://localhost/parkir-cafe/`
2. Login dengan salah satu demo account
3. Akan redirect ke dashboard sesuai role

### Admin - Kelola Data
1. Login sebagai admin
2. Kelola Users, Tarif, Area, Kendaraan
3. Lihat log aktivitas

### Petugas - Transaksi Parkir
1. Login sebagai petugas
2. **Kendaraan Masuk**: Input data kendaraan → Pilih area → Dapatkan kode tiket
3. **Kendaraan Keluar**: Input kode tiket → Lihat detail → Konfirmasi pembayaran → Cetak struk

### Owner - Lihat Laporan
1. Login sebagai owner
2. Lihat statistik pendapatan
3. Filter laporan by date range
4. Lihat breakdown per jenis kendaraan

## 🔧 Teknologi

- **Backend**: Native PHP 7.4+ (OOP & MVC)
- **Database**: MySQL
- **Frontend**: HTML, CSS (Vanilla), JavaScript
- **Design**: Modern gradient UI dengan animations

## ✅ Testing

### Test CRUD Admin
1. Login sebagai admin
2. Test create, edit, delete untuk:
   - Users
   - Tarif Parkir
   - Area Parkir
   - Kendaraan

### Test Transaksi Petugas
1. Login sebagai petugas
2. Input kendaraan masuk → Cek kode tiket
3. Input kendaraan keluar → Cek perhitungan biaya
4. Cetak struk

### Test Laporan Owner
1. Login sebagai owner
2. Cek statistik pendapatan
3. Filter laporan by date
4. Verifikasi data sesuai transaksi

## 📞 Support

Jika ada pertanyaan atau issue, silakan hubungi developer.

---

**Dibuat dengan ❤️ menggunakan Native PHP OOP & MVC**
