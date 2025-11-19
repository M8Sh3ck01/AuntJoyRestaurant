<?php
require_once __DIR__ . '/../../includes/auth.php';

$error   = $_SESSION['error']   ?? null;
$success = $_SESSION['success'] ?? null;
unset($_SESSION['error'], $_SESSION['success']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login - Aunt Joy Restaurant</title>
    <style>
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; margin: 2rem; }
        nav a { margin-right: 1rem; }
        .page { max-width: 420px; }
        .error { color: #b00020; margin-bottom: 1rem; }
        .success { color: #006400; margin-bottom: 1rem; }
        .field { margin-bottom: 0.75rem; }
        label span { display: inline-block; min-width: 80px; }
    </style>
</head>
<body>
<nav>
    <a href="index.php?page=menu">Home</a>
    <?php if (isLoggedIn()): ?>
        <span>Signed in as <?php echo htmlspecialchars(getUserName()); ?></span>
        <a href="index.php?page=logout">Logout</a>
    <?php else: ?>
        <strong>Login</strong>
    <?php endif; ?>
</nav>
<hr>

<div class="page">
    <h1>Sign in</h1>
    <p>Use your email and password. Access is based on your role (customer, admin, sales, manager).</p>

    <?php if ($success): ?>
        <div class="success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?page=login_submit">
        <div class="field">
            <label>
                <span>Email</span>
                <input type="email" name="email" required autofocus>
            </label>
        </div>
        <div class="field">
            <label>
                <span>Password</span>
                <input type="password" name="password" required>
            </label>
        </div>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>

