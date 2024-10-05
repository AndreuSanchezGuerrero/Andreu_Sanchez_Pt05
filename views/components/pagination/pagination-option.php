<?php
// Andreu Sánchez Guerrero
// Obtenir el nombre d'articles per pàgina, si no s'ha especificat, mostrar 5 per defecte
$articlesPerPage = CustomSessionHandler::get('articlesPerPage') ? CustomSessionHandler::get('articlesPerPage') : 5;
$totalArticles = $controller->countArticles(); 
$totalPages = ceil($totalArticles / $articlesPerPage);

// Determinar la pàgina actual
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Agafar la pàgina de la URL o establir per defecte 1

// Verificar si el valor de la pàgina és un número enter vàlid i dins del rang de pàgines
if (!filter_var($page, FILTER_VALIDATE_INT) || $page < 1 || $page > $totalPages) {
    // Si no és un enter vàlid o està fora de rang, redirigir a la pàgina 1
    header("Location: " . $_SERVER['PHP_SELF'] . "?page=1");
    exit();
}

// Calcular l'offset per a obtenir els articles de la pàgina actual
$offset = ($page - 1) * $articlesPerPage;

// Obtener los artículos correspondientes a la página actual
$articles = $controller->getArticlesByPage($articlesPerPage, $offset);
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-pagination">
    <label for="articlesPerPage">Mostrar</label>
    <select name="articlesPerPage" id="articlesPerPage" onchange="this.form.submit()">
        <option value="5" <?php if ($articlesPerPage == 5) echo 'selected'; ?>>5</option>
        <option value="10" <?php if ($articlesPerPage == 10) echo 'selected'; ?>>10</option>
        <option value="20" <?php if ($articlesPerPage == 20) echo 'selected'; ?>>20</option>
        <option value="50" <?php if ($articlesPerPage == 50) echo 'selected'; ?>>50</option>
    </select>
    <label for="articlesPerPage">articles per pàgina</label>

    <!-- Camp ocult per identificar el fromulari de paginació -->
    <input type="hidden" name="form_type" value="pagination">

    <!-- Campo ocult per mantenirse a la pàgina actual, la pasarem per post i en el header afegim el seu valor -->
    <input type="hidden" name="page" value="<?php echo isset($page) ? $page : 1; ?>">
</form>



<?php                        
// Verificar qué formulario ha sido enviado mediante el campo oculto "form_type"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type']) && $_POST['form_type'] == 'pagination') {
        // Si se envió el formulario de paginación
        CustomSessionHandler::set('articlesPerPage', (int)$_POST['articlesPerPage']);
        // Redirigir a la página actual amb el valor del input "page"
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=" . $_POST['page']);
        exit();
    } elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'article_form') {
        include 'controllers/form-data-control.php';
    }
}
?>