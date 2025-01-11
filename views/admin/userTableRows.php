<?php 
    foreach ($users as $user): 
?>
<tr>
    <td><img src="<?php echo BASE_URL; ?>views/assets/img/users/<?php echo htmlspecialchars($user['photo_profile']); ?>" alt="Photo user" class="card-img"></td>
    <td><?= htmlspecialchars($user['username']); ?></td>
    <td><?= htmlspecialchars($user['email']); ?></td>
    <td class="text-right">
        <?php if ($user['username'] === 'admin' && $_SESSION['username'] === 'admin'): ?>
            <button class="btn btn-disabled btn-sm" disabled title="Admin cannot delete themselves">
                <i class="fas fa-trash"></i>
            </button>
        <?php else: ?>
            <a href="index.php?action=delete&id=<?= $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this user?');">
                <i class="fas fa-trash"></i>
            </a>
        <?php endif; ?>
    </td>
</tr>
<?php 
    endforeach; 
?>
