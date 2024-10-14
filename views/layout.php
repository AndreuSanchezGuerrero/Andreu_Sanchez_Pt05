<!DOCTYPE html>
<!-- Andreu Sánchez Guerrero -->
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió d'Articles</title>
    <link rel="stylesheet" href="views/layout.css">
    <link rel="stylesheet" href="views/components/form/from.css">
    <link rel="stylesheet" href="views/components/pagination/pagination.css">
    <link rel="stylesheet" href="views/components/books/books.css">
    <link rel="stylesheet" href="views/components/alert/alert.css">
    <link rel="stylesheet" href="views/components/footer/footer.css">
    <script defer src="views/components/alert/alert.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
</head>
<body>  
    <main>
        <!-- Contenidor d'alertes -->
        <?php include 'components/alert/alert.php'; ?>

        <div class="container">

            <!-- Formulari -->
            <?php include 'components/form/form.php'; ?>

            <!-- Paginació -->
            <?php include 'components/pagination/pagination-option.php'; ?>

            <!-- Articles -->
            <?php include 'components/books/books.php'; ?>
        </div>
    </main>
    <footer>
        <?php include 'components/footer/footer.php'; ?>
    </footer>
</body>
</html>