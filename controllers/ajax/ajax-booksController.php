<?php
// Check if the request is an AJAX request
if (isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
    $bookController = new BookController($pdo);
    
    // Retrieve pagination parameters from the AJAX request
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $booksPerPage = isset($_GET['booksPerPage']) ? (int)$_GET['booksPerPage'] : 5;

    // Calculate offset and retrieve paginated books
    $offset = ($page - 1) * $booksPerPage;
    $booksToShow = $bookController->getBooksByPage($booksPerPage, $offset, $userId);
    $totalBooks = count($bookController->getBooks($userId));
    $totalPages = ceil($totalBooks / $booksPerPage);

    // Capture HTML for the table rows and pagination
    ob_start();
    include BASE_PATH . 'views/components/books/books.php';  // Only the rows (tbody)
    $tableData = ob_get_clean();

    // Genera el HTML de la paginación (una sola vez)
    ob_start();
    include BASE_PATH . 'views/components/pagination/pagination.php'; // Pagination links
    $pagination = ob_get_clean();

    // Return JSON response for the JavaScript
    echo json_encode([
        'pagination' => $pagination,
        'tableData' => $tableData,
        'pagination2' => $pagination
    ]);
    exit();
}
?>