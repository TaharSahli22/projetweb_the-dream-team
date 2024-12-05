<?php
 // Start session at the top

// Include the database connection file
include "../../config.php";
session_start();
// Handle login form submission
if (isset($_POST["loginSubmit"])) {
    $email = $_POST["loginEmail"] ?? '';
    $password = $_POST["loginPassword"] ?? '';

    // Validate email and password
    if (empty($email) || empty($password)) {
        echo "<div class='error-box'>Email and password are required</div>";
    } else {
        try {
            // Connect to the database
            $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check email and password in the database
            $stmt = $pdo->prepare("SELECT * FROM Client WHERE email = :email AND password = :password");
            $stmt->execute([
                'email' => $email,
                'password' => $password
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Create session variables
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_name"] = $user["Name"];
                $_SESSION["user_email"] = $user["email"];
                $_SESSION["user_role"] = $user["etat"];

                // Redirect to dashboard or home page
                                
                if ($user['etat'] == 1) {  // Admin
                    header("Location: index.php");
                } else {  // Regular User
                    header("Location: ../front_office/indexha.php");
                }
                exit();
            } else {
                echo "<div class='error-box'>Invalid email or password</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='error-box'>Error: " . $e->getMessage() . "</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>NexDegree - Login & Signup</title>
    <link rel="stylesheet" href="style.css" />
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #000; /* Black background */
    margin: 0;
    padding: 0;
}

.animated-bg {
    background: linear-gradient(120deg, #000, #333); /* Adjusted for black gradient */
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
    max-width: 350px;
    width: 100%;
    margin-bottom: 2rem;
}

header {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    color: #28a745; /* Green color for "Log In" */
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
    background-color: #28a745; /* Green button */
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    border: none;
}

input[type="submit"]:hover {
    background-color: #218838; /* Darker green for hover */
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

.forgot-password {
    display: block;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    text-align: right;
    color: #28a745; /* Green for forgot password link */
    text-decoration: none;
}

.forgot-password:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>  
<a href="../front_office/indexha.php" style="color:#2ecc71;font-weight:bold;font-size:25px;text-decoration:none;margin-left:50px">Stocker</a>
<div class="animated-bg"></div>
<section class="wrapper">
    
    <!-- Login Form -->
    <div class="form login">    
        <header>Login</header>
        <form id="loginForm" method="post" action="">
            <input type="email" id="loginEmail" name="loginEmail" placeholder="Email Address"  />
            <input type="password" id="loginPassword" name="loginPassword" placeholder="Password"  />
            <a href="forgot_password.php" class="forgot-password">Forgot password?</a>
            <input type="submit" id="loginSubmit" value="Login" name="loginSubmit" />
            <span style="color:black;font-style:italic;">Don't have a account ?</span>
            <a href="../front_office/sig_in.php" style="text-decoration:none;color:#2ecc71;">Register</a>
        </form>
    </div>
</section>
<script src="./sign_in.js"></script>
</body>
</html>
