<?php
require_once 'models/Books.php';
class BookController {
    private $pdo;
    private $bookModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->bookModel = new Book($pdo);
    }

    // Create a new book
    public function createBook($isbn, $name, $author) {
        try {
            return $this->bookModel->createBook($isbn, $name, $author);
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {  // Duplicate entry error code
                throw new Exception("The ISBN already exists. Please enter a different one.");
            } else {
                throw new Exception("Failed to create the book: " . $e->getMessage());
            }
        }
    }

    // Get all books
    public function getBooks() {
        return $this->bookModel->getBooks();
    }

    // Get a book by ID
    public function getBookById($id) {
        return $this->bookModel->getBookById($id);
    }

    // Update a book
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

    // Delete a book
    public function deleteBook($id) {
        return $this->bookModel->deleteBook($id);
    }

    public function countBooks() {
        return $this->bookModel->countBooks();
    }

    public function getBooksByPage($limit, $offset) {
        $stmt = $this->pdo->prepare("SELECT * FROM books LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
