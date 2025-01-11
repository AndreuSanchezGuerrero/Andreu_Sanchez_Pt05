<?php
// Andreu Sánchez Guerrero

include BASE_PATH . 'controllers/books/bookListController.php';

$isAjax = isset($_GET['ajax']) && $_GET['ajax'] == 'true';

?>

<?php if (!$isAjax): ?>
<div class="col-6">
    <div class="header-section">
        <?php if ($userId): ?>
            <p class="title-page">Your books</p>
        <?php else: ?>
            <p class="title-page">Public books</p>
        <?php endif; ?>

        <div class="search-container">
            <form id="search-form" action="index.php" method="GET">
                <div class="search-wrapper">
                    <input 
                        type="text" 
                        name="search" 
                        id="search-input" 
                        placeholder="Search for a book..." 
                        class="search-input">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="pagination-options">
        <?php include BASE_PATH . 'views/components/pagination/pagination-option.php'; ?>
    </div>
<?php endif; ?>

<div id="book-cards" class="card-container">
    <?php if (!empty($booksToShow)): ?>
        <?php foreach ($booksToShow as $book): ?>
            <div class="card">
                <img src="<?php echo BASE_URL; ?>views/assets/img/covers/<?php echo htmlspecialchars($book['cover'] ?? 'default-cover.jpg'); ?>" 
                    alt="Cover of <?php echo htmlspecialchars($book['name']); ?>" class="card-img">
                <div class="card-content">
                    <p class="card-isbn"><?= htmlspecialchars($book['isbn']); ?></p>
                    <h3 class="card-title"><?= htmlspecialchars($book['name']); ?></h3>
                    <p class="card-author"><?= htmlspecialchars($book['author']); ?></p>
                    <?php if ($userId): ?>
                        <div class="card-actions">
                            <a href="index.php?action=edit&id=<?= $book['id']; ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <a href="index.php?action=delete&id=<?= $book['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this book?');">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No books available.</p>
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
