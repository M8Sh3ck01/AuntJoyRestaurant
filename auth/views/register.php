<?php
require_once __DIR__ . '/../../includes/auth.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register - Aunt Joy Restaurant</title>
    <style>
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; margin: 2rem; }
        nav a { margin-right: 1rem; }
        .page { max-width: 480px; }
        .error { color: #b00020; margin-bottom: 1rem; }
        .field { margin-bottom: 0.75rem; }
        label span { display: inline-block; min-width: 120px; }
    </style>
</head>
<body>
<nav>
    <a href="index.php?page=menu">Home</a>
    <a href="index.php?page=login">Login</a>
</nav>
<hr>

<?php
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<div class="page">
    <h1>Create a customer account</h1>
    <p>This form registers a new customer. Admin, sales, and manager accounts should be created by an administrator.</p>

    <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?page=register_submit">
        <div class="field">
            <label>
                <span>Full name</span>
                <input type="text" name="name" required>
            </label>
        </div>
        <div class="field">
            <label>
                <span>Email</span>
                <input type="email" name="email" required>
            </label>
        </div>
        <div class="field">
            <label>
                <span>Password</span>
                <input type="password" name="password" required>
            </label>
        </div>
        <div class="field">
            <label>
                <span>Confirm password</span>
                <input type="password" name="confirm_password" required>
            </label>
        </div>
        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>

