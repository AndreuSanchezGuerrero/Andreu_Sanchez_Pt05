<?php
// Andreu Sánchez Guerrero

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/database/connection.php'; 
require_once 'controllers/sessions/CustomSessionHandler.php';
require_once 'controllers/books/BookController.php';
require_once 'controllers/auth/AuthController.php';

CustomSessionHandler::remove('profile');

$isEdit = false;
$bookToEdit = null;

$userId = CustomSessionHandler::get('user_id') ?? null; 
$isAdmin = (CustomSessionHandler::get('username') =='admin') ? true : false;
if ($userId) {
    $authController = new AuthController($pdo); 
    $authController->checkSessionTimeout();
}

if(isset($_GET['ajax']) && $_GET['ajax'] == 'true' && $isAdmin) {
    include BASE_PATH . 'controllers/users/userSearchController.php';
    exit();
}

if (isset($_GET['ajax']) && $_GET['ajax'] == 'true' && !$isAdmin) {
    include_once 'controllers/ajax/ajax-booksController.php';
    exit();
}

include_once 'views/layout.php'; 
?>