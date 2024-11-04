<?php
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $userId = intval($_GET['id']);
        try {
            $userToDelete = $userController->getUserById($userId);
            // Check if the logged-in user is admin and trying to delete themselves
            if ($userToDelete['username'] === 'admin') {
                // Prevent deletion and set an error message in the session
                CustomSessionHandler::set('errors', 'Admin cannot delete their own account.');
                header("Location: " . BASE_URL . "index.php");
                exit();
            }
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