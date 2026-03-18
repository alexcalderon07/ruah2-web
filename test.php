<?php
echo "DB_HOST: " . getenv('DB_HOST') . "<br>";
echo "DB_USER: " . getenv('DB_USER') . "<br>";
echo "PHP version: " . phpversion() . "<br>";
echo "PDO drivers: " . implode(', ', PDO::getAvailableDrivers()) . "<br>";
?>