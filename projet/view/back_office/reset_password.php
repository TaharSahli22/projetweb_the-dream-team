<?php
session_start();
include "../../config.php";

// Check if the token is set
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the token exists and is valid
        $stmt = $pdo->prepare("SELECT * FROM Client WHERE reset_token = :token AND reset_token_expiration > NOW()");
        $stmt->execute(['token' => $token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Get the new password
                $newPassword = $_POST["newPassword"] ?? '';

                if (empty($newPassword)) {
                    $message = "New password is required.";
                } else {
                    // Update the password in the database
                    $updateStmt = $pdo->prepare("UPDATE Client SET password = :password, reset_token = NULL, reset_token_expiration = NULL WHERE email = :email");
                    $updateStmt->execute([
                        'password' =>$newPassword,
                        'email' => $user['email']
                    ]);

                    $message = "Your password has been reset successfully. You can now <a href='log_in.php'>log in</a>.";
                }
            }
        } else {
            $message = "Invalid or expired token.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
} else {
    $message = "Invalid request.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Black background */
            color: #f1f1f1; /* Light text color for readability */
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            background-color: #1e1e1e; /* Dark gray container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #28a745; /* Green header */
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            color: #f1f1f1; /* Light text for labels */
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #333;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            background-color: #2e2e2e; /* Darker background for input fields */
            color: #f1f1f1; /* Light text inside input fields */
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #28a745; /* Green button */
            color: #fff; /* White text */
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .message {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .message.error {
            background-color: #f8d7da; /* Light red background */
            color: #721c24; /* Dark red text */
        }

        .message.success {
            background-color: #d4edda; /* Light green background */
            color: #155724; /* Dark green text */
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #28a745; /* Green link */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reset Password</h1>

        <!-- Display messages -->
        <?php if (isset($message)): ?>
            <p class="message <?php echo (strpos($message, 'success') !== false) ? 'success' : 'error'; ?>"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Form to reset password -->
        <?php if (isset($user)): ?>
            <form method="POST" action="">
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" placeholder="Enter new password" required>

                <button type="submit">Reset Password</button>
            </form>
        <?php endif; ?>

        <a href="log_in.php">Back to Login</a>
    </div>
</body>
</html>
