<div id="book-table">
    <?php if (!empty($booksToUse)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        ISBN
                        <i class="sort-icon fas fa-sort-up" data-column="isbn" data-order="asc"></i>
                    </th>
                    <th>
                        Book name
                        <i class="sort-icon fas fa-sort-up" data-column="name" data-order="asc"></i>
                    </th>
                    <th>
                        Author
                        <i class="sort-icon fas fa-sort-up" data-column="author" data-order="asc"></i>
                    </th>
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
                    <a href="index.php?action=edit&id=<?= $book['id']; ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="index.php?action=delete&id=<?= $book['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this book?');">
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
</div>