<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Dashboard Owner</h1>
    <p>Selamat datang, <?= $_SESSION['nama_lengkap'] ?></p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Pendapatan Hari Ini</span>
            <div class="stat-card-icon" style="background: #dcfce7;">
                <span style="font-size: 20px;">💰</span>
            </div>
        </div>
        <div class="stat-card-value">Rp <?= number_format($today_revenue, 0, ',', '.') ?></div>
        <div class="stat-card-footer">Total transaksi hari ini</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Pendapatan Bulan Ini</span>
            <div class="stat-card-icon" style="background: #dbeafe;">
                <span style="font-size: 20px;">📊</span>
            </div>
        </div>
        <div class="stat-card-value">Rp <?= number_format($monthly_revenue, 0, ',', '.') ?></div>
        <div class="stat-card-footer">Total bulan <?= date('F Y') ?></div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Total Transaksi</span>
            <div class="stat-card-icon" style="background: #fef3c7;">
                <span style="font-size: 20px;">📋</span>
            </div>
        </div>
        <div class="stat-card-value"><?= $revenue_stats['total_transaksi'] ?></div>
        <div class="stat-card-footer">Transaksi selesai</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Kendaraan Parkir</span>
            <div class="stat-card-icon" style="background: #fee2e2;">
                <span style="font-size: 20px;">🚗</span>
            </div>
        </div>
        <div class="stat-card-value"><?= $active_sessions ?></div>
        <div class="stat-card-footer">Sedang parkir</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pendapatan per Jenis Kendaraan</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Jenis Kendaraan</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Pendapatan</th>
                        <th>Rata-rata</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($revenue_by_type as $type): ?>
                    <tr>
                        <td><?= ucfirst($type['jenis_kendaraan']) ?></td>
                        <td><?= $type['jumlah_transaksi'] ?></td>
                        <td>Rp <?= number_format($type['total_pendapatan'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($type['total_pendapatan'] / $type['jumlah_transaksi'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
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
                        <th>Kapasitas</th>
                        <th>Terisi</th>
                        <th>Tersedia</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($area_stats as $area): ?>
                    <tr>
                        <td><?= $area['nama_area'] ?></td>
                        <td><?= $area['kapasitas'] ?></td>
                        <td><?= $area['terisi'] ?></td>
                        <td><?= $area['tersedia'] ?></td>
                        <td>
                            <div style="background: #e5e7eb; border-radius: 10px; height: 20px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #667eea, #764ba2); height: 100%; width: <?= $area['persentase_terisi'] ?>%;"></div>
                            </div>
                            <small><?= $area['persentase_terisi'] ?>%</small>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="text-center mt-3">
    <a href="<?= BASE_URL ?>owner/reports" class="btn btn-primary">📈 Lihat Laporan Lengkap</a>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
