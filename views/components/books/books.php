<!-- Andreu Sánchez Guerrero -->

<div class="col-6">
    <div class="header-section">
        <?php if ($userId): ?>
            <h2>Your books</h2>
        <?php else: ?>
            <h2>Public books</h2>
        <?php endif; ?>
        <?php include __DIR__ . '/../pagination/pagination-option.php'; ?>
        <?php include __DIR__ . '/../pagination/pagination.php'; ?>
    </div>

    <?php if (!empty($booksToUse)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Book name</th>
                    <th>Author</th> 
                    <?php if ($userId): ?>
                        <th></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($booksToShow as $book): ?>
                    <tr>
                        <td><?= htmlspecialchars($book['isbn']); ?></td>  
                        <td><?= htmlspecialchars($book['name']); ?></td>  
                        <td><?= htmlspecialchars($book['author']); ?></td>  
                        <?php if ($userId): ?>
                        <td class="text-right">
                            <!-- Mostrar acciones solo si el usuario está logueado -->
                            <a href="index.php?action=edit&id=<?= $book['id']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="index.php?action=delete&id=<?= $book['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Estás seguro de eliminar este libro?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>There are no books available.</p>
    <?php endif; ?>

    <?php include __DIR__ . '/../pagination/pagination.php'; ?>
</div>