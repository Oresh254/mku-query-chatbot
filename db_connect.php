<?php
// Only start the session if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection details
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Leave empty if no password is set
$dbname = "login_system"; // Ensure this is the correct database name

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
