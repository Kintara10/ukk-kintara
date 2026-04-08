<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Parkir Cafe' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Parkir Cafe</h2>
                <p><?= ucfirst($_SESSION['role']) ?> Panel</p>
            </div>
            
            <nav class="sidebar-menu">
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="<?= BASE_URL ?>admin/dashboard" class="menu-item">📊 Dashboard</a>
                    <a href="<?= BASE_URL ?>admin/users" class="menu-item">👥 Kelola User</a>
                    <a href="<?= BASE_URL ?>admin/tarif" class="menu-item">💰 Tarif Parkir</a>
                    <a href="<?= BASE_URL ?>admin/area" class="menu-item">🅿️ Area Parkir</a>
                    <a href="<?= BASE_URL ?>admin/kendaraan" class="menu-item">🚗 Kendaraan</a>
                    <a href="<?= BASE_URL ?>admin/activityLog" class="menu-item">📋 Log Aktivitas</a>
                <?php elseif ($_SESSION['role'] == 'petugas'): ?>
                    <a href="<?= BASE_URL ?>petugas/dashboard" class="menu-item">📊 Dashboard</a>
                    <a href="<?= BASE_URL ?>petugas/entry" class="menu-item">🚗 Kendaraan Masuk</a>
                    <a href="<?= BASE_URL ?>petugas/exit" class="menu-item">🚙 Kendaraan Keluar</a>
                <?php elseif ($_SESSION['role'] == 'owner'): ?>
                    <a href="<?= BASE_URL ?>owner/dashboard" class="menu-item">📊 Dashboard</a>
                    <a href="<?= BASE_URL ?>owner/reports" class="menu-item">📈 Laporan</a>
                <?php endif; ?>
                
                <a href="<?= BASE_URL ?>auth/logout" class="menu-item" style="margin-top: 20px; color: var(--danger);">🚪 Logout</a>
            </nav>
        </aside>
        
        <main class="main-content">
