<?php
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $articleId = $_GET['id'];
    
    // Verificar si el ID és un número enter vàlid
    if (!filter_var($articleId, FILTER_VALIDATE_INT)) {
        CustomSessionHandler::set('errorsUrl', "L'ID especificat no és vàlid.");
        header("Location: index.php");
        exit();
    } else {
        $articleToEdit = $controller->getArticleById($articleId);
        
        // Si l'article no existeix
        if (!$articleToEdit) {
            CustomSessionHandler::set('errorsUrl', "L'article amb l'ID especificat no existeix.");
            header("Location: index.php");
            exit();
        } else {
            $isEdit = true;
        }
    }
}
?>

<?php
// Comprovar si és una acció de eliminació
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar si el ID és un número enter vàlid
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        CustomSessionHandler::set('errorsUrl', "L'ID especificat no és vàlid.");
        header("Location: index.php");
        exit();
    } else {
        $articleToDelete = $controller->getArticleById($id);

        if (!$articleToDelete) {
            CustomSessionHandler::set('errorsUrl', "L'article amb l'ID especificat no existeix.");
            header("Location: index.php");
            exit();
        } else {
            // Si el article existeix, procedir amb l'eliminació
            $controller->deleteArticle($id);
            CustomSessionHandler::set('operation', 'delete');
            CustomSessionHandler::set('success', true);
            header("Location: index.php");
            exit();
        }
    }
}

?>

<div>
    <!-- Formulari de creació/edició, detecta automàticament si estem en edició o creació -->
    <form action="<?php echo $isEdit ? 'index.php?action=update&id=' . $articleToEdit['id'] : htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-article">
        <!-- Títol del formulari amb un ternari, si estem en edició editem i si no creem-->
        <h2><?php echo $isEdit ? 'Editar Article' : 'Crear Nou Article'; ?></h2>

        <div class="form-group">
            <label for="title">Títol:</label>
            <input  type="text" 
                    id="title" 
                    name="title" 
                    class="form-control" 
                    required 
                    value="<?php echo $isEdit ? htmlspecialchars($articleToEdit['title']) : ''; ?>"> <!-- Si estem en edició, carregar el títol de l'article -->
        </div>

        <div class="form-group">
            <label for="body">Cos:</label>
            <textarea   id="body" 
                        name="body" 
                        class="form-control" 
                        required><?php echo $isEdit ? htmlspecialchars($articleToEdit['body']) : ''; ?></textarea> <!-- Si estem en edició, carregar el cos de l'article -->
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $isEdit ? 'Actualitzar Article' : 'Afegir Article'; ?></button>

        <!-- Comprovar si hi han errors i mostrar-los en cas de que hi hagin -->
        <?php if (!empty($errors)): ?> 
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p class="error-msg"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Camp ocult per identificar que es el formulari de creació/edició al hora de fer el submit -->
        <input type="hidden" name="form_type" value="article_form">
    </form>
</div>