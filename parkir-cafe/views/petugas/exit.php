<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Kendaraan Keluar</h1>
    <p>Proses kendaraan keluar dan pembayaran</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= BASE_URL ?>petugas/searchTicket" method="POST">
            <div class="form-group">
                <label for="kode_tiket">Masukkan Kode Tiket *</label>
                <input type="text" id="kode_tiket" name="kode_tiket" placeholder="PKR-20260211-XXXXXX" required style="text-transform: uppercase; font-size: 18px; padding: 16px;">
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">🔍 Cari Tiket</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
