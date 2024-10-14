<?php

class Book {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new book
    public function createBook($isbn, $name, $author) {
        $sql = "INSERT INTO books (isbn, name, author) VALUES (:isbn, :name, :author)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':author', $author);

        return $stmt->execute();
    }

    // Get all books
    public function getBooks() {
        $sql = "SELECT * FROM books";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a book by ID
    public function getBookById($id) {
        $sql = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a book
    public function updateBook($id, $isbn, $name, $author) {
        $sql = "UPDATE books SET isbn = :isbn, name = :name, author = :author WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':author', $author);

        return $stmt->execute();
    }

    // Delete a book
    public function deleteBook($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function countBooks() {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM books");
            $stmt->execute();
            return (int) $stmt->fetchColumn();
        } catch (PDOException $e) {
            throw new Exception("Error contando libros: " . $e->getMessage());
        }
    }
}
