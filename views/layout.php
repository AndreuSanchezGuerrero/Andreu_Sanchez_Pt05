<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió d'Articles</title>
    <link rel="stylesheet" href="views/layout.css">
    <link rel="stylesheet" href="views/components/form/from.css">
    <link rel="stylesheet" href="views/components/pagination/pagination.css">
    <link rel="stylesheet" href="views/components/articles/articles.css">
    <link rel="stylesheet" href="views/components/alert/alert.css">
    <link rel="stylesheet" href="views/components/footer/footer.css">
    <script defer src="views/components/alert/alert.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
</head>
<body>  
    <main>
        <?php
        // Si en algun moment s'ha enviat el formulari, comprovar si hi ha errors o si s'ha enviat correctament
        if (CustomSessionHandler::get('success') === true) {
            $success = true;
            CustomSessionHandler::remove('success');
        } elseif (CustomSessionHandler::get('success') === false) {
            $errors = CustomSessionHandler::get('errors');
            CustomSessionHandler::remove('success');
            CustomSessionHandler::remove('errors');
        }
        ?>

        <!-- Contenidor d'alertes -->
        <?php include 'components/alert/alert.php'; ?>

        <div class="container">

            <!-- Incluir componente de formulario -->
            <?php include 'components/form/form.php'; ?>

            <!-- Incluir componente de paginación -->
            <?php include 'components/pagination/pagination-option.php'; ?>

            <!-- Columna dels Articles -->
            <?php include 'components/articles/articles.php'; ?>
        </div>
    </main>
    <footer>
        <?php include 'components/footer/footer.php'; ?>
    </footer>
</body>
</html>