<?php
// Andreu Sánchez Guerrero

require_once 'config/database/connection.php'; 
require_once 'controllers/CustomSessionHandler.php';
require_once 'controllers/ArticleController.php';

// Variable per controlar el missatge de success, si está false es que hi ha errors i no s'ha enviat. Poden haber errors per enviar el formulari o per la URL
$success = false;
$errors = [];
$errorsUrl = '';

// Estem en mode edició?
$isEdit = false;
// Variable per emmagatzemar les dades de l'article a editar
$articleToEdit = null;

// Crear una instància del controlador d'articles i obtenir tots els articles
$controller = new ArticleController($pdo);
$articles = $controller->getArticles(); 

// Incloure la vista principal
require_once 'views/layout.php'; 
?>
