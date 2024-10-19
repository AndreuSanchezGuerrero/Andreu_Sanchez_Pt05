<?php

// Andreu Sánchez Guerrero
// Incluir el manejador de sesiones y el modelo de libros
include_once 'CustomSessionHandler.php';
require_once 'models/Books.php';  // Cambiado a Book
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Obtener el user_id de la sesión
$userId = CustomSessionHandler::get('user_id');

// Inicializar la variable de errores
$errors = [];

// Validar los datos
if (empty($_POST["name"])) {
    $errors[] = "El camp 'Nom del Llibre' està buit.";  // Cambiado a libro
} else {
    $name = htmlspecialchars(trim($_POST["name"]));  // Cambiado a name
    if (strlen($name) > 100) {
        $errors[] = "El camp 'Nom del Llibre' no pot tenir més de 100 caràcters.";  // Cambiado a libro
    }
}

if (empty($_POST["author"])) {
    $errors[] = "El camp 'Nom de l'Autor' està buit.";  // Cambiado a autor
} else {
    $author = htmlspecialchars(trim($_POST["author"]));  // Cambiado a author
}

if (empty($_POST["isbn"])) {
    $errors[] = "El camp 'ISBN' està buit.";  // Validación para ISBN
} else {
    $isbn = htmlspecialchars(trim($_POST["isbn"]));  // Cambiado a isbn
}

// Si hay errores, almacenamos los errores en la sesión
if (!empty($errors)) {
    CustomSessionHandler::set('success', false);
    CustomSessionHandler::set('errors', $errors);
} else {
    try {
        // Crear una instancia del modelo de libros
        $bookModel = new Book($pdo);  // Cambiado a Book

        // Si estamos en modo edición, actualizar el libro con el ID
        if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $bookModel->updateBook($id, $isbn, $name, $author);  // Cambiado a libro
            CustomSessionHandler::set('operation', 'update');
        
        } else {
            // Modo creación -> insertar libro
            $bookModel->createBook($isbn, $name, $author, $userId);  // Cambiado a libro
            CustomSessionHandler::set('operation', 'create');
        }
        // Si la operación es exitosa, almacenamos success en la sesión
        CustomSessionHandler::set('success', true);
        CustomSessionHandler::remove('errors');
    } catch (PDOException $e) {
        // Si hay un error en la base de datos, lo almacenamos
        $errors[] = "Error en inserir el llibre: " . $e->getMessage();  // Cambiado a libro
        CustomSessionHandler::set('success', false);
        CustomSessionHandler::set('errors', $errors);
    }
}
// Redirigir a la página principal
header("Location: index.php");
exit();
?>