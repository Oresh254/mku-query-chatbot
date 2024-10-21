<?php
session_start();
include 'db_connect.php'; // Ensure your database connection is included

// Retrieve the logged-in user's username
$username = $_SESSION['username'];

try {
    // Fetch user's conversation history
    $stmt = $pdo->prepare("SELECT * FROM conversations WHERE username = :username ORDER BY timestamp DESC");
    $stmt->execute([':username' => $username]);
    $conversationHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching conversation history: " . $e->getMessage();
}

// Check if there is any history
if (empty($conversationHistory)) {
    echo "No conversation history found.";
} else {
    // Display user's conversation history in a table
    ?>
    <h1>User Conversation History</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>User Message</th>
            <th>Bot Response</th>
            <th>Timestamp</th>
        </tr>
        <?php foreach ($conversationHistory as $conversation): ?>
        <tr>
            <td><?php echo htmlspecialchars($conversation['id']); ?></td>
            <td><?php echo htmlspecialchars($conversation['username']); ?></td>
            <td><?php echo htmlspecialchars($conversation['user_message']); ?></td>
            <td><?php echo htmlspecialchars($conversation['bot_response']); ?></td>
            <td><?php echo htmlspecialchars($conversation['timestamp']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php
}
?>
