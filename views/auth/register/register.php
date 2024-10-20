<?php
// Andreu Sánchez Guerrero
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../config/database/connection.php';
require_once BASE_PATH . 'controllers/CustomSessionHandler.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once BASE_PATH . 'controllers/registerController.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/components/header/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/components/alert/alert.css">
    <script defer src="<?php echo BASE_URL; ?>views/components/alert/alert.js"></script>
</head>

<body class="box">
    <?php include BASE_PATH . 'views/components/alert/alert.php'; ?>
    <div class="register-container">
        <?php include BASE_PATH . 'views/components/header/header.php'; ?>
        <h2 class="register-title">Create an Account</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-register">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        
        <!-- Add a link to login if the user already has an account -->
        <div class="login-prompt">
            <p>Already have an account? <a href="<?php echo BASE_URL; ?>views/auth/login/login.php">Log in here</a>.</p>
        </div>
    </div>
</body>
</html>
