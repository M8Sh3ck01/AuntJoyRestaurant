<?php
require_once __DIR__ . '/../../includes/auth.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Unauthorized - Aunt Joy Restaurant</title>
    <style>
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; margin: 2rem; }
        nav a { margin-right: 1rem; }
        .warning { color: #b00020; }
    </style>
</head>
<body>
<nav>
    <a href="index.php?page=menu">Home</a>
    <?php if (isLoggedIn()): ?>
        <span>Signed in as <?php echo htmlspecialchars(getUserName()); ?></span>
        <a href="index.php?page=logout">Logout</a>
    <?php else: ?>
        <a href="index.php?page=login">Login</a>
    <?php endif; ?>
</nav>
<hr>

<h1 class="warning">Unauthorized</h1>
<p>You do not have permission to access this page.</p>
<p>
    <?php if (!isLoggedIn()): ?>
        Please <a href="index.php?page=login">login</a> with an account that has the right role.
    <?php else: ?>
        Try going back to your main area:
        <?php $role = getUserRoleName(); ?>
        <?php if ($role === 'admin'): ?>
            <a href="index.php?page=admin/dashboard">Admin dashboard</a>
        <?php elseif ($role === 'sales'): ?>
            <a href="index.php?page=sales/orders">Sales orders</a>
        <?php elseif ($role === 'manager'): ?>
            <a href="index.php?page=manager/dashboard">Manager dashboard</a>
        <?php else: ?>
            <a href="index.php?page=menu">Customer menu</a>
        <?php endif; ?>
    <?php endif; ?>
</p>

</body>
</html>

