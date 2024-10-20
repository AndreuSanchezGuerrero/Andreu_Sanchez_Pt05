<?php
require_once BASE_PATH . 'controllers/AuthController.php';
require_once BASE_PATH . 'config/database/connection.php';
require_once BASE_PATH . 'controllers/CustomSessionHandler.php';

$authController = new AuthController($pdo);
$authController->logout();
?>