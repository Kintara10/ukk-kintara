<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h1>Tambah Kendaraan</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= BASE_URL ?>admin/storeKendaraan" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="no_polisi">No. Polisi *</label>
                    <input type="text" id="no_polisi" name="no_polisi" required placeholder="B 1234 XYZ" style="text-transform: uppercase;">
                </div>
                
                <div class="form-group">
                    <label for="jenis_kendaraan">Jenis Kendaraan *</label>
                    <select id="jenis_kendaraan" name="jenis_kendaraan" required>
                        <option value="">Pilih Jenis</option>
                        <option value="motor">Motor</option>
                        <option value="mobil">Mobil</option>
                        <option value="bus">Bus</option>
                        <option value="truk">Truk</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="merk">Merk</label>
                    <input type="text" id="merk" name="merk">
                </div>
                
                <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" id="warna" name="warna">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik</label>
                    <input type="text" id="nama_pemilik" name="nama_pemilik">
                </div>
                
                <div class="form-group">
                    <label for="no_telp_pemilik">No. Telepon Pemilik</label>
                    <input type="text" id="no_telp_pemilik" name="no_telp_pemilik">
                </div>
            </div>
            
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL ?>admin/kendaraan" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
