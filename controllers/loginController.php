<?php
// Andreu Sánchez Guerrero

require_once BASE_PATH . 'controllers/AuthController.php';
require_once BASE_PATH . 'controllers/CustomSessionHandler.php'; 

// Solo incluir el controlador si se ha enviado el formulario por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController = new AuthController($pdo);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validar campos vacíos
    if (empty($username) || empty($password)) {
        CustomSessionHandler::set('login_error', 'Todos los campos son obligatorios.');
    }

    // Si no hay errores, intentar iniciar sesión
    if (empty(CustomSessionHandler::get('login_error'))) {
        if ($authController->login($username, $password)) {
            header("Location: " . BASE_URL . "index.php");
            exit();
        } else {
            CustomSessionHandler::set('login_error', 'Usuario o contraseña incorrectos.');
        }
    }
}
