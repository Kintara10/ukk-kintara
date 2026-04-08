<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, <?= $_SESSION['nama_lengkap'] ?></p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Total User</span>
            <div class="stat-card-icon" style="background: #dbeafe;">
                <span style="font-size: 20px;">👥</span>
            </div>
        </div>
        <div class="stat-card-value"><?= $total_users ?></div>
        <div class="stat-card-footer">Terdaftar di sistem</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Total Kendaraan</span>
            <div class="stat-card-icon" style="background: #d1fae5;">
                <span style="font-size: 20px;">🚗</span>
            </div>
        </div>
        <div class="stat-card-value"><?= $total_vehicles ?></div>
        <div class="stat-card-footer">Kendaraan terdaftar</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Parkir Aktif</span>
            <div class="stat-card-icon" style="background: #fef3c7;">
                <span style="font-size: 20px;">🅿️</span>
            </div>
        </div>
        <div class="stat-card-value"><?= $total_occupied ?> / <?= $total_capacity ?></div>
        <div class="stat-card-footer">Kendaraan sedang parkir</div>
    </div>
    
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
                        <th>Nama Area</th>
                        <th>Kode</th>
                        <th>Kapasitas</th>
                        <th>Terisi</th>
                        <th>Tersedia</th>
                        <th>Persentase</th>
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
                            <div style="background: #e5e7eb; border-radius: 10px; height: 20px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #667eea, #764ba2); height: 100%; width: <?= $area['persentase_terisi'] ?>%;"></div>
                            </div>
                            <small><?= $area['persentase_terisi'] ?>%</small>
                        </td>
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
        <h3 class="card-title">Transaksi Terakhir</h3>
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
                        <th>Waktu Keluar</th>
                        <th>Durasi</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_transactions as $trans): ?>
                    <tr>
                        <td><span class="badge badge-info"><?= $trans['kode_tiket'] ?></span></td>
                        <td><?= $trans['no_polisi'] ?></td>
                        <td><?= ucfirst($trans['jenis_kendaraan']) ?></td>
                        <td><?= $trans['nama_area'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($trans['waktu_keluar'])) ?></td>
                        <td><?= number_format($trans['durasi_jam'], 2) ?> jam</td>
                        <td>Rp <?= number_format($trans['total_bayar'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
