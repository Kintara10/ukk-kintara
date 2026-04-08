# 🚀 Cara Menjalankan Aplikasi Parkir Cafe

## 1️⃣ Start XAMPP
1. Buka **XAMPP Control Panel**
2. Klik **Start** di Apache
3. Klik **Start** di MySQL
4. Tunggu sampai keduanya hijau ✅

## 2️⃣ Import Database
1. Buka browser → ketik: `http://localhost/phpmyadmin`
2. Klik tab **"Databases"**
3. Ketik nama database: `parkir_cafe` → Klik **Create**
4. Klik database `parkir_cafe` (di sidebar kiri)
5. Klik tab **"Import"**
6. Klik **"Choose File"** → Pilih file `database.sql`
7. Klik **"Go"** di bawah
8. Tunggu sampai sukses ✅

## 3️⃣ Akses Aplikasi
Buka browser → ketik: `http://localhost/parkir-cafe/`

---

# 🔐 Login untuk Setiap Role

## ADMIN
- **Username**: `admin`
- **Password**: `password`
- **Fitur**: CRUD semua data (Users, Tarif, Area, Kendaraan)

## PETUGAS
- **Username**: `petugas1`
- **Password**: `password`
- **Fitur**: Input kendaraan masuk/keluar + Cetak struk

## OWNER
- **Username**: `owner`
- **Password**: `password`
- **Fitur**: Lihat laporan & statistik pendapatan

---

# 📝 Cara Tambah Kendaraan Parkir (PETUGAS)

### Step 1: Login sebagai Petugas
```
Username: petugas1
Password: password
```

### Step 2: Kendaraan Masuk
1. Klik menu **"🚗 Kendaraan Masuk"**
2. Isi form:
   ```
   No. Polisi: B 9999 XYZ
   Jenis: Motor (atau Mobil/Bus/Truk)
   Merk: Honda Beat
   Warna: Hitam
   Nama Pemilik: John Doe
   No. Telp: 08123456789
   Area Parkir: Pilih area yang tersedia
   ```
3. Klik **"✓ Proses Masuk"**
4. **CATAT KODE TIKET** yang muncul (contoh: PKR-20260211-ABC123)

### Step 3: Kendaraan Keluar
1. Klik menu **"🚙 Kendaraan Keluar"**
2. Masukkan **KODE TIKET** yang tadi dicatat
3. Klik **"🔍 Cari Tiket"**
4. Lihat detail parkir & total bayar (otomatis dihitung)
5. Klik **"✓ Konfirmasi Pembayaran"**

### Step 4: Cetak Struk ✨ (FITUR BARU!)
Setelah konfirmasi pembayaran:
- Akan muncul **STRUK PARKIR** dengan desain modern
- Klik **"🖨️ Cetak Struk"** untuk print
- Atau klik **"← Kembali ke Dashboard"** untuk lanjut transaksi

**Fitur Struk:**
- ✅ Desain modern dengan barcode
- ✅ Info lengkap (tiket, kendaraan, waktu, durasi, total)
- ✅ Print-friendly (otomatis hide tombol saat print)
- ✅ Gradient background yang keren

---

# 🎯 Test Flow Lengkap

1. **Login Petugas** → Input kendaraan masuk → Catat kode tiket
2. **Proses Keluar** → Masukkan kode tiket → Konfirmasi bayar
3. **Cetak Struk** → Klik tombol cetak
4. **Logout** → Login sebagai **Owner** → Lihat laporan (transaksi tadi muncul!)

---

# ❓ Troubleshooting

**Database Error?**
- Pastikan MySQL di XAMPP running
- Pastikan database `parkir_cafe` sudah di-import

**Page Not Found?**
- Pastikan Apache di XAMPP running
- Cek folder ada di `c:\xampp\htdocs\parkir-cafe`

**Login Gagal?**
- Cek username & password (case-sensitive)
- Pastikan database sudah di-import

---

**Selamat mencoba! 🎉**
