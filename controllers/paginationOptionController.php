<?php
// Andreu Sánchez Guerrero
$booksPerPage = CustomSessionHandler::get('booksPerPage') ?? (isset($_COOKIE['booksPerPage']) ? (int)$_COOKIE['booksPerPage'] : 5);
$totalBooks = count($booksToUse);
$totalPages = $totalBooks > 0 ? ceil($totalBooks / $booksPerPage) : 1;

$page = isset($_GET['page']) ? (int)$_GET['page'] : (isset($_COOKIE['currentPage']) ? (int)$_COOKIE['currentPage'] : 1); 

if (!filter_var($page, FILTER_VALIDATE_INT) || $page < 1 || $page > $totalPages) {
    header("Location: " . $_SERVER['PHP_SELF'] . "?page=1");
    exit();
}

setcookie('currentPage', $page, time() + (86400 * 30), "/");
$offset = ($page - 1) * $booksPerPage;

$booksToShow = $bookController->getBooksByPage($booksPerPage, $offset, CustomSessionHandler::get('user_id')); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['form_type']) == 'pagination') {
        $booksPerPage = (int)$_POST['booksPerPage'];
        $page = (int)$_POST['page'];

        setcookie('booksPerPage', $booksPerPage, time() + (86400 * 30), "/");
        setcookie('currentPage', $page, time() + (86400 * 30), "/"); 

        CustomSessionHandler::set('booksPerPage', $booksPerPage);
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=" . $page);
        exit();
    }
}
?>

