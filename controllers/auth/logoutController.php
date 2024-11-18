<?php
require_once BASE_PATH . 'controllers/auth/AuthController.php';
require_once BASE_PATH . 'config/database/connection.php';
require_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php';

$authController = new AuthController($pdo);
$authController->logout();
?>