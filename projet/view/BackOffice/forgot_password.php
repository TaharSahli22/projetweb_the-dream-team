<?php
session_start();
include "../../config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get email from the form
    $email = $_POST["email"] ?? '';

    if (empty($email)) {
        $message = "Email is required.";
    } else {
        try {
            // Connect to the database
            $pdo = new PDO("mysql:host=localhost;dbname=blogs", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the email exists
            $stmt = $pdo->prepare("SELECT * FROM Client WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Generate a unique token for the password reset
                $token = bin2hex(random_bytes(50));

                // Store the token in the database (with an expiration time)
                $stmt = $pdo->prepare("UPDATE Client SET reset_token = :token, reset_token_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email");
                $stmt->execute(['token' => $token, 'email' => $email]);

                // Create the password reset link
                $resetLink = "http://yourdomain.com/reset_password.php?token=" . $token;

                // Initialize PHPMailer
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 2;  // Enable SMTP debugging to see detailed logs

                // Set up SMTP (example for Gmail)
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'spouz2003@gmail.com'; 
                $mail->Password = 'fdbx olhy sjgg wdwr'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
        
                // Recipient
                $mail->setFrom('your-email@gmail.com', 'Terra Di Cultura');
                $mail->addAddress($email);  // Recipient's email

                // Set email content
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = "Click the link below to reset your password:\n\n" . $resetLink;

                // Send the email
                if ($mail->send()) {
                    $message = "A reset link has been sent to your email.";
                } else {
                    $message = "Error sending email. Please try again.";
                }
            } else {
                $message = "Email not found.";
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
        <h1>Forgot Password</h1>

        <!-- Display messages -->
        <?php if (isset($message)): ?>
            <p class="message <?php echo (strpos($message, 'success') !== false) ? 'success' : 'error'; ?>"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <button type="submit">Send Reset Link</button>
        </form>

        <a href="log_in.php">Back to Login</a>
    </div>
</body>
</html>
