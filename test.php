<?php
include 'config.php';

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');

try {
    $conn = new PDO("mysql:host=" . $host . ";dbname=srv1_account", $user, $password);
    echo "✅ Conexión exitosa a srv1_account!";
} catch(PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}
