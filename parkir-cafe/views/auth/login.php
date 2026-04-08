<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Parkir Cafe' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                        <rect width="60" height="60" rx="12" fill="url(#gradient)"/>
                        <path d="M30 15L20 25V45H25V35H35V45H40V25L30 15Z" fill="white"/>
                        <defs>
                            <linearGradient id="gradient" x1="0" y1="0" x2="60" y2="60">
                                <stop offset="0%" stop-color="#667eea"/>
                                <stop offset="100%" stop-color="#764ba2"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
                <h1>Parkir Cafe</h1>
                <p>Sistem Manajemen Parkir</p>
            </div>
            
            <?php if ($flash): ?>
                <div class="alert alert-<?= $flash['type'] ?>">
                    <?= $flash['message'] ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= BASE_URL ?>auth/processLogin" method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            
            <div class="login-footer">
                <p class="demo-info">Demo Accounts:</p>
                <div class="demo-accounts">
                    <div class="demo-account">
                        <strong>Admin:</strong> admin / password
                    </div>
                    <div class="demo-account">
                        <strong>Petugas:</strong> petugas1 / password
                    </div>
                    <div class="demo-account">
                        <strong>Owner:</strong> owner / password
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?= BASE_URL ?>public/js/main.js"></script>
</body>
</html>
