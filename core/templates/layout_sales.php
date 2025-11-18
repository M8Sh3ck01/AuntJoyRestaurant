<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aunt Joy Sales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/AuntJoyRestaurant/assets/css/sales.css">
</head>
<body>
<header>
    <h1>Aunt Joy Sales Panel</h1>
    <nav>
        <a href="/AuntJoyRestaurant/index.php?r=sales/order/index">Orders</a>
    </nav>
</header>

<main>
    <?php echo $content ?? ''; ?>
</main>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Aunt Joy Restaurant – Sales</p>
</footer>
</body>
</html>
