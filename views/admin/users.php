    <?php 
        include BASE_PATH . 'controllers/users/UserController.php';
        $userController = new UserController($pdo);
        include BASE_PATH . 'controllers/users/userDeleteController.php';
        $users = $userController->getAllUsers();
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>PROFILE</th>
                <th>NAME</th>
                <th>EMAIL</th> 
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td></td>  
                <td><?= htmlspecialchars($user['username']); ?></td>  
                <td><?= htmlspecialchars($user['email']); ?></td>  
                <td class="text-right">
                    <?php if ($user['username'] === 'admin' && $_SESSION['username'] === 'admin'): ?>
                        <!-- Show a disabled delete button if admin is viewing their own account -->
                        <button class="btn btn-disabled btn-sm" disabled title="Admin cannot delete themselves">
                            <i class="fas fa-trash"></i>
                        </button>
                    <?php else: ?>
                        <!-- Regular delete link for other users -->
                        <a href="index.php?action=delete&id=<?= $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this user?');">
                            <i class="fas fa-trash"></i>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>