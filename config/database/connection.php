<?php
// Andreu Sánchez Guerrero

require_once __DIR__ . '/../env.php';
require_once BASE_PATH . 'logs/LogGenerator.php';

$host = DB_VAR['DB_HOST'];
$dbname = DB_VAR['DB_NAME'];
$username = DB_VAR['DB_USER'];
$password = DB_VAR['DB_PASSWORD'];

$logGenerator = new LogGenerator(BASE_PATH . 'logs/database/');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $logGenerator->logSuccess("Database connection by user '{$username}' to database '{$dbname}'.", 'success-database.log');

} catch (PDOException $e) {
    $logGenerator->logError("Connection error: " . $e->getMessage(), 'error-database.log');

    header("Location: " . BASE_URL . "views/errors/database-error.php");
    exit();
}
?>
