<?php
// config.php

// Database connection settings
$servername = "localhost"; // Replace with your host name (e.g., 'localhost')
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "announcement_system"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Database connection settings
$host = 'localhost'; // Database host, usually 'localhost'
$dbname = 'announcement_system'; // Your database name
$username = 'root'; // Your MySQL username (default is 'root')
$password = ''; // Your MySQL password (usually empty in XAMPP)

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set the PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Display an error message if the connection fails
    die("Connection failed: " . $e->getMessage());
}


?>
