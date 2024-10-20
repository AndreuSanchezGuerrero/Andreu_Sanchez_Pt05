<?php
// Andreu Sánchez Guerrero

require_once BASE_PATH . 'controllers/AuthController.php';
require_once BASE_PATH . 'controllers/CustomSessionHandler.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController = new AuthController($pdo);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        CustomSessionHandler::set('login_error', 'All fields are required.');
    }

    if (empty(CustomSessionHandler::get('login_error'))) {
        if ($authController->login($username, $password)) {
            header("Location: " . BASE_URL . "index.php");
            exit();
        } else {
            CustomSessionHandler::set('login_error', 'Invalid username or password.');
        }
    }
}
