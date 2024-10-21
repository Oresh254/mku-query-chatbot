<?php
// Include your database connection file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system"; // Ensure the database name is correct

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Basic validation
    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
        exit;
    }

    // Check if the username already exists
    $checkUserSql = "SELECT * FROM users WHERE username = ?";
    $checkStmt = $conn->prepare($checkUserSql);
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error: Username already taken. Please choose another username.";
        $checkStmt->close();
        $conn->close();
        exit;
    }

    // Store the password as plain text (not recommended for production)
    // Remove the password_hash line
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);  // Directly bind the plain text password

    if ($stmt->execute()) {
        echo "Registration successful! <a href='index.php'>Go to login</a>";
    } else {
        echo "Error: " . $stmt->error; // Show error from the statement
    }

    // Close statements
    $stmt->close();
    $checkStmt->close();
}

// Close connection
$conn->close();
?>
