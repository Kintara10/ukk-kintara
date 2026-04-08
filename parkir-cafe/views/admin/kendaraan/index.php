<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Kelola Kendaraan</h1>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Kendaraan</h3>
        <a href="<?= BASE_URL ?>admin/createKendaraan" class="btn btn-primary">+ Tambah Kendaraan</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>No. Polisi</th>
                        <th>Jenis</th>
                        <th>Merk</th>
                        <th>Warna</th>
                        <th>Pemilik</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kendaraan as $k): ?>
                    <tr>
                        <td><?= $k['id'] ?></td>
                        <td><strong><?= $k['no_polisi'] ?></strong></td>
                        <td><?= ucfirst($k['jenis_kendaraan']) ?></td>
                        <td><?= $k['merk'] ?></td>
                        <td><?= $k['warna'] ?></td>
                        <td><?= $k['nama_pemilik'] ?></td>
                        <td><?= $k['no_telp_pemilik'] ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= BASE_URL ?>admin/editKendaraan/<?= $k['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= BASE_URL ?>admin/deleteKendaraan/<?= $k['id'] ?>" 
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
