<?php

$errorsUrl = CustomSessionHandler::get('errorsUrl');
CustomSessionHandler::remove('errorsUrl');  

$loginError = CustomSessionHandler::get('login_error');
$loginSuccess = CustomSessionHandler::get('login_success');
CustomSessionHandler::remove('login_error');
CustomSessionHandler::remove('login_success');

$logoutMessage = CustomSessionHandler::get('logout_message');
CustomSessionHandler::remove('logout_message');

$success = CustomSessionHandler::get('success');
$errors = CustomSessionHandler::get('errors');
$operation = CustomSessionHandler::get('operation');
$errorsForm = CustomSessionHandler::get('errorsForm');
$errorsRegister = CustomSessionHandler::get('errorsRegister');

CustomSessionHandler::remove('success');
CustomSessionHandler::remove('errors');
CustomSessionHandler::remove('operation');
CustomSessionHandler::remove('errorsForm');
CustomSessionHandler::remove('errorsRegister');

?>

<div id="alert" class="alert"></div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    let errorsUrl = "<?php echo addslashes($errorsUrl); ?>";
    let loginError = "<?php echo addslashes($loginError); ?>";
    let loginSuccess = "<?php echo addslashes($loginSuccess); ?>";
    let logoutMessage = "<?php echo addslashes($logoutMessage); ?>";
    let operation = "<?php echo addslashes($operation); ?>";
    let success = "<?php echo addslashes($success); ?>";
    let errors = "<?php echo addslashes($errors); ?>";
    let errorsForm = "<?php echo addslashes($errorsForm); ?>";
    let errorsRegister = "<?php echo addslashes($errorsRegister); ?>";

    // Mostrar errores de URL
    if (errorsUrl) {
        showAlert(errorsUrl, 'error');
    }

    // Mostrar errores de login
    if (loginError) {
        console.log(loginError);
        showAlert(loginError, 'error');
    }

    if (loginSuccess) {
        showAlert(loginSuccess, 'success');
    }

    if (logoutMessage) {
        showAlert(logoutMessage, 'success');
    }

    if (errorsForm) {
        showAlert(errorsForm, 'error');
    }

    if (errorsRegister) {
        showAlert(errorsRegister, 'error');
    }

    // Mostrar alerta basada en la operación realizada (crear, actualizar, eliminar)
    <?php if (!empty($errors)): ?>
        showAlert('There are errors in the form, please check fields.', 'error');
    <?php elseif (!empty($success) && $success === true): ?>
        if (operation === 'update') {
            showAlert('Successfully updated book.', 'success');
        } else if (operation === 'create') {
            showAlert('Successfully added book', 'success');
        } else if (operation === 'delete') {
            showAlert('Successfully removed book.', 'success');
        }
    <?php endif; ?>
});
</script>
