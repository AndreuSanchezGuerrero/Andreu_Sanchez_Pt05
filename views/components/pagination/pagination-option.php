<?php
// Obtenir el nombre d'articles per pàgina, si no s'ha especificat, mostrar 5 per defecte
$articlesPerPage = CustomSessionHandler::get('articlesPerPage') ? CustomSessionHandler::get('articlesPerPage') : 5;
$totalArticles = $controller->countArticles(); // Obtenir el número total d'articles
$totalPages = ceil($totalArticles / $articlesPerPage); // Calcular el número total de páginas. Arrodonir cap amunt amb ceil

// Determinar la pàgina actual
$page = isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT) ? $_GET['page'] : 1; // Si no s'especifica la pàgina, mostrar la primera. Filtrem per a que sigui un número enter vàlid
// Si la pàgina es més petita que 1 o es més gran que el màxim de pàgines, tornem a la primera.
if ($page < 1 || $page > $totalPages) header("Location: " . $_SERVER['PHP_SELF'] . "?page=1");

// Calcular l'offset per a obtenir els articles de la pàgina actual, per exemple, si estem a la pàgina 3, l'offset serà 10, i agafarem els articles de la posició 10 fins a articlesPerPage
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

    <!-- Campo oculto para identificar que este es el formulario de paginación -->
    <input type="hidden" name="form_type" value="pagination">

    <!-- Campo oculto para mantener la página actual -->
    <input type="hidden" name="page" value="<?php echo isset($page) ? $page : 1; ?>">
</form>



<?php                        
// Verificar qué formulario ha sido enviado mediante el campo oculto "form_type"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type']) && $_POST['form_type'] == 'pagination') {
        // Si se envió el formulario de paginación
        CustomSessionHandler::set('articlesPerPage', (int)$_POST['articlesPerPage']);
        // Redirigir a la página actual
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=" . $_POST['page']);
        exit();
    } elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'article_form') {
        include 'controllers/form-data-control.php';
    }
}
?>