<!DOCTYPE html>
<!-- Andreu Sánchez Guerrero -->
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió d'Articles</title>
    <link rel="stylesheet" href="views/layout.css">
    <script defer src="views/components/alert/alert.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
</head>
<body>  
    <main>
        <?php include 'components/alert/alert.php'; ?>

        <div class="container">
            <?php include 'components/header/header.php'; ?>
            <?php if ($userId): ?>
                <?php include 'components/form/form.php'; ?>
            <?php endif; ?>
            <?php include 'components/books/books.php'; ?>
            <?php include 'components/footer/footer.php'; ?>
        </div>
    </main>
</body>
</html>