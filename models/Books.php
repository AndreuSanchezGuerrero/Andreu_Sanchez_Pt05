<?php

class Book {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createBook($isbn, $name, $author, $userId) {
        $sql = "INSERT INTO books (isbn, name, author, user_id) VALUES (:isbn, :name, :author, :user_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
    }
    

    // Get all books or books by user ID if user is logged in
    public function getBooks($userId) {
        if (!$userId) {
            $sql = "SELECT * FROM books";
            $stmt = $this->pdo->prepare($sql);
        } else {
            $sql = "SELECT * FROM books WHERE user_id = :userId";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookById($id) {
        $sql = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBook($id, $isbn, $name, $author) {
        $sql = "UPDATE books SET isbn = :isbn, name = :name, author = :author WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':author', $author);

        return $stmt->execute();
    }

    public function deleteBook($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
