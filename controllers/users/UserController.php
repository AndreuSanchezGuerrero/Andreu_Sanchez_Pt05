<?php
require_once BASE_PATH . 'models/User.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function createUser($username, $email, $password) {
        try {
            return $this->userModel->createUser($username, $email, $password);
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                throw new Exception("The username or email already exists.");
            } else {
                throw new Exception("Error trying to create user: " . $e->getMessage());
            }
        }
    }

    public function getAllUsers() {
        return $this->userModel->getAllUsers();
    }

    public function getUserById($userId) {
        return $this->userModel->getUserById($userId);
    }

    public function getUserByUsername($username) {
        return $this->userModel->findUserByUsername($username);
    }

    public function getUserByEmail($email) {
        return $this->userModel->findUserByEmail($email);
    }

    public function deleteUser($id) {
        try {
            return $this->userModel->deleteUser($id);
        } catch (PDOException $e) {
            throw new Exception("Error trying to delete user: " . $e->getMessage());
        }
    }

    public function updateUserProfile($userId, $username, $email, $bio) {
        return $this->userModel->updateUserProfile($userId, $username, $email, $bio);
    }
    
    public function updateUserProfilePicture($userId, $profilePicPath) {
        return $this->userModel->updateUserProfilePicture($userId, $profilePicPath);
    }
    
}
?>
