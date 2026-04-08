<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h1>Tambah Tarif Parkir</h1>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= BASE_URL ?>admin/storeTarif" method="POST">
            <div class="form-row">
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
                
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="tarif_per_jam">Tarif per Jam (Rp) *</label>
                    <input type="number" id="tarif_per_jam" name="tarif_per_jam" required min="0" step="100">
                </div>
                
                <div class="form-group">
                    <label for="tarif_harian">Tarif Harian (Rp) *</label>
                    <input type="number" id="tarif_harian" name="tarif_harian" required min="0" step="100">
                </div>
            </div>
            
            <div class="form-group">
                <label for="denda_kehilangan">Denda Kehilangan (Rp) *</label>
                <input type="number" id="denda_kehilangan" name="denda_kehilangan" required min="0" step="1000">
            </div>
            
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
            
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= BASE_URL ?>admin/tarif" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
