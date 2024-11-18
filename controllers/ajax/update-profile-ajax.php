<?php
require_once __DIR__ . '../../../config/database/connection.php';
require_once BASE_PATH . 'controllers/users/UserController.php';
require_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php';
header('Content-Type: application/json'); // Configura la respuesta como JSON

// Depuración: Imprime todo lo que recibe el servidor
error_log(print_r($_POST, true)); // Imprime los datos de texto del formulario en el log de errores
error_log(print_r($_FILES, true)); // Imprime los archivos subidos en el log de errores

$response = ["success" => false, "message" => "Unknown error."];

// Procesamiento de los datos (simplificado para depuración)
try {
    $userController = new UserController($pdo);
    $userId = CustomSessionHandler::get('user_id');

    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $bio = $_POST['bio'] ?? null;

    // Actualiza datos del usuario
    if ($userController->updateUserProfile($userId, $username, $email, $bio)) {
        $response["success"] = true;
        $response["message"] = "Profile updated successfully.";
    }

    // Procesa la foto de perfil
    if (!empty($_FILES['profilePic']['name'])) {
        $uploadDir = BASE_PATH . 'views/assets/img/';
        $uploadFile = $uploadDir . basename($_FILES['profilePic']['name']);

        if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadFile)) {
            $profilePicPath = 'views/assets/img/' . basename($_FILES['profilePic']['name']);
            if ($userController->updateUserProfilePicture($userId, $profilePicPath)) {
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
