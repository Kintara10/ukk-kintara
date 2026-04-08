<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h1>Tambah Area Parkir</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= BASE_URL ?>admin/storeArea" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_area">Nama Area *</label>
                    <input type="text" id="nama_area" name="nama_area" required>
                </div>
                
                <div class="form-group">
                    <label for="kode_area">Kode Area *</label>
                    <input type="text" id="kode_area" name="kode_area" required placeholder="A-MTR">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="kapasitas">Kapasitas *</label>
                    <input type="number" id="kapasitas" name="kapasitas" required min="1">
                </div>
                
                <div class="form-group">
                    <label for="jenis_kendaraan">Jenis Kendaraan *</label>
                    <select id="jenis_kendaraan" name="jenis_kendaraan" required>
                        <option value="semua">Semua</option>
                        <option value="motor">Motor</option>
                        <option value="mobil">Mobil</option>
                        <option value="bus">Bus</option>
                        <option value="truk">Truk</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi">
            </div>
            
            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL ?>admin/area" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
