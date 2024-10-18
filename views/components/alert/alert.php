<?php
// Obtener posibles errores de URL desde la sesión
$errorsUrl = CustomSessionHandler::get('errorsUrl');
CustomSessionHandler::remove('errorsUrl');

$loginError = CustomSessionHandler::get('login_error');
$loginSuccess = CustomSessionHandler::get('login_success');
CustomSessionHandler::remove('login_error');
CustomSessionHandler::remove('login_success');

$logoutMessage = CustomSessionHandler::get('logout_message');
CustomSessionHandler::remove('logout_message');

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
    <?php if (!empty($errorsUrl)): ?> 
        showAlert(errorsUrl, 'error'); 
    <?php endif; ?>

    <?php if (!empty($loginError)): ?>
        showAlert(loginError, 'error');
    <?php endif; ?>

    <?php if (!empty($loginSuccess) && $loginSuccess === true): ?>
        showAlert('Inicio de sesión exitoso', 'success');
    <?php endif; ?>

    <?php if (!empty($logoutMessage)): ?>
        showAlert('Has cerrado sesión correctamente.', 'success');
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
