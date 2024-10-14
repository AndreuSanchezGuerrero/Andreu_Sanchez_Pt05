<?php
// Obtener posibles errores de URL desde la sesión
$errorsUrl = CustomSessionHandler::get('errorsUrl');
CustomSessionHandler::remove('errorsUrl');

// Obtener el estado de éxito o errores generales del formulario
$success = CustomSessionHandler::get('success');
$errors = CustomSessionHandler::get('errors');
$operation = CustomSessionHandler::get('operation');

// Limpiar la sesión de esos valores una vez que se hayan utilizado
CustomSessionHandler::remove('success');
CustomSessionHandler::remove('errors');
CustomSessionHandler::remove('operation');
?>

<div id="alert" class="alert"></div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Mostrar errores relacionados con la URL (errorsUrl)
    let errorsUrl = "<?php echo addslashes($errorsUrl); ?>";
    <?php if (!empty($errorsUrl)): ?> 
        showAlert(errorsUrl, 'error'); 
    <?php endif; ?>

    // Obtenemos la operación de la sesión: puede ser 'create', 'update', o 'delete'
    let operation = "<?php echo addslashes($operation); ?>";

    // Mostrar alerta basada en la operación realizada (crear, actualizar, eliminar)
    <?php if (!empty($errors)): ?>
        showAlert('Hi ha errors en el formulari, revisa els camps.', 'error');
    <?php elseif (!empty($success) && $success === true): ?>
        if (operation === 'update') {
            showAlert('S\'ha actualitzat correctament el llibre.', 'success');
        } else if (operation === 'create') {
            showAlert('S\'ha afegit un llibre correctament.', 'success');
        } else if (operation === 'delete') {
            showAlert('S\'ha eliminat correctament el llibre.', 'success');
        }
    <?php endif; ?>
});
</script>
