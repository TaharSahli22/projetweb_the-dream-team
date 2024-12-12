<?php
include "../../config.php";  // Make sure this file has your database connection info
session_start();

// Handle banning a user
if (isset($_POST['banUser'])) {
    $userId = $_POST['userId'];
    $banDuration = $_POST['banDuration']; // in minutes

    // Check if the ban duration is valid
    if (empty($banDuration) || !is_numeric($banDuration) || $banDuration <= 0) {
        $errorMessage = "Please provide a valid ban duration (in minutes).";
    } else {
        try {
            // Create the PDO connection
            $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Calculate the ban expiration time
            $ban_until = date('Y-m-d H:i:s', strtotime("+$banDuration minutes"));

            // Update the user's status to 'banned' and set the expiration time
            $stmt = $pdo->prepare("UPDATE Client SET status = 'banned', ban_until = :ban_until WHERE id = :id");
            $stmt->execute(['ban_until' => $ban_until, 'id' => $userId]);

            $successMessage = "User banned until $ban_until.";
        } catch (PDOException $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    }
}

// Handle canceling a ban
if (isset($_POST['cancelBan'])) {
    $userId = $_POST['userId'];

    try {
        // Create the PDO connection
        $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Update the user's status to 'active' and reset the ban_until field
        $stmt = $pdo->prepare("UPDATE Client SET status = 'active', ban_until = NULL WHERE id = :id");
        $stmt->execute(['id' => $userId]);

        $successMessage = "User ban has been canceled.";

        // Redirect back to the client list page after canceling the ban
        header("Location: clientlist.php?message=" . urlencode($successMessage));
        exit();  // Ensure the script stops here to avoid any further processing
    } catch (PDOException $e) {
        $errorMessage = "Error: " . $e->getMessage();
    }
}

// Fetch clients from the database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM Client");
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errorMessage = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client List</title>
    <style>
        /* General page styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #00FF00;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Success and error messages */
        .message {
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
        }

        .success {
            background-color: #28a745;
            color: white;
        }

        .error {
            background-color: #dc3545;
            color: white;
        }

        /* Client list and form styles */
        .client {
            background-color: #1e1e1e;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .client p {
            margin: 5px 0;
        }

        .form-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        input[type="number"] {
            padding: 5px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #28a745;
            background-color: #121212;
            color: white;
        }

        button {
            background-color: #28a745;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .cancel-btn {
            background-color: #dc3545;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }

        hr {
            border: 1px solid #444;
        }
    </style>
</head>
<body>
    <h1>Client List</h1>

    <!-- Display Success or Error Messages -->
    <?php if (isset($successMessage)) { ?>
        <div class="message success"><?php echo $successMessage; ?></div>
    <?php } ?>
    <?php if (isset($errorMessage)) { ?>
        <div class="message error"><?php echo $errorMessage; ?></div>
    <?php } ?>

    <!-- Display each client and their current status -->
    <?php foreach ($clients as $client) {
        $userId = $client['id'];
        $status = $client['status'];
        ?>
        <div class="client">
            <p>Client ID: <?php echo $userId; ?></p>
            <p>Status: <?php echo $status; ?></p>
            <div class="form-container">
                <?php if ($status !== 'banned'): ?>
                    <form action="clientlist.php" method="POST" style="display:inline;">
                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                        <input type="number" name="banDuration" placeholder="Ban Duration (min)" required>
                        <button type="submit" name="banUser">Ban</button>
                    </form>
                <?php else: ?>
                    <p>This user is banned until <?php echo $client['ban_until']; ?>.</p>
                    <!-- Cancel Ban Button -->
                    <form action="cancel_ban.php" method="POST" style="display:inline;">
                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                        <button type="submit" name="cancelBan" <?php echo ($status == 'active') ? 'disabled' : ''; ?>>Cancel Ban</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <hr>
    <?php } ?>
</body>
</html>
