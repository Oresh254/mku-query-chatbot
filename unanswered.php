<?php
session_start();

// Debugging line
echo "Debug: Unanswered Queries Page Loaded<br>";

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Database connection
$host = 'localhost';
$dbUsername = 'root'; // XAMPP default MySQL username
$dbPassword = '';     // No password for XAMPP MySQL
$dbName = 'login_system'; // Your database name

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch unanswered queries from the query_history table where the bot's response is the default unanswered message
$query = "SELECT * FROM query_history WHERE response = 'Sorry, I don’t have an answer to that. Please contact the administration for more info.'";
$result = $conn->query($query);

// Check if any unanswered queries were returned
if ($result && $result->num_rows > 0) {
    echo "<h2>Unanswered Queries</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>User Query</th> <!-- This header will remain the same -->
                <th>Date</th>
            </tr>";
    
    // Loop through each unanswered query and display it in a table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['username']) . "</td>
                <td>" . htmlspecialchars($row['query']) . "</td> <!-- Display the 'query' from query_history -->
                <td>" . htmlspecialchars($row['date']) . "</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "No unanswered queries found."; // This will execute if there are no records
}

// Close the database connection
$conn->close();
?>
