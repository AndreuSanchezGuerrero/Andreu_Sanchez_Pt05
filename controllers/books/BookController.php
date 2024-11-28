<?php
require_once BASE_PATH . 'models/Books.php';
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

    public function getBooks($userId = null, $column = null, $order = null, $limit = null, $offset = null) {
        return $this->bookModel->getBooks($userId, $column, $order, $limit, $offset);
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
        if (!is_int($limit) || !is_int($offset)) {
            throw new Exception("Limit and offset must be integers.");
        }

        return $this->bookModel->getBooksByPage($limit, $offset, $userId);
    }

    public function getBooksPaginatedAndSorted($limit, $offset, $sortColumn, $sortOrder, $userId = null) {
        return $this->bookModel->getBooksPaginatedAndSorted($limit, $offset, $sortColumn, $sortOrder, $userId);
    }
}