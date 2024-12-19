<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "monumentdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch notifications ordered by newest first
$result = $conn->query("SELECT message, created_at FROM notifications ORDER BY created_at DESC");

$notifications = [];
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
        }

        .notification {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .notification-time {
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Notifications</h1>
    <?php if (count($notifications) > 0): ?>
        <?php foreach ($notifications as $notification): ?>
            <div class="notification">
                <p><?php echo htmlspecialchars($notification['message']); ?></p>
                <p class="notification-time">At: <?php echo $notification['created_at']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No notifications available.</p>
    <?php endif; ?>
</body>
</html>
