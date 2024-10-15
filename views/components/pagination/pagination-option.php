<?php
// Andreu Sánchez Guerrero
// Obtener el número de libros por página, si no se ha especificado, mostrar 5 por defecto
$booksPerPage = CustomSessionHandler::get('booksPerPage') ? CustomSessionHandler::get('booksPerPage') : 5;
$totalBooks = $bookController->countBooks(); // Cambiado a `countBooks()`
$totalPages = $totalBooks > 0 ? ceil($totalBooks / $booksPerPage) : 1;  // Siempre debe haber al menos 1 página 

// Determinar la página actual
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Obtener la página de la URL o establecer por defecto en 1

// Verificar si el valor de la página es un número entero válido y está dentro del rango de páginas
if (!filter_var($page, FILTER_VALIDATE_INT) || $page < 1 || $page > $totalPages) {
    // Si no es un entero válido o está fuera de rango, redirigir a la página 1
    header("Location: " . $_SERVER['PHP_SELF'] . "?page=1");
    exit();
}

// Calcular el offset para obtener los libros de la página actual
$offset = ($page - 1) * $booksPerPage;

// Obtener los libros correspondientes a la página actual
$books = $bookController->getBooksByPage($booksPerPage, $offset); // Cambiado a `getBooksByPage()`
?>



<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-pagination">
    <label for="booksPerPage">Show</label>
    <select name="booksPerPage" id="booksPerPage" onchange="this.form.submit()">
        <option value="5" <?php if ($booksPerPage == 5) echo 'selected'; ?>>5</option>
        <option value="10" <?php if ($booksPerPage == 10) echo 'selected'; ?>>10</option>
        <option value="20" <?php if ($booksPerPage == 20) echo 'selected'; ?>>20</option>
        <option value="50" <?php if ($booksPerPage == 50) echo 'selected'; ?>>50</option>
    </select>
    <label for="booksPerPage">books per page</label>

    <!-- Campo oculto para identificar el formulario de paginación -->
    <input type="hidden" name="form_type" value="pagination">

    <!-- Campo oculto para mantener la página actual -->
    <input type="hidden" name="page" value="<?php echo isset($page) ? $page : 1; ?>">
</form>




<?php                        
// Verificar qué formulario ha sido enviado mediante el campo oculto "form_type"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type']) && $_POST['form_type'] == 'pagination') {
        // Si se envió el formulario de paginación
        CustomSessionHandler::set('booksPerPage', (int)$_POST['booksPerPage']);
        // Redirigir a la página actual con el valor del input "page"
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=" . $_POST['page']);
        exit();
    } elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'book_form') {
        include 'controllers/form-data-control.php'; // Asegúrate de tener la lógica correcta en form-data-control.php
    }
}
?>
