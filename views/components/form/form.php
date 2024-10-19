<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Colocar todo el control de acciones aquí, al principio del archivo, para evitar cualquier salida HTML o echo antes del uso de header().
if (CustomSessionHandler::get('success')) {
    $success = true;
    CustomSessionHandler::remove('success');
} elseif (!CustomSessionHandler::get('success')) {
    $errors = CustomSessionHandler::get('errors');
    CustomSessionHandler::remove('success');
    CustomSessionHandler::remove('errors');
}

// Comprobar si es una acción de eliminación
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar si el ID es un número entero válido
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        CustomSessionHandler::set('errorsUrl', "L'ID especificat no és vàlid.");
        header("Location: index.php");
        exit();
    } else {
        $bookToDelete = $bookController->getBookById($id);

        if (!$bookToDelete) {
            CustomSessionHandler::set('errorsUrl', "El llibre amb l'ID especificat no existeix.");
            header("Location: index.php");
            exit();
        } else {
            // Eliminar el libro
            $bookController->deleteBook($id);
            CustomSessionHandler::set('operation', 'delete');
            CustomSessionHandler::set('success', true);
            header("Location: index.php");
            exit();
        }
    }
}

// Comprobar si es una acción de edición
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Verificar si el ID es un número entero válido
    if (!filter_var($bookId, FILTER_VALIDATE_INT)) {
        CustomSessionHandler::set('errorsUrl', "L'ID especificat no és vàlid.");
        header("Location: index.php");
        exit();
    } else {
        $bookToEdit = $bookController->getBookById($bookId);

        if (!$bookToEdit) {
            CustomSessionHandler::set('errorsUrl', "El llibre amb l'ID especificat no existeix.");
            header("Location: index.php");
            exit();
        } else {
            $isEdit = true;
        }
    }
}
?>
<!-- Hasta este punto no debería haber ninguna salida hacia el navegador -->

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
