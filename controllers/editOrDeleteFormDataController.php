<?php
$bookController = new BookController($pdo);
$errorsUrl = '';
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        CustomSessionHandler::set('errorsUrl', "The specified ID is not valid.");
        header("Location: " . BASE_URL . "index.php");
        exit();
    } else {
        $bookToDelete = $bookController->getBookById($id);

        if (!$bookToDelete) {
            CustomSessionHandler::set('errorsUrl', "The book with the specified ID does not exist.");
            header("Location: " . BASE_URL . "index.php");
            exit();
        } else {
            // Eliminar el libro
            $bookController->deleteBook($id);
            CustomSessionHandler::set('operation', 'delete');
            CustomSessionHandler::set('success', true);
            header("Location: " . BASE_URL . "index.php");
            exit();
        }
    }
}

// Comprobar si es una acción de edición
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Verificar si el ID es un número entero válido
    if (!filter_var($bookId, FILTER_VALIDATE_INT)) {
        CustomSessionHandler::set('errorsUrl', "The specified ID is not valid.");
        header("Location: " . BASE_URL . "index.php");
        exit();
    } else {
        $bookToEdit = $bookController->getBookById($bookId);

        if (!$bookToEdit) {
            CustomSessionHandler::set('errorsUrl', "The book with the specified ID does not exist.");
            header("Location: " . BASE_URL . "index.php");
            exit();
        } else {
            $isEdit = true;
        }
    }
}