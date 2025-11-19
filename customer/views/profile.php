<?php
require_once __DIR__ . '/../../includes/auth.php';
requireLogin();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Profile - Aunt Joy Restaurant</title>
</head>
<body>
<h1>My Profile (placeholder)</h1>
<p>Welcome, <?php echo htmlspecialchars(getUserName()); ?>. Member 1 will implement this page.</p>
</body>
</html>

