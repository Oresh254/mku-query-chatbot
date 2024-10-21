<?php
session_start();

$host = 'localhost';
$dbUsername = 'root'; // XAMPP default MySQL username
$dbPassword = '';     // No password for XAMPP MySQL
$dbName = 'login_system'; // Your database name

// Create a connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password); // Bind parameters
    $stmt->execute();
    $result = $stmt->get_result();

    // If user exists
    if ($result->num_rows == 1) {
        // Fetch user data
        $_SESSION['username'] = $username;
        header("Location: chatbot_interface.php"); // Redirect to chatbot interface
        exit();
    } else {
        // Invalid username or password
        $error = "Invalid username or password";
        header("Location: index.php?error=" . urlencode($error));
        exit();
    }
}
?>
 