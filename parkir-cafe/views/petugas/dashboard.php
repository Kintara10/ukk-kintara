<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Dashboard Petugas</h1>
    <p>Selamat datang, <?= $_SESSION['nama_lengkap'] ?></p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Kendaraan Parkir</span>
            <div class="stat-card-icon" style="background: #dbeafe;">
                <span style="font-size: 20px;">🚗</span>
            </div>
        </div>
        <div class="stat-card-value"><?= count($active_sessions) ?></div>
        <div class="stat-card-footer">Sedang parkir</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Pendapatan Hari Ini</span>
            <div class="stat-card-icon" style="background: #dcfce7;">
                <span style="font-size: 20px;">💰</span>
            </div>
        </div>
        <div class="stat-card-value">Rp <?= number_format($today_revenue, 0, ',', '.') ?></div>
        <div class="stat-card-footer">Total transaksi</div>
    </div>
</div>

<div class="d-flex gap-2 mb-3">
    <a href="<?= BASE_URL ?>petugas/entry" class="btn btn-success">🚗 Kendaraan Masuk</a>
    <a href="<?= BASE_URL ?>petugas/exit" class="btn btn-warning">🚙 Kendaraan Keluar</a>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Status Area Parkir</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Area</th>
                        <th>Kode</th>
                        <th>Kapasitas</th>
                        <th>Terisi</th>
                        <th>Tersedia</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($area_stats as $area): ?>
                    <tr>
                        <td><?= $area['nama_area'] ?></td>
                        <td><span class="badge badge-info"><?= $area['kode_area'] ?></span></td>
                        <td><?= $area['kapasitas'] ?></td>
                        <td><?= $area['terisi'] ?></td>
                        <td><?= $area['tersedia'] ?></td>
                        <td>
                            <?php if ($area['persentase_terisi'] >= 90): ?>
                                <span class="badge badge-danger">Hampir Penuh</span>
                            <?php elseif ($area['persentase_terisi'] >= 70): ?>
                                <span class="badge badge-warning">Cukup Penuh</span>
                            <?php else: ?>
                                <span class="badge badge-success">Tersedia</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Kendaraan Sedang Parkir</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Kode Tiket</th>
                        <th>No. Polisi</th>
                        <th>Jenis</th>
                        <th>Area</th>
                        <th>Waktu Masuk</th>
                        <th>Durasi</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($active_sessions as $session): ?>
                    <?php
                        $waktuMasuk = new DateTime($session['waktu_masuk']);
                        $sekarang = new DateTime();
                        $durasi = $waktuMasuk->diff($sekarang);
                        $durasiText = $durasi->h . ' jam ' . $durasi->i . ' menit';
                    ?>
                    <tr>
                        <td><span class="badge badge-info"><?= $session['kode_tiket'] ?></span></td>
                        <td><?= $session['no_polisi'] ?></td>
                        <td><?= ucfirst($session['jenis_kendaraan']) ?></td>
                        <td><?= $session['nama_area'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($session['waktu_masuk'])) ?></td>
                        <td><?= $durasiText ?></td>
                        <td><?= $session['petugas_masuk'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
