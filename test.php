<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

echo "Conectando a: $host<br>";

try {
    $conn = new PDO("mysql:host=$host;dbname=srv1_account;charset=utf8;connect_timeout=5", $user, $pass);
    echo "✅ Conexión exitosa!";
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>