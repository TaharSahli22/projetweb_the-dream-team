<?php
// Include database connection
require_once(__DIR__ . '/../../config.php');

$error = ""; // Variable to store error messages
$success = ""; // Variable to store success message

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['deleteEmail'])) {
    $email = htmlspecialchars($_POST['deleteEmail']); // Sanitize email input

    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the DELETE query
        $stmt = $pdo->prepare("DELETE FROM Client WHERE email = ?");
        $stmt->execute([$email]);

        // Check if a row was deleted
        if ($stmt->rowCount() > 0) {
            $success = "Client with email $email was successfully deleted.";
        } else {
            $error = "No client found with email $email.";
        }
    } catch (PDOException $e) {
        $error = "Error deleting client: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Delete Client</h2>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php elseif (!empty($success)): ?>
        <p style="color: green;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form action="deleteclient.php" method="POST" id="deleteForm">
        <label for="deleteEmail">Enter Email to Delete:</label>
        <input type="email" id="deleteEmail" name="deleteEmail" placeholder="Client Email" required>
        <button type="submit" class="btn btn-danger">Delete Client</button>
    </form>

    <a href="addClient.php" class="btn btn-secondary">Back to Add Client</a>
</div>
</body>
</html>
