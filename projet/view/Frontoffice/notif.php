<?php
// notifications.php: Display notifications dynamically

require_once '../../config.php'; // Include your database configuration

// Fetch notifications from the database
$query = "SELECT * FROM notifications ORDER BY created_at DESC LIMIT 5"; // Adjust query as needed
$stmt = $conn->prepare($query);
$stmt->execute();

$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($notifications) {
    foreach ($notifications as $notification) {
        echo "<div class='notification-item'>{$notification['message']}</div>";
    }
} else {
    echo "<p>No new notifications.</p>";
}
?>
