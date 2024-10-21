<?php
session_start();
include 'db_connect.php'; // Ensure your database connection is included

// Retrieve the logged-in user's username
$username = $_SESSION['username'];

try {
    // Fetch user's query history
    $stmt = $pdo->prepare("SELECT * FROM query_history WHERE username = :username ORDER BY date DESC");
    $stmt->execute([':username' => $username]);
    $queryHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching user history: " . $e->getMessage();
}

// Check if there is any history
if (empty($queryHistory)) {
    echo "No query history found.";
} else {
    // Display user's query history in a table
    ?>
    <h1>User Query History</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>User Message</th>
            <th>Bot Response</th>
            <th>Timestamp</th>
        </tr>
        <?php foreach ($queryHistory as $query): ?>
        <tr>
            <td><?php echo htmlspecialchars($query['id']); ?></td>
            <td><?php echo htmlspecialchars($query['username']); ?></td>
            <td><?php echo htmlspecialchars($query['query']); ?></td>
            <td><?php echo htmlspecialchars($query['response']); ?></td>
            <td><?php echo htmlspecialchars($query['date']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php
}
?>