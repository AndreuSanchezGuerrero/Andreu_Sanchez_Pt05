<?php
// Andreu Sánchez Guerrero
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/database/connection.php'; 
require_once 'controllers/CustomSessionHandler.php';
require_once 'controllers/BookController.php';
$success = false;
$errors = [];
$errorsUrl = '';
$isEdit = false;
$bookToEdit = null;
$userId = CustomSessionHandler::get('user_id') ?? null; 
include_once 'views/layout.php'; 
?>