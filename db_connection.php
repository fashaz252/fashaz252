<?php
// Database credentials
$host = '127.0.0.1';  // or 'localhost'
$db   = 'test_db';    // your database name
$user = 'root';       // MySQL username (root by default for XAMPP)
$pass = '';           // MySQL password (empty by default for XAMPP)
$charset = 'utf8mb4'; // Character set

// Set DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Set default fetch mode to associative array
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements
];

// Try to establish the connection
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Connection success
    echo "Connected successfully!";
} catch (\PDOException $e) {
    // Handle connection error
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

