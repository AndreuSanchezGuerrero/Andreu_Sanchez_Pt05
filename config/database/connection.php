<?php
// Andreu Sánchez Guerrero

require_once __DIR__ . '/../env.php'; 

$host = DB_VAR['DB_HOST'];
$dbname = DB_VAR['DB_NAME'];
$username = DB_VAR['DB_USER'];
$password = DB_VAR['DB_PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
