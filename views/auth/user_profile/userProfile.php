<?php

use Google\Service\Monitoring\Custom;

require_once __DIR__ . '/../../../config/database/connection.php';
require_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php'; 
require_once BASE_PATH . 'controllers/users/UserController.php';
require_once BASE_PATH . 'controllers/users/OauthUserController.php'; 

$userController = new UserController($pdo);
$oauthController = new OAuthUserController($pdo);

$userId = CustomSessionHandler::get('user_id');
$userData = $userController->getUserById($userId);


if (!$userData) {
    $userData = $oauthController->getUserById($userId);
    CustomSessionHandler::set('is_oauth_user', true);
    $isOAuthUser = true;
    var_dump($isOAuthUser);

    if (!$userData) {
        $baseUsername = CustomSessionHandler::get('username') ?: 'user';
        $randomPart = rand(10000000, 99999999) . substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 6);
        $generatedUsername = strtolower($baseUsername) . '-' . $randomPart;

        $newUserData = [
            'id' => $userId,
            'username' => $generatedUsername,
            'email' => 'oAuthAccount@' . strtolower($generatedUsername) . '.com',
            'bio' => '',
            'photo_profile' => 'default-user.png'
        ];

        $oauthController->createOAuthUser($newUserData);

        $userData = $oauthController->getUserById($userId);
    }
}

$profilePicUrl = file_exists(BASE_PATH . 'views/assets/img/' . htmlspecialchars($userData['photo_profile'])) 
    ? BASE_URL . 'views/assets/img/' . htmlspecialchars($userData['photo_profile']) 
    : BASE_URL . 'views/assets/img/default-user.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userProfile.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/components/header/header.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/components/footer/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>views/components/alert/alert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> 
    <title>Edit Profile</title>
</head>
<body>

<div id="alert" class="alert"></div>
<div class="container">
    <div class="header-container">
        <?php include BASE_PATH . 'views/components/header/header.php'; ?>
    </div>

    <div class="profile-section">
        <div class="profile-form">
        <h2>Edit Profile</h2>
            <form id="editProfileForm">
                <label for="profilePic">Profile Picture:</label>
                <input type="file" id="profilePic" name="profilePic">
                
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($userData['username']); ?>">
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>">

                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio"><?php echo htmlspecialchars($userData['bio']); ?></textarea>

                <button type="button" class="accordion" id="togglePasswordFields">Change Password</button>

                <div class="panel" id="passwordFields">
                    <label for="currentPassword">Current Password:</label>
                    <input type="password" id="currentPassword" name="currentPassword" autocomplete="off">

                    <label for="newPassword">New Password:</label>
                    <input type="password" id="newPassword" name="newPassword">

                    <label for="confirmNewPassword">Confirm New Password:</label>
                    <input type="password" id="confirmNewPassword" name="confirmNewPassword">
                </div>
                <button type="button" id="saveProfileBtn" class="bookmarkBtn" >
                <span class="IconContainer">
                    <i class="fas fa-save"></i>
                </span>
                <p class="text">Save</p>
                </button>
            </form>
        </div>

        <div class="profile-preview">
            <h2>Profile Preview</h2>
            <img id="preview-profilePic" src="<?php echo $profilePicUrl; ?>" alt="Profile Picture">
            <p><strong>Username:</strong> <span id="preview-username"><?php echo htmlspecialchars($userData['username']); ?></span></p>
            <p><strong>Email:</strong> <span id="preview-email"><?php echo htmlspecialchars($userData['email']); ?></span></p>
            <p><strong>Bio:</strong> <span id="preview-bio"><?php echo htmlspecialchars($userData['bio']); ?></span></p>
            <p><strong>Password:</strong> <span id="preview-password">********</span></p>
        </div>
    </div>
    <footer class="footer-container">
        <?php include BASE_PATH . 'views/components/footer/footer.php'; ?>
    </footer>
</div>


<script src="<?php echo BASE_URL . 'views/assets/js/acordion.js'?>"></script>
<script type="module" src="<?php echo BASE_URL; ?>views/assets/js/ajax-edit-profile.js"></script>
<script src="<?php echo BASE_URL; ?>views/components/alert/alert.js"></script>
</body>
</html>
