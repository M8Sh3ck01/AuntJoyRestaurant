<?php
require_once __DIR__ . '/../../includes/auth.php';

$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login - Aunt Joy Restaurant</title>
</head>
<body>
<h1>Login</h1>

<?php if ($error): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="post" action="index.php?page=login_submit">
    <div>
        <label>Email:
            <input type="email" name="email" required>
        </label>
    </div>
    <div>
        <label>Password:
            <input type="password" name="password" required>
        </label>
    </div>
    <button type="submit">Login</button>
</form>

</body>
</html>

