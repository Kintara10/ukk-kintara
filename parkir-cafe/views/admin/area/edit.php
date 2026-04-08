<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h1>Edit Area Parkir</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= BASE_URL ?>admin/updateArea/<?= $area['id'] ?>" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_area">Nama Area *</label>
                    <input type="text" id="nama_area" name="nama_area" value="<?= $area['nama_area'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="kode_area">Kode Area *</label>
                    <input type="text" id="kode_area" name="kode_area" value="<?= $area['kode_area'] ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="kapasitas">Kapasitas *</label>
                    <input type="number" id="kapasitas" name="kapasitas" value="<?= $area['kapasitas'] ?>" required min="1">
                </div>
                
                <div class="form-group">
                    <label for="jenis_kendaraan">Jenis Kendaraan *</label>
                    <select id="jenis_kendaraan" name="jenis_kendaraan" required>
                        <option value="semua" <?= $area['jenis_kendaraan'] == 'semua' ? 'selected' : '' ?>>Semua</option>
                        <option value="motor" <?= $area['jenis_kendaraan'] == 'motor' ? 'selected' : '' ?>>Motor</option>
                        <option value="mobil" <?= $area['jenis_kendaraan'] == 'mobil' ? 'selected' : '' ?>>Mobil</option>
                        <option value="bus" <?= $area['jenis_kendaraan'] == 'bus' ? 'selected' : '' ?>>Bus</option>
                        <option value="truk" <?= $area['jenis_kendaraan'] == 'truk' ? 'selected' : '' ?>>Truk</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" value="<?= $area['lokasi'] ?>">
            </div>
            
            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="aktif" <?= $area['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="nonaktif" <?= $area['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                    <option value="maintenance" <?= $area['status'] == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                </select>
            </div>
            
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= BASE_URL ?>admin/area" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
