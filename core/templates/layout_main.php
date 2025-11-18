<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aunt Joy Restaurant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/AuntJoyRestaurant/assets/css/style.css">
</head>
<body>
<header>
    <h1>Aunt Joy Restaurant</h1>
    <nav>
        <!-- Simple placeholder nav; modules can enhance later -->
        <a href="/AuntJoyRestaurant/">Home</a>
    </nav>
</header>

<main>
    <?php echo $content ?? ''; ?>
</main>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Aunt Joy Restaurant</p>
</footer>
</body>
</html>
