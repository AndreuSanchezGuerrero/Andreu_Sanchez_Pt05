<?php
// Andreu Sánchez Guerrero
require_once BASE_PATH . 'models/User.php';

// Inicializar errores
$errors = [];

// Validar los campos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validar campos vacíos
    if (empty($username)) {
        $errors[] = "El nombre de usuario es obligatorio.";
    }
    if (empty($email)) {
        $errors[] = "El correo electrónico es obligatorio.";
    }
    if (empty($password)) {
        $errors[] = "La contraseña es obligatoria.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    // Validar si el email ya está registrado
    $userModel = new User($pdo);
    if ($userModel->findUserByEmail($email)) {
        $errors[] = "El correo electrónico ya está registrado.";
    }

    // Validar si el nombre de usuario ya está registrado
    if ($userModel->findUserByUsername($username)) {
        $errors[] = "El nombre de usuario ya está registrado.";
    }

    // Si no hay errores, proceder con el registro
    if (empty($errors)) {
        // Hashear la contraseña
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Crear el usuario
        $userId = $userModel->createUser($username, $email, $hashed_password);

        // Iniciar sesión automáticamente
        CustomSessionHandler::set('user_id', $userId);
        CustomSessionHandler::set('username', $username);

        // Redirigir al usuario a la página de inicio
        header("Location: " . BASE_URL . "index.php");
        exit();
    } else {
        CustomSessionHandler::set('errors', $errors);
    }
}
?>
