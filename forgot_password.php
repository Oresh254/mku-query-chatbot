<?php
session_start();

// Include your database connection file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = trim($_POST['username']);

    // Check if the username exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $enteredUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If the username exists, save it in the session and redirect to the reset password form
        $_SESSION['username_to_reset'] = $enteredUsername;
        header("Location: reset_password.php"); // Redirect to reset password page
        exit();
    } else {
        echo "Username not found.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form action="" method="post">
        <label for="username">Enter your username:</label>
        <input type="text" name="username" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
