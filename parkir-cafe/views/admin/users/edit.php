<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="page-header">
    <h1>Edit User</h1>
    <p>Edit data user</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= BASE_URL ?>admin/updateUser/<?= $user['id'] ?>" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="username">Username *</label>
                    <input type="text" id="username" name="username" value="<?= $user['username'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" id="password" name="password">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap *</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= $user['nama_lengkap'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="role">Role *</label>
                    <select id="role" name="role" required>
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="petugas" <?= $user['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
                        <option value="owner" <?= $user['role'] == 'owner' ? 'selected' : '' ?>>Owner</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= $user['email'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="no_telp">No. Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" value="<?= $user['no_telp'] ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="aktif" <?= $user['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="nonaktif" <?= $user['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                </select>
            </div>
            
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= BASE_URL ?>admin/users" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>
