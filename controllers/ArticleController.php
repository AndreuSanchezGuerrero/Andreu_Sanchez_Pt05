<?php
// Andreu Sánchez Guerrero
// Controlador d'articles
// Incloure el model Article
require_once 'models/Article.php';
class ArticleController {
    private $articleModel;

    public function __construct($pdo) {
        $this->articleModel = new Article($pdo);
    }

    public function getArticles() {
        return $this->articleModel->getAll();
    }

    public function getArticleById($id) {
        return $this->articleModel->getById($id);
    }

    public function deleteArticle($id) {
        $this->articleModel->delete($id);
    }

    public function countArticles() {
        return $this->articleModel->count();
    }

    public function getArticlesByPage($limit, $offset) {
        return $this->articleModel->getByPage($limit, $offset);
    }
}
?>
