<?php
// Andreu Sánchez Guerrero
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include BASE_PATH . 'controllers/editOrDeleteFormDataController.php';

if (CustomSessionHandler::get('success')) {
    $success = true;
    CustomSessionHandler::remove('success');
} elseif (!CustomSessionHandler::get('success')) {
    $errors = CustomSessionHandler::get('errors');
    CustomSessionHandler::remove('success');
    CustomSessionHandler::remove('errors');
}

if (isset($_POST['form_type']) && $_POST['form_type'] == 'book_form') {
    include 'controllers/form-data-control.php';
    exit();
}
?>


<div>
    <!-- Formulario de creación/edición -->
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

        <!-- Mostrar errores si los hay -->
        <?php if (!empty($errors)): ?> 
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p class="error-msg"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Campo oculto para identificar si es edición o creación -->
        <input type="hidden" name="form_type" value="book_form">
    </form>
</div>

