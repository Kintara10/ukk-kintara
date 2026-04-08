# 🔧 Cara Fix Error "Tarif tidak ditemukan"

## Masalah:
Error muncul karena database belum punya tarif untuk **Bus** dan **Truk**.

## Solusi Cepat:

### Opsi 1: Re-import Database (RECOMMENDED)
1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Klik database **parkir_cafe** (di sidebar kiri)
3. Klik tab **"Operations"** (di atas)
4. Scroll ke bawah, klik **"Drop the database (DROP)"**
5. Konfirmasi **OK**
6. Klik tab **"Databases"** (di atas)
7. Buat database baru: `parkir_cafe` → Klik **Create**
8. Klik database **parkir_cafe** yang baru
9. Klik tab **"Import"**
10. Pilih file: `database.sql`
11. Klik **"Go"**

✅ **Selesai! Sekarang semua tarif sudah ada.**

---

### Opsi 2: Tambah Manual via phpMyAdmin (CEPAT)
1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Klik database **parkir_cafe**
3. Klik tabel **tarif_parkir**
4. Klik tab **"Insert"**
5. Isi data:
   ```
   jenis_kendaraan: bus
   tarif_per_jam: 10000
   tarif_harian: 80000
   denda_kehilangan: 200000
   keterangan: Tarif parkir bus
   status: aktif
   ```
6. Klik **"Go"**
7. Ulangi untuk **truk**:
   ```
   jenis_kendaraan: truk
   tarif_per_jam: 10000
   tarif_harian: 80000
   denda_kehilangan: 200000
   keterangan: Tarif parkir truk
   status: aktif
   ```
8. Klik **"Go"**

✅ **Selesai!**

---

### Opsi 3: Tambah via Admin Dashboard (PALING MUDAH!)
1. Login sebagai **admin**: `admin` / `password`
2. Klik menu **"💰 Tarif Parkir"**
3. Klik **"+ Tambah Tarif"**
4. Isi form untuk **Bus**:
   ```
   Jenis Kendaraan: Bus
   Tarif per Jam: 10000
   Tarif Harian: 80000
   Denda Kehilangan: 200000
   Status: Aktif
   ```
5. Klik **"Simpan"**
6. Ulangi untuk **Truk**
7. Klik **"Simpan"**

✅ **Selesai! Sekarang bisa input kendaraan bus/truk.**

---

## Setelah Fix:
1. Logout dari petugas
2. Login lagi: `petugas1` / `password`
3. Coba input kendaraan (motor/mobil/bus/truk)
4. **Error sudah hilang!** ✅

---

## Tarif yang Sekarang Ada:

| Jenis | Per Jam | Harian | Denda Hilang |
|-------|---------|--------|--------------|
| Motor | Rp 2.000 | Rp 15.000 | Rp 50.000 |
| Mobil | Rp 5.000 | Rp 40.000 | Rp 100.000 |
| Bus | Rp 10.000 | Rp 80.000 | Rp 200.000 |
| Truk | Rp 10.000 | Rp 80.000 | Rp 200.000 |

**Pilih salah satu opsi di atas, yang paling mudah Opsi 3 (via Admin Dashboard)!** 🚀
