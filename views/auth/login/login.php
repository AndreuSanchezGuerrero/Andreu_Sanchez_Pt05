<?php

// Andreu Sánchez Guerrero

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../config/database/connection.php';
include_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php'; 
include_once BASE_PATH . 'controllers/auth/google/googleController.php';
$config = include BASE_PATH . 'config/hybrid-auth.php';

CustomSessionHandler::set('profile', true);

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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/components/footer/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
    <script defer src="<?php echo BASE_URL; ?>views/components/alert/alert.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="container-login">
        <?php include BASE_PATH . 'views/components/alert/alert.php'; ?>
        
        <?php include BASE_PATH . 'views/components/header/header.php'; ?>

        <div class="login-wrapper">
            <div class="login-image">
                <img src="<?php echo BASE_URL; ?>views/assets/img/booksImage.png" alt="Books Image">
            </div>

            <div class="login-form-container">
                <div class="user-avatar">
                    <img src="<?php echo BASE_URL; ?>views/assets/img/users/login.png" alt="User Avatar">
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="login-form">
                    <div class="form-group">
                        <input type="text" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group options">
                        <label for="remember-me" class="checkbox-label">Remember me</label>
                        <input type="checkbox" id="remember-me" name="remember-me" class="remember-checkbox">
                        <a href="#" class="forgot-password">Forgot password?</a>
                    </div>


                    <button type="submit" class="btn-login">Sign in</button>
                </form>

                <div class="register-section">
                    <p>Don't have an account yet? <a href="<?php echo BASE_URL; ?>views/auth/register/register.php">Sign up now!</a></p>
                </div>

                <div class="social-login">
                    <a href="<?php echo $authUrl; ?>" class="btn-social google">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="btn-social github">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
        </div>

        <?php include BASE_PATH . 'views/components/footer/footer.php'; ?>
    </div>
</body>
</html>