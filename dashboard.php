<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MKU Query Chatbot - Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background: white;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: green
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background: gray;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;
        }

        .sidebar a:hover {
            background-color: green;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Sidebar for navigation -->
    <div class="sidebar">
        <a href="unanswered.php">Unanswered Queries</a>
        <a href="user_history.php">User History</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main content area -->
    <div class="content">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Use the sidebar to navigate through your query history, unanswered queries, or logout.</p>
    </div>

</body>

</html>
