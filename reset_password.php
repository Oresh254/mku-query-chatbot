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

// Check if the user is coming from the forgot password page with a valid username
if (!isset($_SESSION['username_to_reset'])) {
    die("You must provide a valid username first.");
}

$usernameToReset = $_SESSION['username_to_reset']; // Get the username to reset

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = trim($_POST['new_password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Basic validation
    if (empty($newPassword) || empty($confirmPassword)) {
        echo "Both password fields are required.";
        exit;
    }

    if ($newPassword !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Update the password in the database for the specified username
    $sql = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newPassword, $usernameToReset);

    if ($stmt->execute()) {
        // Unset the session variable to avoid reusing it
        unset($_SESSION['username_to_reset']);
        echo "Password has been reset successfully! <a href='index.php'>Go to login</a>";
    } else {
        echo "Error updating password: " . $stmt->error;
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
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form action="" method="post">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>
        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required>
        <br>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
