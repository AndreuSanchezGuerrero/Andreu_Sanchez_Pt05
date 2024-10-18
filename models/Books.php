<?php

class Book {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new book
    public function createBook($isbn, $name, $author, $userId) {
        $sql = "INSERT INTO books (isbn, name, author, user_id) VALUES (:isbn, :name, :author, :user_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }
    

    public function getBooks($userId) {
        if (!$userId) {
            // Si no se pasa userId, obtener todos los libros
            $sql = "SELECT * FROM books";
            $stmt = $this->pdo->prepare($sql);
        } else {
            // Si se pasa userId, obtener solo los libros de ese usuario
            $sql = "SELECT * FROM books WHERE user_id = :userId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        }
    
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
}
