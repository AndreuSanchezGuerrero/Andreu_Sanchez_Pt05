<?php
include BASE_PATH . 'controllers/users/UserController.php';
if (isset($_GET['ajax']) && $_GET['ajax'] === 'true' && isset($_GET['action']) && $_GET['action'] === 'searchUsers') {
    $userController = new UserController($pdo);
    $query = $_GET['query'] ?? '';
    $users = $userController->getUserBySearch($query);

    ob_start();
    include BASE_PATH . 'views/admin/userTableRows.php';
    $tableData = ob_get_clean();

    echo json_encode(['tableData' => trim($tableData)]);
    exit();
}
?>