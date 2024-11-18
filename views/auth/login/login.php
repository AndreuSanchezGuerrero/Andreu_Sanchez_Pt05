<?php
// Andreu Sánchez Guerrero
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../config/database/connection.php';
include_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php'; 

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
</head>

<body class="caja">
    <?php include BASE_PATH . 'views/components/alert/alert.php'; ?>
    <div class="login-container">
        <?php include BASE_PATH . 'views/components/header/header.php'; ?>
        <h2 class="login-title">Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-login">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="register-prompt">
            <p>Don't have an account yet? <a href="<?php echo BASE_URL; ?>views/auth/register/register.php">Sign up now!</a></p>
        </div>
    </div>
</body>
</html>