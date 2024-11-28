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
    

    public function getBooks($userId = null, $column = null, $order = null, $limit = null, $offset = null) {
        $validColumns = ['isbn', 'name', 'author'];
        $validOrder = ['asc', 'desc'];
    
        $orderClause = '';
        if ($column && in_array($column, $validColumns) && in_array($order, $validOrder)) {
            $orderClause = " ORDER BY $column $order";
        }
    
        $limitClause = '';
        if ($limit !== null && $offset !== null) {
            $limitClause = " LIMIT :limit OFFSET :offset";
        }
    
        if ($userId) {
            $sql = "SELECT * FROM books WHERE user_id = :userId" . $orderClause . $limitClause;
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        } else {
            $sql = "SELECT * FROM books" . $orderClause . $limitClause;
            $stmt = $this->pdo->prepare($sql);
        }
    
        if ($limit !== null && $offset !== null) {
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
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

    public function isIsbnExists($isbn, $excludeId = null) {
        $query = "SELECT COUNT(*) FROM books WHERE isbn = :isbn";
        
        if ($excludeId) {
            $query .= " AND id != :excludeId";
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);

        if ($excludeId) {
            $stmt->bindParam(':excludeId', $excludeId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function getBooksByPage($limit, $offset, $userId = null) {
        $sql = $userId 
            ? "SELECT * FROM books WHERE user_id = :userId LIMIT :limit OFFSET :offset"
            : "SELECT * FROM books LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        if ($userId) {
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        }
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBooksPaginatedAndSorted($limit, $offset, $sortColumn, $sortOrder, $userId = null, $filters = []) {
        $columns = ['isbn', 'name', 'author'];
        if (!in_array($sortColumn, $columns)) {
            $sortColumn = 'name';
        }
        $sortOrder = strtolower($sortOrder) === 'desc' ? 'DESC' : 'ASC';
    
        // Construcción inicial de la consulta
        $sql = "SELECT * FROM books";
        $conditions = [];
        $params = [];
    
        // Filtro por usuario
        if ($userId) {
            $conditions[] = "user_id = :userId";
            $params[':userId'] = $userId;
        }
    
        // Filtros dinámicos
        if (!empty($filters['isbn'])) {
            $conditions[] = "isbn LIKE :isbn";
            $params[':isbn'] = '%' . $filters['isbn'] . '%';
        }
        if (!empty($filters['name'])) {
            $conditions[] = "name LIKE :name";
            $params[':name'] = '%' . $filters['name'] . '%';
        }
        if (!empty($filters['author'])) {
            $conditions[] = "author LIKE :author";
            $params[':author'] = '%' . $filters['author'] . '%';
        }
    
        // Añadir las condiciones al SQL
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }
    
        // Orden y paginación
        $sql .= " ORDER BY $sortColumn $sortOrder LIMIT :limit OFFSET :offset";
    
        // Preparar y ejecutar la consulta
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
