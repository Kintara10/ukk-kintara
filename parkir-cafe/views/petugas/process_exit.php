<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php
    $waktuMasuk = new DateTime($transaksi['waktu_masuk']);
    $sekarang = new DateTime();
    $durasi = $waktuMasuk->diff($sekarang);
    $durasiJam = $durasi->days * 24 + $durasi->h + ($durasi->i / 60);
    
    // Calculate estimated fee
    require_once __DIR__ . '/../../models/TarifModel.php';
    $tarifModel = new TarifModel();
    $estimatedFee = $tarifModel->calculateFee($transaksi['tarif_id'], $durasiJam);
?>

<div class="page-header">
    <h1>Proses Kendaraan Keluar</h1>
    <p>Konfirmasi pembayaran parkir</p>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Parkir</h3>
    </div>
    <div class="card-body">
        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td style="padding: 10px; font-weight: 600;">Kode Tiket:</td>
                <td style="padding: 10px;"><span class="badge badge-info" style="font-size: 16px;"><?= $transaksi['kode_tiket'] ?></span></td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: 600;">No. Polisi:</td>
                <td style="padding: 10px; font-size: 18px; font-weight: 700;"><?= $transaksi['no_polisi'] ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: 600;">Jenis Kendaraan:</td>
                <td style="padding: 10px;"><?= ucfirst($transaksi['jenis_kendaraan']) ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: 600;">Merk / Warna:</td>
                <td style="padding: 10px;"><?= $transaksi['merk'] ?> / <?= $transaksi['warna'] ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: 600;">Area Parkir:</td>
                <td style="padding: 10px;"><?= $transaksi['nama_area'] ?> (<?= $transaksi['kode_area'] ?>)</td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: 600;">Waktu Masuk:</td>
                <td style="padding: 10px;"><?= date('d/m/Y H:i:s', strtotime($transaksi['waktu_masuk'])) ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: 600;">Waktu Sekarang:</td>
                <td style="padding: 10px;"><?= date('d/m/Y H:i:s') ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: 600;">Durasi Parkir:</td>
                <td style="padding: 10px; font-size: 18px; font-weight: 700; color: var(--primary);">
                    <?= $durasi->days > 0 ? $durasi->days . ' hari ' : '' ?>
                    <?= $durasi->h ?> jam <?= $durasi->i ?> menit
                    (<?= number_format($durasiJam, 2) ?> jam)
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: 600;">Tarif per Jam:</td>
                <td style="padding: 10px;">Rp <?= number_format($transaksi['tarif_per_jam'], 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: 600;">Tarif Harian:</td>
                <td style="padding: 10px;">Rp <?= number_format($transaksi['tarif_harian'], 0, ',', '.') ?></td>
            </tr>
            <tr style="background: var(--light);">
                <td style="padding: 15px; font-weight: 700; font-size: 18px;">TOTAL BAYAR:</td>
                <td style="padding: 15px; font-size: 24px; font-weight: 700; color: var(--success);">
                    Rp <?= number_format($estimatedFee, 0, ',', '.') ?>
                </td>
            </tr>
        </table>
        
        <form action="<?= BASE_URL ?>petugas/processExit" method="POST">
            <input type="hidden" name="transaksi_id" value="<?= $transaksi['id'] ?>">
            <input type="hidden" name="area_id" value="<?= $transaksi['area_parkir_id'] ?>">
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success btn-block">✓ Konfirmasi Pembayaran</button>
                <a href="<?= BASE_URL ?>petugas/exit" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
