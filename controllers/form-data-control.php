<?php
// Andreu Sánchez Guerrero
// Incloure el controlador de la sessió
include_once 'CustomSessionHandler.php';
require_once 'models/Article.php';

// Validar les dades
if (empty($_POST["title"])) {
    $errors[] = "El camp 'Títol' està buit.";
} else {
    $title = htmlspecialchars(trim($_POST["title"]));
    if (strlen($title) > 100) {
        $errors[] = "El camp 'Títol' no pot tenir més de 100 caràcters.";
    }
}

if (empty($_POST["body"])) {
    $errors[] = "El camp 'Cos' està buit.";
} else {
    $body = htmlspecialchars(trim($_POST["body"]));
}

// Si hi ha errors, emmagatzemem els errors a la sessió
if (!empty($errors)) {
    CustomSessionHandler::set('success', false);
    CustomSessionHandler::set('errors', $errors);
} else {
    try {
        // Crear una instància del model Article
        $articleModel = new Article($pdo);

        // Si estem en mode edició actualitzar l'article amb l'ID
        if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $articleModel->update($id, $title, $body);
            CustomSessionHandler::set('operation', 'update');
        
        }  else {
            // Mode creació -> inserir article
            $articleModel->create($title, $body);
            CustomSessionHandler::set('operation', 'create');
        }
        // Si l'operació és correcta, emmagatzemem success a la sessió
        CustomSessionHandler::set('success', true);
        CustomSessionHandler::remove('errors');
    } catch (PDOException $e) {
        // Si hi ha un error a la base de dades, emmagatzemem l'error
        $errors[] = "Error en inserir l'article: " . $e->getMessage();
        CustomSessionHandler::set('success', false);
        CustomSessionHandler::set('errors', $errors);
    }
}
// Redirigim a la pàgina principal per mostrar errors o missatges de success
header("Location: index.php");
exit();
?>
