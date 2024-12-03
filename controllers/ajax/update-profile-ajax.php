<?php
require_once __DIR__ . '../../../config/database/connection.php';
require_once BASE_PATH . 'controllers/users/UserController.php';
require_once BASE_PATH . 'controllers/users/OauthUserController.php';
require_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php';
header('Content-Type: application/json');

// Andreu Sánchez Guerrero
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$response = ["success" => false, "message" => "Unknown error."];

function jsonResponse($success, $message) {
    echo json_encode(["success" => $success, "message" => $message]);
    exit();
}

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

try {
    $userController = new UserController($pdo);
    $userId = CustomSessionHandler::get('user_id');
    $isOAuthUser = CustomSessionHandler::get('is_oauth_user');


    $userController = new UserController($pdo);
    $oauthController = new OAuthUserController($pdo);

    $controller = $isOAuthUser ? $oauthController : $userController;

    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $bio = $_POST['bio'] ?? null;
    $currentPassword = $_POST['currentPassword'] ?? null;
    $newPassword = $_POST['newPassword'] ?? null;
    $confirmNewPassword = $_POST['confirmNewPassword'] ?? null;

    $userData = $controller->getUserById($userId);

    if ($username && $username !== $userData['username']) {
        if ($controller->getUserByUsername($username)) {
            jsonResponse(false, "The username is already registered.");
        }
    }

    if ($email && $email !== $userData['email']) {
        if ($controller->getUserByEmail($email)) {
            jsonResponse(false, "The email is already registered.");
        }
        if ($controller === $oauthController) {
            jsonResponse(false, "You cannot change the email of an OAuth account.");
        }
    }

    if ($currentPassword && $newPassword && $confirmNewPassword && $currentPassword !== $newPassword) {

        if ($controller === $oauthController) {
            jsonResponse(false, "You cannot change the password of an OAuth account.");
        }

        $user = $userController->getUserById($userId);

        if (!password_verify($currentPassword, $user['password'])) {
            jsonResponse(false, "The current password is incorrect.");
        }

        if ($newPassword !== $confirmNewPassword) {
            jsonResponse(false, "The new passwords do not match.");
        }

        $passwordStrength = isStrongPassword($newPassword);
        if ($passwordStrength !== true) {
            jsonResponse(false, $passwordStrength);
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $userController->updateUserPassword($userId, $hashedPassword);
    }

    if ($controller->updateUserProfile($userId, $username, $email, $bio)) {
        $response["success"] = true;
        $response["message"] = "Profile updated successfully.";
    }

    if (!empty($_FILES['profilePic']['name'])) {
        $uploadDir = BASE_PATH . 'views/assets/img/';
        $fileExtension = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);
        $newFileName = $userId . '.' . $fileExtension;
        $uploadFile = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadFile)) {
            $profilePicPath = $newFileName;
            if ($controller->updateUserProfilePicture($userId, $profilePicPath)) {
                $response["success"] = true;
                $response["message"] = "Profile and picture updated successfully.";
            }
        } else {
            $response["message"] = "Failed to upload profile picture.";
        }
    }

} catch (Exception $e) {
    $response["message"] = $e->getMessage();
}
echo json_encode($response);
?>