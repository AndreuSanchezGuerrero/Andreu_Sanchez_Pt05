<?php
$bookController = new BookController($pdo);

$books = $bookController->getBooks();
$userBooks = $bookController->getBooks($userId);
$booksToUse = $userId ? $userBooks : $books;
?>
