<?php

// Andreu Sánchez Guerrero
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../config/database/connection.php';
include_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php'; 
include_once BASE_PATH . 'controllers/auth/google/googleController.php';
$config = include BASE_PATH . 'config/hybrid-auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once BASE_PATH . 'controllers/auth/loginController.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/components/header/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/components/alert/alert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
    <script defer src="<?php echo BASE_URL; ?>views/components/alert/alert.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="caja">
    <div class="login-container">
        <?php include BASE_PATH . 'views/components/alert/alert.php'; ?>
        <?php include BASE_PATH . 'views/components/header/header.php'; ?>
        <h2 class="login-title">Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-login">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required class="form-control"value="<?php echo htmlspecialchars(isset($_POST['username']) ? $_POST['username'] : ''); ?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>

            <?php if (CustomSessionHandler::get('login_attempts') >= 3): ?>
                <div class="g-recaptcha" data-sitekey="6LfoVo0qAAAAAGFjTmByFPzk5eMy5e7Vq-zY4UND"></div>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <div class="register-prompt">
            <p>Don't have an account yet? <a href="<?php echo BASE_URL; ?>views/auth/register/register.php">Sign up now!</a></p>
        </div>
        <div class="social-login">
            <a href="<?php echo $authUrl; ?>" class="btn btn-google">
                <i class="fab fa-google"></i>
            </a>
            <?php if (isset($config['providers']) && is_array($config['providers'])): ?>
                <?php foreach ($config['providers'] as $provider => $settings): ?>
                    <?php if ($settings['enabled']): ?>
                        <a href="<?php echo BASE_URL; ?>controllers/auth/hybridAuth-providers/providersController.php?provider=<?php echo $provider; ?>" 
                        class="btn btn-<?php echo strtolower($provider); ?>">
                            <i class="fab fa-<?php echo strtolower($provider); ?>"></i>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay proveedores configurados.</p>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>