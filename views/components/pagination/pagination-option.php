<?php
// Andreu Sánchez Guerrero
include BASE_PATH . 'controllers/paginationOptionController.php';
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-pagination">
    <select name="booksPerPage" id="booksPerPage" onchange="this.form.submit()">
        <option value="5" <?php if ($booksPerPage == 5) echo 'selected'; ?>>5</option>
        <option value="10" <?php if ($booksPerPage == 10) echo 'selected'; ?>>10</option>
        <option value="20" <?php if ($booksPerPage == 20) echo 'selected'; ?>>20</option>
        <option value="50" <?php if ($booksPerPage == 50) echo 'selected'; ?>>50</option>
    </select>

    <input type="hidden" name="form_type" value="pagination">


    <input type="hidden" name="page" value="<?php echo isset($page) ?? 1; ?>">
</form>
