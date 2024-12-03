<?php
class OauthUser {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createOAuthUser($data) {
        $sql = 'INSERT INTO o_auth_accounts (id, username, email, bio, photo_profile)
                VALUES (:id, :username, :email, :bio, :photo_profile)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $data['id'],
            'username' => $data['username'],
            'email' => $data['email'],
            'bio' => $data['bio'] ?? '',
            'photo_profile' => $data['photo_profile'] ?? null,
        ]);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM o_auth_accounts WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findUserByUsername($username) {
        $sql = "SELECT * FROM o_auth_accounts WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findUserByEmail($email) {
        $sql = "SELECT * FROM o_auth_accounts WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM o_auth_accounts WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateUserProfile($userId, $username, $email, $bio) {
        $sql = "UPDATE o_auth_accounts SET username = ?, email = ?, bio = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$username, $email, $bio, $userId]);
    }
    
    public function updateUserProfilePicture($userId, $profilePicPath) {
        $sql = "UPDATE o_auth_accounts SET photo_profile = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$profilePicPath, $userId]);
    }
    public function updateUserPassword($userId, $hashedPassword) {
        $query = "UPDATE o_auth_accounts SET password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }  
}
?>