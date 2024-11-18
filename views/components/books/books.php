<?php
// Andreu Sánchez Guerrero
include BASE_PATH . 'controllers/books/bookListController.php';

$isAjax = isset($_GET['ajax']) && $_GET['ajax'] == 'true';
?>

<?php if (!$isAjax): ?>
<div class="col-6">
    <div class="header-section">
        <?php if ($userId): ?>
            <h2>Your books</h2>
        <?php else: ?>
            <h2>Public books</h2>
        <?php endif; ?>
        <div id="pagination-options">
            <?php include BASE_PATH . 'views/components/pagination/pagination-option.php'; ?>
        </div>
        <div id="pagination-controls">
            <?php include BASE_PATH . 'views/components/pagination/pagination.php'; ?>
        </div>
    </div>
<?php endif; ?>

<div id="book-table">
    <?php if (!empty($booksToUse)): ?>
        <?php if (!$isAjax): ?>
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
        <?php endif; ?>

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

        <?php if (!$isAjax): ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php else: ?>
        <p>There are no books available.</p>
    <?php endif; ?>
</div>

<?php if (!$isAjax): ?>
    <div id="pagination-controls2">
        <?php include BASE_PATH . 'views/components/pagination/pagination.php'; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL; ?>views/assets/js/ajax-pagination.js"></script>
</div>
<?php endif; ?>
