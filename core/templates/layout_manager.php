<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aunt Joy Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/AuntJoyRestaurant/assets/css/manager.css">
</head>
<body>
<header>
    <h1>Aunt Joy Manager Panel</h1>
    <nav>
        <a href="/AuntJoyRestaurant/index.php?r=manager/report/index">Reports</a>
    </nav>
</header>

<main>
    <?php echo $content ?? ''; ?>
</main>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Aunt Joy Restaurant – Manager</p>
</footer>
</body>
</html>
