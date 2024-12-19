<?php
require_once '../../config.php'; // Include your database connection

// Establish database connection
$db = new database();
$conn = $db->getConnexion();

// Fetch the latest notification
$query = "SELECT message FROM notifications ORDER BY created_at DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->execute();

$notification = $stmt->fetch(PDO::FETCH_ASSOC);

// Return the notification as JSON
if ($notification) {
    echo json_encode(['message' => $notification['message']]);
} else {
    echo json_encode(['message' => null]);
}
?>
