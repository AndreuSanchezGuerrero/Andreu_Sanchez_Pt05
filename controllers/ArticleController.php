<?php
// Andreu Sánchez Guerrero
// Controlador d'articles
// Incloure el model Article
require_once 'models/Article.php';
class ArticleController {
    private $articleModel;

    public function __construct($pdo) {
        // Iniciar el model Article
        $this->articleModel = new Article($pdo);
    }

    // Mètode per obtenir tots els articles
    public function getArticles() {
        // Cridar el mètode getAll() del model per obtenir tots els articles
        return $this->articleModel->getAll();
    }

    // Métode per agafar un article per la seva id
    public function getArticleById($id) {
        return $this->articleModel->getById($id);
    }
    // Eliminar un article
    public function deleteArticle($id) {
        $this->articleModel->delete($id);
    }

    // Contar el total de artículos
    public function countArticles() {
        return $this->articleModel->count();
    }

    // Obtener los artículos para la página actual
    public function getArticlesByPage($limit, $offset) {
        return $this->articleModel->getByPage($limit, $offset);
    }
}
?>
