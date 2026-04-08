<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Kelola Area Parkir</h1>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Area Parkir</h3>
        <a href="<?= BASE_URL ?>admin/createArea" class="btn btn-primary">+ Tambah Area</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Area</th>
                        <th>Kode</th>
                        <th>Kapasitas</th>
                        <th>Terisi</th>
                        <th>Jenis Kendaraan</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($areas as $area): ?>
                    <tr>
                        <td><?= $area['id'] ?></td>
                        <td><?= $area['nama_area'] ?></td>
                        <td><span class="badge badge-info"><?= $area['kode_area'] ?></span></td>
                        <td><?= $area['kapasitas'] ?></td>
                        <td><?= $area['terisi'] ?></td>
                        <td><?= ucfirst($area['jenis_kendaraan']) ?></td>
                        <td><?= $area['lokasi'] ?></td>
                        <td>
                            <?php if ($area['status'] == 'aktif'): ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-danger"><?= ucfirst($area['status']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= BASE_URL ?>admin/editArea/<?= $area['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= BASE_URL ?>admin/deleteArea/<?= $area['id'] ?>" 
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
