<?php
// Andreu Sánchez Guerrero
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../config/database/connection.php';
require_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once BASE_PATH . 'controllers/auth/registerController.php';
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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/components/footer/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/components/alert/alert.css">
    <script defer src="<?php echo BASE_URL; ?>views/components/alert/alert.js"></script>
</head>

<body>
    <div class="container-register">
        <?php include BASE_PATH . 'views/components/header/header.php'; ?>
        <?php include BASE_PATH . 'views/components/alert/alert.php'; ?>

        <div class="register-wrapper">
            <div class="register-image">
                <img src="<?php echo BASE_URL; ?>views/assets/img/booksImage.png" alt="Books Image">
            </div>
            <div class="register-form-container">
                <div class="user-avatar">
                    <img src="<?php echo BASE_URL; ?>views/assets/img/users/login.png" alt="User Avatar">
                </div>
                <h2>Create an Account</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="register-form">
                    <div class="form-group">
                        <input class="register-input" type="text" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input class="register-input" type="email" id="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input class="register-input" type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="register-input" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="btn-register">Register</button>
                </form>
                <div class="login-prompt">
                    <p>Already have an account? <a href="<?php echo BASE_URL; ?>views/auth/login/login.php">Log in here</a>.</p>
                </div>
            </div>
        </div>
        <?php include BASE_PATH . 'views/components/footer/footer.php'; ?>
    </div>
</body>
</html>
