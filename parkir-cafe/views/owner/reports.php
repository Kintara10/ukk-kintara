<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Laporan Transaksi</h1>
    <p>Laporan pendapatan parkir</p>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Filter Laporan</h3>
    </div>
    <div class="card-body">
        <form action="<?= BASE_URL ?>owner/reports" method="GET">
            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" value="<?= $start_date ?>">
                </div>
                
                <div class="form-group">
                    <label for="end_date">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" value="<?= $end_date ?>">
                </div>
                
                <div class="form-group" style="display: flex; align-items: flex-end;">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Total Transaksi</span>
            <div class="stat-card-icon" style="background: #dbeafe;">
                <span style="font-size: 20px;">📋</span>
            </div>
        </div>
        <div class="stat-card-value"><?= $revenue_stats['total_transaksi'] ?></div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Total Pendapatan</span>
            <div class="stat-card-icon" style="background: #dcfce7;">
                <span style="font-size: 20px;">💰</span>
            </div>
        </div>
        <div class="stat-card-value">Rp <?= number_format($revenue_stats['total_pendapatan'], 0, ',', '.') ?></div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Rata-rata Pendapatan</span>
            <div class="stat-card-icon" style="background: #fef3c7;">
                <span style="font-size: 20px;">📊</span>
            </div>
        </div>
        <div class="stat-card-value">Rp <?= number_format($revenue_stats['rata_rata'], 0, ',', '.') ?></div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Rata-rata Durasi</span>
            <div class="stat-card-icon" style="background: #fee2e2;">
                <span style="font-size: 20px;">⏱️</span>
            </div>
        </div>
        <div class="stat-card-value"><?= number_format($revenue_stats['rata_durasi'], 2) ?> jam</div>
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($revenue_by_type as $type): ?>
                    <tr>
                        <td><?= ucfirst($type['jenis_kendaraan']) ?></td>
                        <td><?= $type['jumlah_transaksi'] ?></td>
                        <td>Rp <?= number_format($type['total_pendapatan'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Transaksi</h3>
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
                        <th>Waktu Keluar</th>
                        <th>Durasi</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $trans): ?>
                    <tr>
                        <td><span class="badge badge-info"><?= $trans['kode_tiket'] ?></span></td>
                        <td><?= $trans['no_polisi'] ?></td>
                        <td><?= ucfirst($trans['jenis_kendaraan']) ?></td>
                        <td><?= $trans['nama_area'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($trans['waktu_masuk'])) ?></td>
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
