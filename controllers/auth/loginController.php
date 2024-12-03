<?php
// Andreu Sánchez Guerrero

require_once BASE_PATH . 'controllers/auth/AuthController.php';
include_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php';

    if (!CustomSessionHandler::get('login_attempts')) {
        CustomSessionHandler::set('login_attempts', 0);
    }

    $authController = new AuthController($pdo);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $recaptchaResponse = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null;

    if (CustomSessionHandler::get('login_attempts') >= 3) {
        if (empty($recaptchaResponse)) {
            CustomSessionHandler::set('login_error', 'Please complete the reCAPTCHA.');
        } else {
            $secretKey = '6LfoVo0qAAAAAHQSZ6P67fcb9wNQPfHr3DzyS-VE';
            $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
            $response = file_get_contents("$recaptchaUrl?secret=$secretKey&response=$recaptchaResponse");
            $recaptchaData = json_decode($response, true);

            if (!$recaptchaData['success']) {
                CustomSessionHandler::set('login_error', 'Invalid reCAPTCHA. Please try again.');
            }
        }
    }

    // Procesar login si no hay errores de reCAPTCHA
    if (empty(CustomSessionHandler::get('login_error'))) {
        if ($authController->login($username, $password)) {
            CustomSessionHandler::set('login_attempts', 0);
            header("Location: " . BASE_URL . "index.php");
            exit();
        } else {
            $currentAttempts = CustomSessionHandler::get('login_attempts');
            CustomSessionHandler::set('login_attempts', $currentAttempts + 1);
            CustomSessionHandler::set('login_error', 'Invalid username or password.');
        }
    }
}
?>
