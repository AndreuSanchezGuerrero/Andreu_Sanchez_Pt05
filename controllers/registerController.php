<?php
// Andreu Sánchez Guerrero
require_once BASE_PATH . 'models/User.php';

function isStrongPassword($password) {
    $minLength = 8;

    if (strlen($password) < $minLength) {
        return "Password must be at least $minLength characters long.";
    }
    
    if (!preg_match('/[a-z]/', $password)) {
        return "Password must contain at least one lowercase letter.";
    }
    
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least one uppercase letter.";
    }
    
    if (!preg_match('/[0-9]/', $password)) {
        return "Password must contain at least one number.";
    }

    if (!preg_match('/[\W]/', $password)) {
        return "Password must contain at least one special character (e.g., !@#$%^&*).";
    }

    return true;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        CustomSessionHandler::set('errorsRegister', 'All fields are required.');
    }
    if ($password !== $confirm_password) {
        CustomSessionHandler::set('errorsRegister', 'Passwords do not match.');
    }

    $userModel = new User($pdo);
    if ($userModel->findUserByEmail($email)) {
        CustomSessionHandler::set('errorsRegister', 'The email is already registered.');
    }

    if ($userModel->findUserByUsername($username)) {
        CustomSessionHandler::set('errorsRegister', 'The username is already registered.');
    }

    $passwordStrength = isStrongPassword($password);
    if ($passwordStrength !== true) {
        CustomSessionHandler::set('errorsRegister', $passwordStrength);
    }

    if (!CustomSessionHandler::get('errorsRegister')) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $userId = $userModel->createUser($username, $email, $hashed_password);

        CustomSessionHandler::set('user_id', $userId);
        CustomSessionHandler::set('username', $username);
        CustomSessionHandler::set('login_success', 'Welcome, ' . $username . '!');

        header("Location: " . BASE_URL . "index.php");
        exit();
    } else {
        header("Location: " . BASE_URL . "views/auth/register/register.php");
        exit();
    }
}
?>
