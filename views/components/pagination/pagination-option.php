<?php
// Andreu Sánchez Guerrero
include BASE_PATH . 'controllers/pagination/paginationOptionController.php';
?>
<div class="pagination-wrapper">
    <form id="paginationForm" class="form-pagination">
        <label for="booksPerPage">Books</label>
        <div class="select-container">
            <select name="booksPerPage" id="booksPerPage">
                <option value="4" <?php if ($booksPerPage == 4) echo 'selected'; ?>>4</option>
                <option value="8" <?php if ($booksPerPage == 8) echo 'selected'; ?>>8</option>
                <option value="16" <?php if ($booksPerPage == 16) echo 'selected'; ?>>16</option>
                <option value="32" <?php if ($booksPerPage == 32) echo 'selected'; ?>>32</option>
            </select>
        </div>
        <input type="hidden" name="form_type" value="pagination">
        <input type="hidden" name="page" value="<?php echo isset($page) ?? 1; ?>">
    </form>
</div>

