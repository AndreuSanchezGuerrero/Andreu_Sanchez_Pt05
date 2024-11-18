<?php
require_once 'models/Books.php';
class BookController {
    private $pdo;
    private $bookModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->bookModel = new Book($pdo);
    }

    public function createBook($isbn, $name, $author, $userId) {
        try {
            return $this->bookModel->createBook($isbn, $name, $author, $userId);
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {  // Duplicate entry error code
                throw new Exception("The ISBN already exists. Please enter a different one.");
            } else {
                throw new Exception("Failed to create the book: " . $e->getMessage());
            }
        }
    }

    public function getBooks($userId = null) {
        return $this->bookModel->getBooks($userId);
    }

    public function getBookById($id) {
        return $this->bookModel->getBookById($id);
    }

    public function updateBook($id, $isbn, $name, $author) {
        try {
            return $this->bookModel->updateBook($id, $isbn, $name, $author);
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                throw new Exception("The ISBN already exists. Please enter a different one.");
            } else {
                throw new Exception("Failed to update the book: " . $e->getMessage());
            }
        }
    }

    public function deleteBook($id) {
        return $this->bookModel->deleteBook($id);
    }

    public function getBooksByPage($limit, $offset, $userId = null) {
        if ($userId) {
            $stmt = $this->pdo->prepare("SELECT * FROM books WHERE user_id = :userId LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM books LIMIT :limit OFFSET :offset");
        }
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
