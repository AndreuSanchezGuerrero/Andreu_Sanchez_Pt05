<?php
// Andreu Sánchez Guerrero
// Obtener el número de libros por página, si no se ha especificado, mostrar 5 por defecto
$booksPerPage = CustomSessionHandler::get('booksPerPage') ?? 5;
$totalBooks = count($booksToUse); // Contar los libros que se están usando
$totalPages = $totalBooks > 0 ? ceil($totalBooks / $booksPerPage) : 1;  // Siempre debe haber al menos 1 página 

// Determinar la página actual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Obtener la página de la URL o establecer por defecto en 1

// Verificar si el valor de la página es un número entero válido y está dentro del rango de páginas
if (!filter_var($page, FILTER_VALIDATE_INT) || $page < 1 || $page > $totalPages) {
    // Si no es un entero válido o está fuera de rango, redirigir a la página 1
    header("Location: " . $_SERVER['PHP_SELF'] . "?page=1");
    exit();
}

// Calcular el offset para obtener los libros de la página actual
$offset = ($page - 1) * $booksPerPage;

// Obtener los libros correspondientes a la página actual
$booksToShow = $bookController->getBooksByPage($booksPerPage, $offset, CustomSessionHandler::get('user_id')); // Cambiado a getBooksByPage()

// Verificar qué formulario ha sido enviado mediante el campo oculto "form_type"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Manejo del formulario de paginación
    if (isset($_POST['form_type']) && $_POST['form_type'] == 'pagination') {
        CustomSessionHandler::set('booksPerPage', (int)$_POST['booksPerPage']);
        // Redirigir a la página actual con el valor del input "page"
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=" . $_POST['page']);
        exit();
    }

    // Manejo del formulario de libros
    elseif (isset($_POST['form_type']) && $_POST['form_type'] == 'book_form') {
        include 'controllers/form-data-control.php';
        exit();
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-pagination">
    <select name="booksPerPage" id="booksPerPage" onchange="this.form.submit()">
        <option value="5" <?php if ($booksPerPage == 5) echo 'selected'; ?>>5</option>
        <option value="10" <?php if ($booksPerPage == 10) echo 'selected'; ?>>10</option>
        <option value="20" <?php if ($booksPerPage == 20) echo 'selected'; ?>>20</option>
        <option value="50" <?php if ($booksPerPage == 50) echo 'selected'; ?>>50</option>
    </select>

    <!-- Campo oculto para identificar el formulario de paginación -->
    <input type="hidden" name="form_type" value="pagination">

    <!-- Campo oculto para mantener la página actual -->
    <input type="hidden" name="page" value="<?php echo isset($page) ? (int)$page : 1; ?>">
</form>
