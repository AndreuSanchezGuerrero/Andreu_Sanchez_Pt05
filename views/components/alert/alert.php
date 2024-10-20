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
        showAlert('Successful login', 'success');
    <?php endif; ?>

    <?php if (!empty($logoutMessage)): ?>
        showAlert('Successful logout.', 'success');
    <?php endif; ?>

    let operation = "<?php echo addslashes($operation); ?>";

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
