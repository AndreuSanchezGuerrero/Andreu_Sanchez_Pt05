<?php
require_once __DIR__ . '/../../../config/database/connection.php';
require_once BASE_PATH . 'controllers/books/BookController.php';

header('Content-Type: application/json');

// Recoger parámetros enviados por AJAX
$page = $_POST['page'] ?? 1;
$booksPerPage = $_POST['booksPerPage'] ?? 5;
$sortColumn = $_POST['sortColumn'] ?? 'isbn';
$sortOrder = $_POST['sortOrder'] ?? 'asc';
$userId = $_SESSION['user_id'] ?? null;

// Validar entrada para prevenir SQL Injection
$validColumns = ['isbn', 'name', 'author'];
if (!in_array($sortColumn, $validColumns)) {
    $sortColumn = 'isbn'; // Fallback a un valor predeterminado seguro
}
if (!in_array(strtolower($sortOrder), ['asc', 'desc'])) {
    $sortOrder = 'asc';
}

try {
    // Inicializar controlador
    $bookController = new BookController($pdo);

    // Obtener libros con los parámetros dinámicos
    $books = $bookController->getBooksPaginatedAndSorted(
        $booksPerPage,
        ($page - 1) * $booksPerPage,
        $sortColumn,
        $sortOrder,
        $userId
    );

    // Generar tabla HTML con el resultado
    ob_start();
    include BASE_PATH . 'views/components/bookTable.php';
    $tableHTML = ob_get_clean();

    // Responder con éxito y la tabla generada
    echo json_encode(['success' => true, 'html' => $tableHTML]);
} catch (Exception $e) {
    // Manejo de errores
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching books: ' . $e->getMessage()
    ]);
}
