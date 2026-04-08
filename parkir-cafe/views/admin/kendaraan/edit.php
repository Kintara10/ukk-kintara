<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h1>Edit Kendaraan</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= BASE_URL ?>admin/updateKendaraan/<?= $kendaraan['id'] ?>" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="no_polisi">No. Polisi *</label>
                    <input type="text" id="no_polisi" name="no_polisi" value="<?= $kendaraan['no_polisi'] ?>" required style="text-transform: uppercase;">
                </div>
                
                <div class="form-group">
                    <label for="jenis_kendaraan">Jenis Kendaraan *</label>
                    <select id="jenis_kendaraan" name="jenis_kendaraan" required>
                        <option value="motor" <?= $kendaraan['jenis_kendaraan'] == 'motor' ? 'selected' : '' ?>>Motor</option>
                        <option value="mobil" <?= $kendaraan['jenis_kendaraan'] == 'mobil' ? 'selected' : '' ?>>Mobil</option>
                        <option value="bus" <?= $kendaraan['jenis_kendaraan'] == 'bus' ? 'selected' : '' ?>>Bus</option>
                        <option value="truk" <?= $kendaraan['jenis_kendaraan'] == 'truk' ? 'selected' : '' ?>>Truk</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="merk">Merk</label>
                    <input type="text" id="merk" name="merk" value="<?= $kendaraan['merk'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" id="warna" name="warna" value="<?= $kendaraan['warna'] ?>">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik</label>
                    <input type="text" id="nama_pemilik" name="nama_pemilik" value="<?= $kendaraan['nama_pemilik'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="no_telp_pemilik">No. Telepon Pemilik</label>
                    <input type="text" id="no_telp_pemilik" name="no_telp_pemilik" value="<?= $kendaraan['no_telp_pemilik'] ?>">
                </div>
            </div>
            
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= BASE_URL ?>admin/kendaraan" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
