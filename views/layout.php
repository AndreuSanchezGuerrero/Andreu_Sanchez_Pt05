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
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
    <?php if ($isAdmin): ?>
        <link rel="stylesheet" href="views/admin/users.css">
    <?php endif; ?>

</head>
<body>  
    <main>
        <?php include 'components/alert/alert.php'; ?>
        <div class="container">
            <?php include 'components/header/header.php'; ?>
            <?php if (!$isAdmin): ?>
                <?php if ($userId && !$isAdmin): ?>
                    <?php include 'components/form/form.php'; ?>
                <?php endif; ?>
                <?php include 'components/books/books.php'; ?>
            <?php else: ?>
                <?php include 'admin/users.php'; ?>
                <?php endif; ?>    
                <?php include 'components/footer/footer.php'; ?>
        </div>
    </main>

    <script src="views/components/shared/sessionTimeout.js"></script>
</body>
</html>