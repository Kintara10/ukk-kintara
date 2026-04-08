<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Kendaraan Masuk</h1>
    <p>Input data kendaraan yang masuk parkir</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= BASE_URL ?>petugas/processEntry" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="no_polisi">No. Polisi *</label>
                    <input type="text" id="no_polisi" name="no_polisi" placeholder="B 1234 XYZ" required style="text-transform: uppercase;">
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
                    <input type="text" id="merk" name="merk" placeholder="Honda, Toyota, dll">
                </div>
                
                <div class="form-group">
                    <label for="warna">Warna</label>
                    <input type="text" id="warna" name="warna" placeholder="Hitam, Putih, dll">
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
            
            <div class="form-group">
                <label for="area_parkir_id">Area Parkir *</label>
                <select id="area_parkir_id" name="area_parkir_id" required>
                    <option value="">Pilih Area</option>
                    <?php foreach ($areas as $area): ?>
                        <?php if ($area['terisi'] < $area['kapasitas']): ?>
                            <option value="<?= $area['id'] ?>">
                                <?= $area['nama_area'] ?> (<?= $area['kode_area'] ?>) - 
                                Tersedia: <?= $area['kapasitas'] - $area['terisi'] ?> / <?= $area['kapasitas'] ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-success">✓ Proses Masuk</button>
                <a href="<?= BASE_URL ?>petugas/dashboard" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
