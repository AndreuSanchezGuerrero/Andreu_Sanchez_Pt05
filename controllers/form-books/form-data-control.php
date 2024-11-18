<?php

// Andreu Sánchez Guerrero
include_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php';
require_once BASE_PATH . 'models/Books.php';
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

$isbnPattern = '/^(97(8|9))?\-?\d{1,5}\-?\d{1,7}\-?\d{1,7}\-?(\d|X)$/';
if (!preg_match($isbnPattern, $isbn)) {
    CustomSessionHandler::set('errorsForm', 'Invalid ISBN-13 format. It should start with 978 or 979 and have 13 digits.');
}

if (CustomSessionHandler::get('errorsForm')) {
    header("Location: " . BASE_URL . "index.php");
    exit();
    
} else {
    try {
        $bookModel = new Book($pdo);  

        if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($bookModel->isIsbnExists($isbn, $id)) {
                CustomSessionHandler::set('errorsForm', 'This ISBN is already registered for another book.');
                header("Location: " . BASE_URL . "index.php?action=update&id=" . $id);
                exit();
            }
    
            
            $bookModel->updateBook($id, $isbn, $name, $author);  
            CustomSessionHandler::set('operation', 'update');
            CustomSessionHandler::set('operation', 'update');
        } else {
            if ($bookModel->isIsbnExists($isbn)) {
                CustomSessionHandler::set('errorsForm', 'This ISBN is already registered.');
                header("Location:" . BASE_URL . "index.php");
                exit();
            }
    
            $bookModel->createBook($isbn, $name, $author, $userId);  
            CustomSessionHandler::set('operation', 'create');
        }
    
        CustomSessionHandler::set('success', true);
        CustomSessionHandler::remove('errorsForm');
    } catch (PDOException $e) {
        CustomSessionHandler::set('errorsForm', "Error inserting book: " . $e->getMessage());
        header("Location: " . BASE_URL . "index.php");
        exit();  
    }
}
header("Location: " . BASE_URL . "index.php");
exit();
?>