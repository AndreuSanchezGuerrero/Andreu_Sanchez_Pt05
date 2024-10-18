<?php
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



<div>
    <!-- Formulari de creació/edició, detecta automàticament si estem en edició o creació -->
    <form action="<?php echo $isEdit ? 'index.php?action=update&id=' . $bookToEdit['id'] : htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-book">
        <!-- Títol del formulari amb un ternari, si estem en edició editem i si no creem-->
        <h2><?php echo $isEdit ? 'Edit book' : 'Add new book'; ?></h2>

        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input  type="text" 
                    id="isbn" 
                    name="isbn" 
                    class="form-control" 
                    required 
                    value="<?php echo $isEdit ? htmlspecialchars($bookToEdit['isbn']) : ''; ?>"> <!-- Si estem en edició, carregar el ISBN del llibre -->
        </div>

        <div class="form-group">
            <label for="name">Book Name:</label>
            <input  type="text" 
                    id="name" 
                    name="name" 
                    class="form-control" 
                    required 
                    value="<?php echo $isEdit ? htmlspecialchars($bookToEdit['name']) : ''; ?>"> <!-- Si estem en edició, carregar el nom del llibre -->
        </div>

        <div class="form-group">
            <label for="author">Name of the author:</label>
            <input  type="text" 
                    id="author" 
                    name="author" 
                    class="form-control" 
                    required 
                    value="<?php echo $isEdit ? htmlspecialchars($bookToEdit['author']) : ''; ?>"> <!-- Si estem en edició, carregar l'autor del llibre -->
        </div>

        <button type="submit" class="btn btn-primary"><?php echo $isEdit ? 'Update book' : 'Add book'; ?></button>

        <!-- Comprovar si hi han errors i mostrar-los en cas de que hi hagin -->
        <?php if (!empty($errors)): ?> 
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p class="error-msg"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Camp ocult per identificar que es el formulari de creació/edició al hora de fer el submit -->
        <input type="hidden" name="form_type" value="book_form">
    </form>
</div>

