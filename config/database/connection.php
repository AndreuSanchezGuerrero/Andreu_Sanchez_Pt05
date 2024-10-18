<?php
// Andreu Sánchez Guerrero

// Fitxer de variables d'entorn
require_once __DIR__ . '/../env.php'; 

$host = DB_VAR['DB_HOST'];
$dbname = DB_VAR['DB_NAME'];
$username = DB_VAR['DB_USER'];
$password = DB_VAR['DB_PASSWORD'];

try {
    // Creem la connexió amb la base de dades
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Per a que llenci excepcions en cas d'error
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage()); // Si hi ha un error, el mostrem
}
?>
