<?php
if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    $bookController = new BookController($pdo);

    $column = $_GET['column'] ?? null; 
    $order = $_GET['order'] ?? null;   
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
    $limit = isset($_GET['booksPerPage']) ? (int)$_GET['booksPerPage'] : 5;

    $offset = ($page - 1) * $limit;

    $booksToShow = $bookController->getBooks($userId, $column, $order, $limit, $offset);

    $totalBooks =  count($bookController->getBooks($userId));
    $totalPages = ceil($totalBooks / $limit);

    ob_start();
    include BASE_PATH . 'views/components/books/books.php';
    $tableData = ob_get_clean();

    ob_start();
    include BASE_PATH . 'views/components/pagination/pagination.php'; 
    $pagination = ob_get_clean();

    echo json_encode([
        'pagination' => $pagination,  
        'tableData' => $tableData,    
        'totalPages' => $totalPages,  
        'currentPage' => $page,      
        'column' => $column,          
        'order' => $order          
    ]);
    exit();
}
?>