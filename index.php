<?php
// Andreu Sánchez Guerrero
session_start();
if (headers_sent($file, $line)) {
    die("Headers already sent in $file on line $line");
}

require_once 'config/database/connection.php'; 
require_once 'controllers/CustomSessionHandler.php';
require_once 'controllers/BookController.php';

// Variable per controlar el missatge de success, si está false es que hi ha errors i no s'ha enviat. Poden haber errors per enviar el formulari o per la URL
$success = false;
$errors = [];
$errorsUrl = '';

// Estem en mode edició?
$isEdit = false;

// Variable per emmagatzemar les dades de l'article a editar
$bookToEdit = null;

// Inicializar el controlador con la conexión PDO a la base de datos
$bookController = new BookController($pdo);

// Ejemplo: Obtener todos los libros
$userId = CustomSessionHandler::get('user_id') ?? null; 
$books = $bookController->getBooks();
$userBooks = $bookController->getBooks($userId);
$booksToUse = $userId ? $userBooks : $books;

// Incloure la vista principal
include_once 'views/layout.php'; 
?>


