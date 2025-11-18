<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aunt Joy Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/AuntJoyRestaurant/assets/css/admin.css">
</head>
<body>
<header>
    <h1>Aunt Joy Admin Panel</h1>
    <nav>
        <a href="/AuntJoyRestaurant/index.php?r=admin/dashboard/index">Dashboard</a>
    </nav>
</header>

<main>
    <?php echo $content ?? ''; ?>
</main>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Aunt Joy Restaurant – Admin</p>
</footer>
</body>
</html>
