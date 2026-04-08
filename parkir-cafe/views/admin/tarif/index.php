<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Kelola Tarif Parkir</h1>
    <p>Manajemen tarif parkir</p>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Tarif Parkir</h3>
        <a href="<?= BASE_URL ?>admin/createTarif" class="btn btn-primary">+ Tambah Tarif</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis Kendaraan</th>
                        <th>Tarif per Jam</th>
                        <th>Tarif Harian</th>
                        <th>Denda Kehilangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarif as $t): ?>
                    <tr>
                        <td><?= $t['id'] ?></td>
                        <td><?= ucfirst($t['jenis_kendaraan']) ?></td>
                        <td>Rp <?= number_format($t['tarif_per_jam'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($t['tarif_harian'], 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($t['denda_kehilangan'], 0, ',', '.') ?></td>
                        <td>
                            <?php if ($t['status'] == 'aktif'): ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= BASE_URL ?>admin/editTarif/<?= $t['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= BASE_URL ?>admin/deleteTarif/<?= $t['id'] ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirmDelete()">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
