<?php 
    include BASE_PATH . 'controllers/users/UserController.php';
    $userController = new UserController($pdo);
    include BASE_PATH . 'controllers/users/userDeleteController.php';
    $users = $userController->getAllUsers();
?>

<div class="admin-header-section">

    <p class="admin-title-page">User list</p>

    <div class="admin-search-container">
        <form id="admin-search-form" action="index.php" method="GET">
            <div class="admin-search-wrapper">
                <input 
                    type="text" 
                    name="search" 
                    id="search-users"  
                    placeholder="Search for a book..." 
                    class="admin-search-input">
                <button type="submit" class="admin-search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="centered-container">
    <table class="table">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Username</th>
                <th>Email</th> 
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user):?>
            
            <tr>
                <td><img src="<?php echo BASE_URL; ?>views/assets/img/users/<?php echo htmlspecialchars($user['photo_profile']); ?>" 
                        alt="Photo user" class="card-img"> </td>
                <td><?= htmlspecialchars($user['username']); ?></td>  
                <td><?= htmlspecialchars($user['email']); ?></td>  
                <td class="text-right">
                    <?php if ($user['username'] === 'admin' && $_SESSION['username'] === 'admin'): ?>
                        <i class="fas fa-trash btn-disabled"></i>
                    <?php else: ?>
                        <a href="index.php?action=delete&id=<?= $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this user?');">
                            <i class="fas fa-trash trash"></i>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="<?php echo BASE_URL; ?>views/assets/js/ajax-searchUsers.js"></script>

