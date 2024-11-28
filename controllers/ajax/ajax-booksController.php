<?php
if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    $bookController = new BookController($pdo);

    // Recuperar parámetros de la solicitud AJAX
    $column = $_GET['column'] ?? null; // Columna para ordenar
    $order = $_GET['order'] ?? null;   // Orden (asc o desc)
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página actual
    $limit = isset($_GET['booksPerPage']) ? (int)$_GET['booksPerPage'] : 5; // Libros por página

    // Calcular el offset para la paginación
    $offset = ($page - 1) * $limit;

    // Obtener libros ordenados y paginados
    $booksToShow = $bookController->getBooks($userId, $column, $order, $limit, $offset);

    // Calcular total de libros y páginas
    $totalBooks =  count($bookController->getBooks($userId));
    $totalPages = ceil($totalBooks / $limit);

    // Generar contenido de la tabla
    ob_start();
    include BASE_PATH . 'views/components/books/books.php'; // Renderiza las filas de libros (tbody)
    $tableData = ob_get_clean();

    // Generar contenido de la paginación
    ob_start();
    include BASE_PATH . 'views/components/pagination/pagination.php'; // Renderiza los controles de paginación
    $pagination = ob_get_clean();

    // Responder con JSON
    echo json_encode([
        'pagination' => $pagination,  
        'tableData' => $tableData,    
        'pagination2' => $pagination,
        'totalPages' => $totalPages,  
        'currentPage' => $page,      
        'column' => $column,          
        'order' => $order          
    ]);
    exit();
}
?>