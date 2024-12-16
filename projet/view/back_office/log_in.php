<?php
// Start session at the top
include "../../config.php";
session_start();

// Handle login form submission
if (isset($_POST["loginSubmit"])) {
    $email = $_POST["loginEmail"] ?? '';
    $password = $_POST["loginPassword"] ?? '';
    $recaptchaToken = $_POST["g-recaptcha-response"] ?? '';  // For reCAPTCHA v2

    if (empty($recaptchaToken)) {
        echo "<div class='error-box'>Please confirm that you are not a robot. <a href='login.php' class='return-link'>Return to Login</a></div>";
    } elseif (empty($email) || empty($password)) {
        echo "<div class='error-box'>Email and password are required. <a href='login.php' class='return-link'>Return to Login</a></div>";
    } else {
        try {
            // Verify reCAPTCHA token with Google's API using CURL
            $recaptchaSecret = '6Lf34ZgqAAAAAP9jDhZBZXGFL7NUsSiQ6MvbK-ER';  // Replace with your secret key
            $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $recaptchaUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'secret' => $recaptchaSecret,
                'response' => $recaptchaToken
            ]));

            $response = curl_exec($ch);
            curl_close($ch);

            $responseKeys = json_decode($response, true);

            if (intval($responseKeys["success"]) !== 1) {
                echo "<div class='error-box'>reCAPTCHA verification failed. Please try again. <a href='log_in.php' class='return-link'>Return to Login</a></div>";
            } else {
                // Proceed with user authentication
                $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("SELECT * FROM Client WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    // Check if the user is banned
                    if ($user['status'] === 'banned') {
                        $banUntil = $user['ban_until'];

                        // Check if the ban has expired
                        if (strtotime($banUntil) > time()) {
                            $remainingTime = ceil((strtotime($banUntil) - time()) / 60); // Minutes remaining
                            echo "<div class='error-box'>You are banned for another $remainingTime minutes. <a href='log_in.php' class='return-link'>Return to Login</a></div>";
                            exit();
                        } else {
                            // If ban expired, reset status
                            $updateStmt = $pdo->prepare("UPDATE Client SET status = 'active', ban_until = NULL WHERE id = :id");
                            $updateStmt->execute(['id' => $user['id']]);
                            $user['status'] = 'active';
                        }
                    }

                    // Check if the password matches (assume hashed passwords for security)
                    if ($password == $user['password']) {
                        // Log in the user
                        $_SESSION["user_id"] = $user["id"];
                        $_SESSION["user_name"] = $user["Name"];
                        $_SESSION["user_email"] = $user["email"];
                        $_SESSION["user_role"] = $user["etat"];
                    
                        // Redirect based on user role
                        if ($user['etat'] == 1) { // Admin
                            header("Location: index.php");
                        } else { // User
                            header("Location: ../front_office/indexha.php");
                        }
                        exit();
                    } else {
                        echo "<div class='error-box'>Invalid email or password. <a href='login.php' class='return-link'>Return to Login</a></div>";
                    }
                } else {
                    echo "<div class='error-box'>Invalid email or password. <a href='login.php' class='return-link'>Return to Login</a></div>";
                }
            }
        } catch (PDOException $e) {
            echo "<div class='error-box'>Error: " . $e->getMessage() . " <a href='login.php' class='return-link'>Return to Login</a></div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>  <!-- reCAPTCHA v2 script -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            margin: 0;
            padding: 0;
        }

        .animated-bg {
            background: linear-gradient(120deg, #000, #333);
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            width: 100%;
            margin-bottom: 2rem;
        }

        header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #28a745;
            text-align: center;
        }

        input[type="text"], 
        input[type="email"], 
        input[type="password"], 
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .error-box {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            padding: 10px;
            margin-top: 1rem;
            border-radius: 5px;
            text-align: center;
        }

        .return-link {
            color: #007bff;
            text-decoration: none;
        }

        .return-link:hover {
            text-decoration: underline;
        }

        .forgot-password {
            display: block;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            text-align: right;
            color: #28a745;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .checkbox-container {
            margin: 20px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .checkbox-container input {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .checkbox-container label {
            font-size: 1rem;
            color: #333;
            cursor: pointer;
            margin-left: 5px;
        }
        .g-recaptcha {
            width: 100%;
        }
    </style>
</head>
<body>
<a href="indexha.php" style="color:#2ecc71;font-weight:bold;font-size:25px;text-decoration:none;margin-left:50px">Stocker</a> 
<section class="wrapper">
    <div class="form login">
        <header>Login</header>
        <form method="post" action="">
            <input type="email" name="loginEmail" placeholder="Email Address" >
            <input type="password" name="loginPassword" placeholder="Password" >
            
            <!-- reCAPTCHA v2 Widget -->
            <div class="g-recaptcha" data-sitekey="6Lf34ZgqAAAAAN3fxtgXprzJPuFo1FPDn-BLUXn3"></div>
            
            <input type="submit" name="loginSubmit" value="Login" class="btn btn-primary w-100">
            <a href="forgot_password.php" class="forgot-password">Forgot password?</a>
            <span style="color:black;font-style:italic;">Don't have an account?</span>
            <a href="../front_office/sig_in.php" style="text-decoration:none;color:#2ecc71;">Register</a>
        </form>
    </div>
</section>
<script>
    function validateForm() {
        const email = document.querySelector('input[name="loginEmail"]');
        const password = document.querySelector('input[name="loginPassword"]');

        if (!email.value || !password.value) {
            alert("Email and Password are required.");
            return false;
        }

        return true;
    }
</script>
</body>
</html>
