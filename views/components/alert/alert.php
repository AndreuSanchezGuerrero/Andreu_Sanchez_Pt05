<?php
// Si en algun moment s'ha enviat el formulari, comprovar si hi ha errors o si s'ha enviat correctament
if (CustomSessionHandler::get('success') === true) {
    $success = true;
    CustomSessionHandler::remove('success');
} elseif (CustomSessionHandler::get('success') === false) {
    $errors = CustomSessionHandler::get('errors');
    CustomSessionHandler::remove('success');
    CustomSessionHandler::remove('errors');
}
?>
<div id="alert" class="alert"></div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mostrar errors relacionats amb la URL (errorUrl)
        let errorsUrl = "<?php echo $errorsUrl; ?>";
        <?php if (!empty($errorsUrl)): ?> 
            showAlert(errorsUrl, 'error'); 
        <?php endif; ?>

        // Obtenim l'operació des de la sessió amb PHP. Pot ser 'create', 'update' o 'delete'
        let operation = "<?php echo CustomSessionHandler::get('operation'); ?>";
        
        // Mostrar alerta basat en l'operació (creació, actualització o eliminació)
        <?php if (!empty($errors)): ?>
            showAlert('Hi ha errors en el formulari, revisa els camps.', 'error');
        <?php elseif ($success): ?>
            if (operation === 'update') {
                showAlert('S\'ha actualitzat correctament l\'article.', 'success');
            } else if (operation === 'create') {
                showAlert('S\'ha afegit un article correctament.', 'success');
            } else if (operation === 'delete') {
                showAlert('S\'ha eliminat correctament l\'article.', 'success');
            }
        <?php endif; ?>
    });
</script>