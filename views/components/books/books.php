<!-- Andreu Sánchez Guerrero -->
<div class="col-6">
    <h2 id="margin">List of books</h2>
    <?php if (!empty($books)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Book name</th>
                    <th>Author</th> 
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= htmlspecialchars($book['isbn']); ?></td>  
                        <td><?= htmlspecialchars($book['name']); ?></td>  
                        <td><?= htmlspecialchars($book['author']); ?></td>  
                        <td>
                            <a href="index.php?action=edit&id=<?= $book['id']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="index.php?action=delete&id=<?= $book['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Estàs segur que vols eliminar aquest llibre?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>There are no books available.</p>
    <?php endif; ?>

    <?php include __DIR__ . '/../pagination/pagination.php'; ?>
</div>
