<?php
// Include your database connection file
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        
        // Store the token in the database with an expiration time (optional)
        $stmt = $conn->prepare("INSERT INTO password_resets (email, token, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $email, $token);
        $stmt->execute();

        // Create the reset link (ensure you replace the domain with your own)
        $resetLink = "http://yourdomain.com/reset_password.php?token=" . $token;

        // Send the email (you can use mail() function or any mail library)
        mail($email, "Password Reset Request", "Click here to reset your password: " . $resetLink);

        echo "A password reset link has been sent to your email.";
    } else {
        echo "No account found with that email address.";
    }

    $stmt->close();
}
$conn->close();
?>
