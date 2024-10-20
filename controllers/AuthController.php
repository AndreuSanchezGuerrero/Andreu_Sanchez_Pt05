<?php
// Andreu Sánchez Guerrero
require_once BASE_PATH . 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // Handle login
    public function login($username, $password) {
        $user = $this->userModel->findUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // if user exists and password is correct set session variables to store user data 
            CustomSessionHandler::set('user_id', $user['id']);
            CustomSessionHandler::set('username', $user['username']); 
            // Save login success in session to show success message
            CustomSessionHandler::set('login_success', 'Successfully logged in.');
            return true;
        } else {
            CustomSessionHandler::set('login_error', 'Usuario o contraseña incorrectos.');
            return false;
        }
    }

    // Handle logout
    public function logout() {
        CustomSessionHandler::remove('user_id');
        CustomSessionHandler::remove('username');

        session_destroy();
        session_start();
        // Añadir mensaje de éxito al cerrar la sesión
        CustomSessionHandler::set('logout_message', 'Successfully logged out.');
        header("Location: " . BASE_URL . "index.php");
        exit();
    }

}
