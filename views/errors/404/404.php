<?php
    require_once __DIR__ . '/../../../config/env.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/errors/404/404.css">
</head>
<body>
    <main>
        <h1>404</h1>
        <p>Oops! We can't find that page.</p>
        <a href="/" class="btn">Volver al inicio</a>
    </main>
    <footer>
        <p>© 2024 Kelsier Library</p>
    </footer>
</body>
</html>
