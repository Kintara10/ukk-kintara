<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?>">
        <?= $flash['message'] ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1>Kelola User</h1>
    <p>Manajemen user sistem</p>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar User</h3>
        <a href="<?= BASE_URL ?>admin/createUser" class="btn btn-primary">+ Tambah User</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['nama_lengkap'] ?></td>
                        <td><span class="badge badge-info"><?= ucfirst($user['role']) ?></span></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <?php if ($user['status'] == 'aktif'): ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?= BASE_URL ?>admin/editUser/<?= $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= BASE_URL ?>admin/deleteUser/<?= $user['id'] ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirmDelete('Hapus user <?= $user['username'] ?>?')">Hapus</a>
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
