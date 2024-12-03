<?php
require_once BASE_PATH . 'models/OauthUser.php';

class OauthUserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new OauthUser($pdo);
    }

    public function createOAuthUser($data) {
        try {
            return $this->userModel->createOAuthUser($data);
        } catch (PDOException $e) {
            throw new Exception("Error trying to create user: " . $e->getMessage());
        }
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

    public function updateUserPassword($userId, $hashedPassword) {
        return $this->userModel->updateUserPassword($userId, $hashedPassword);
    }
}
?>
