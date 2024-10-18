<?php
// Andreu Sánchez Guerrero
require_once BASE_PATH . 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // Manejar el inicio de sesión
    public function login($username, $password) {
        $user = $this->userModel->findUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) { //password_verify($password, $user['password'])
            CustomSessionHandler::set('user_id', $user['id']);
            CustomSessionHandler::set('username', $user['username']);
            CustomSessionHandler::set('login_success', true); // Indicar que el login fue exitoso
            return true;
        } else {
            CustomSessionHandler::set('login_error', 'Usuario o contraseña incorrectos.'); // Guardar error en sesión
            return false;
        }
    }

    // Manejar el cierre de sesión
    public function logout() {
        CustomSessionHandler::remove('user_id');
        CustomSessionHandler::remove('username');

        session_destroy();
        session_start();
        // Añadir mensaje de éxito al cerrar la sesión
        CustomSessionHandler::set('logout_message', true);
        header("Location: " . BASE_URL . "index.php");
        exit();
    }

}
