<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Log Aktivitas</h1>
    <p>Riwayat transaksi parkir</p>
</div>

<div class="card">
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
                        <th>Petugas Masuk</th>
                        <th>Petugas Keluar</th>
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
                        <td><?= $trans['petugas_masuk'] ?></td>
                        <td><?= $trans['petugas_keluar'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
