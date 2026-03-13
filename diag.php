<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

echo "<h3>Test conexiones:</h3>";

// Test srv1_account
try {
    $conn = new PDO("mysql:host=$host;dbname=srv1_account", $user, $password);
    echo "✅ srv1_account OK<br>";
} catch(PDOException $e) {
    echo "❌ srv1_account: " . $e->getMessage() . "<br>";
}

// Test srv1_player
try {
    $conn2 = new PDO("mysql:host=$host;dbname=srv1_player", $user, $password);
    echo "✅ srv1_player OK<br>";
    
    // Test tabla player
    $stmt = $conn2->query("SELECT COUNT(*) FROM player LIMIT 1");
    echo "✅ tabla player OK<br>";
    
    // Test tabla player_index
    $stmt2 = $conn2->query("SELECT COUNT(*) FROM player_index LIMIT 1");
    echo "✅ tabla player_index OK<br>";
} catch(PDOException $e) {
    echo "❌ srv1_player: " . $e->getMessage() . "<br>";
}

// Test SQLite
try {
    $sqlite = new PDO("sqlite:include/db/site.db");
    echo "✅ SQLite OK<br>";
    
    // Test tabla news
    $stmt3 = $sqlite->query("SELECT COUNT(*) FROM news LIMIT 1");
    echo "✅ tabla news OK<br>";
} catch(PDOException $e) {
    echo "❌ SQLite: " . $e->getMessage() . "<br>";
}

echo "<br><h3>PHP extensions:</h3>";
echo "PDO: " . (extension_loaded('pdo') ? '✅' : '❌') . "<br>";
echo "PDO MySQL: " . (extension_loaded('pdo_mysql') ? '✅' : '❌') . "<br>";
echo "PDO SQLite: " . (extension_loaded('pdo_sqlite') ? '✅' : '❌') . "<br>";
