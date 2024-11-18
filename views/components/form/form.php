<?php
// Andreu Sánchez Guerrero
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include BASE_PATH . 'controllers/form-books/editOrDeleteFormDataController.php';

if (isset($_POST['form_type']) && $_POST['form_type'] == 'book_form') {
    include 'controllers/form-books/form-data-control.php';
}
?>


<div>
    <form action="<?php echo $isEdit ? 'index.php?action=update&id=' . $bookToEdit['id'] : htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-book">
        <h2><?php echo $isEdit ? 'Edit book' : 'Add new book'; ?></h2>

        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" class="form-control" required value="<?php if ($isEdit) echo htmlspecialchars($bookToEdit['isbn']); ?>">
        </div>

        <div class="form-group">
            <label for="name">Book Name:</label>
            <input type="text" id="name" name="name" class="form-control" required value="<?php if ($isEdit) echo htmlspecialchars($bookToEdit['name']); ?>">
        </div>

        <div class="form-group">
            <label for="author">Name of the author:</label>
            <input type="text" id="author" name="author" class="form-control" required value="<?php if ($isEdit) echo htmlspecialchars($bookToEdit['author']); ?>">
        </div>

        <button type="submit" class="btn btn-primary"><?php echo $isEdit ? 'Update book' : 'Add book'; ?></button>
        
        <input type="hidden" name="form_type" value="book_form">
    </form>
</div>
