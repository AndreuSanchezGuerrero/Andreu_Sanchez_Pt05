<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ .'/../../../config/env.php';
require BASE_PATH . 'controllers/auth/logoutController.php';
?>