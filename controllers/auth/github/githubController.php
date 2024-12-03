<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_GET['provider']) || empty($_GET['provider'])) {
    die('Error: No se especificó el proveedor.');
}

require_once BASE_PATH . 'vendor/autoload.php';

use Hybridauth\Hybridauth;

try {
    $config = include BASE_PATH . 'config/hybrid-auth.php';

    if (!is_array($config)) {
        die('Error: La configuración de HybridAuth no es válida.');
    }

    $hybridauth = new Hybridauth($config);
    $provider = $_GET['provider'];

    // Intentar obtener el adaptador para el proveedor
    $adapter = $hybridauth->getAdapter($provider);
    $userProfile = $adapter->getUserProfile();

    // Guardar datos del usuario en la sesión
    CustomSessionHandler::set('user_id', $userProfile->identifier);
    CustomSessionHandler::set('email', $userProfile->email);
    CustomSessionHandler::set('username', $userProfile->displayName);
    CustomSessionHandler::set('avatar', $userProfile->photoURL);
    CustomSessionHandler::set('login_success', 'Welcome ' . $userProfile->displayName . '!');

    // Redirigir al index
    header('Location: ' . BASE_URL . 'index.php');
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
