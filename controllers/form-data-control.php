<?php

// Andreu Sánchez Guerrero
include_once 'CustomSessionHandler.php';
require_once 'models/Books.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userId = CustomSessionHandler::get('user_id');


if (empty($_POST['isbn']) || empty($_POST['name']) || empty($_POST['author'])) {
    CustomSessionHandler::set('errorsForm', 'All fields are required.');
} else {
    $isbn = $_POST['isbn'];
    $name = $_POST['name'];
    $author = $_POST['author'];
}

if (CustomSessionHandler::get('errorsForm')) {
    header("Location: index.php");
    exit();
    
} else {
    try {
        $bookModel = new Book($pdo);  

        if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $bookModel->updateBook($id, $isbn, $name, $author);  
            CustomSessionHandler::set('operation', 'update');
        } else {
            $bookModel->createBook($isbn, $name, $author, $userId);  
            CustomSessionHandler::set('operation', 'create');
        }
        CustomSessionHandler::set('success', true);
        CustomSessionHandler::remove('errors');
    } catch (PDOException $e) {
        $errors[] = "Error en inserir el llibre: " . $e->getMessage();  
    }
}
header("Location: index.php");
exit();
?>