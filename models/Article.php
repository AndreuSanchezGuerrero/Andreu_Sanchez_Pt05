<?php
// Andreu Sánchez Guerrero
class Article {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $articles = $this->pdo->query("SELECT * FROM articles ORDER BY id DESC");
        return $articles->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $body) {
        $articles = $this->pdo->prepare("INSERT INTO articles (title, body) VALUES (:title, :body)");
        $articles->execute(['title' => $title, 'body' => $body]);
    }

    public function update($id, $title, $body) {
        $articles = $this->pdo->prepare("UPDATE articles SET title = :title, body = :body WHERE id = :id");
        $articles->execute(['id' => $id, 'title' => $title, 'body' => $body]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM articles WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function count() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM articles");
        return $stmt->fetchColumn();
    }
    public function getByPage($limit, $offset) {
        $stmt = $this->pdo->prepare("SELECT * FROM articles LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
