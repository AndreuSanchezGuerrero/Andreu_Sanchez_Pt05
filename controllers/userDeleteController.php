<?php
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $userId = intval($_GET['id']);
        try {
            $userController->deleteUser($userId);
            CustomSessionHandler::set('deleteUser', 'User deleted successfully.');
            header("Location: " . BASE_URL . "index.php");
            exit();
        } catch (Exception $e) {
            CustomSessionHandler::set('errors', $e->getMessage());
            header("Location: " . BASE_URL . "index.php");
            exit();
        }
    }
?>