<?php
// Iniciar la sesión
session_start();
require_once __DIR__ .'/../../../config/env.php';
require_once BASE_PATH . 'controllers/AuthController.php';
require_once BASE_PATH . 'config/database/connection.php';
require_once BASE_PATH . 'controllers/CustomSessionHandler.php';

$authController = new AuthController($pdo);
$authController->logout(); // Cerrar sesión y redirigir
