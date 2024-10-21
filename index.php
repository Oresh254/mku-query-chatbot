<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Ensure you have this CSS file -->
</head>
<body>
    <div class="login-container">
        <!-- Logo and Name -->
        <div class="logo-container">
            <img src="MKU_Logo.jpg" class="logo" alt="MKU Logo"> <!-- Ensure the image path is correct -->
            <h2>MKU Query ChatBot</h2>
        </div>
        <form action="login.php" method="POST" id="loginForm">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
            <p><a href="forgot_password.php">Forgot Password?</a></p>
            <a href="signup.php" class="signup-link">Sign Up</a> <!-- Link to signup page -->

            <!-- Display error messages -->
            <?php if (isset($_GET['error'])): ?>
                <p id="error-message" style="color:red;"><?php echo $_GET['error']; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
