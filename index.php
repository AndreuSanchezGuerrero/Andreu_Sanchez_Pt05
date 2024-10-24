<?php
// Andreu Sánchez Guerrero

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/database/connection.php'; 
require_once 'controllers/CustomSessionHandler.php';
require_once 'controllers/BookController.php';
require_once 'controllers/AuthController.php';

$errorsUrl = '';
$isEdit = false;
$bookToEdit = null;
$userId = CustomSessionHandler::get('user_id') ?? null; 

// Check if the user is logged in
if ($userId) {
    $authController = new AuthController($pdo); 
    $authController->checkSessionTimeout();
}

include_once 'views/layout.php'; 
?>