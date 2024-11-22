<?php
include "../../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>NexDegree - Login & Signup</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="animated-bg"></div>
<section class="wrapper">
    <!-- Signup Form -->
    <div class="form signup">
    <header>Signup</header>
   <?php  
    if (isset($_POST["signupSubmit"])) {
        $firstName = htmlspecialchars($_POST["firstName"] ?? '');
        $secondName = htmlspecialchars($_POST["secondName"] ?? '');
        $email = htmlspecialchars($_POST["email"] ?? '');
        $password = $_POST["password"] ?? '';
        $cpassword = $_POST["cpassword"] ?? '';

        // Vérification des champs vides
        if (empty($firstName) || empty($secondName) || empty($email) || empty($password) || empty($cpassword)) { ?>
            <div class="error-box">
                <i class="error-icon">⚠️</i>
                <span class="error-message">All fields are required</span>
            </div>
        <?php } 
        // Vérification si les mots de passe correspondent
        elseif ($password !== $cpassword) { ?>
            <div class="error-box">
                <i class="error-icon">⚠️</i>
                <span class="error-message">Passwords do not match</span>
            </div>
        <?php } 
        // Validation de l'email
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { ?>
            <div class="error-box">
                <i class="error-icon">⚠️</i>
                <span class="error-message">Invalid email format</span>
            </div>
        <?php } else {
            try {
                // Connect to the database
                $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Vérification si l'email existe déjà
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM Client WHERE email = ?");
                $stmt->execute([$email]);
                $emailExists = $stmt->fetchColumn();
                if ($emailExists > 0) { ?>
                    <div class="error-box">
                        <i class="error-icon">⚠️</i>
                        <span class="error-message">Email already exists. Please use a different email</span>
                    </div>
                <?php } else {
                    // Insertion du client dans la base de données
                    $stmt = $pdo->prepare("INSERT INTO Client (Name,Last_Name,email,password) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$firstName, $secondName, $email, $password]);

                    // Message de succès
                    echo "<div class='msg_success'>
                            <h3>Client added successfully!</h3>
                            </div>";
 
                }
            } catch (PDOException $e) { 
                echo "<div class='error-box'>
                        <i class='error-icon'>⚠️</i>
                        <span class='error-message'>Error adding client: " . $e->getMessage() . "</span>
                      </div>";
            }
        }
    }
    ?>
   
    <form id="signupForm" method="post" action="">
        <input type="text" id="firstName" name="firstName" placeholder="First Name" required />
        <input type="text" id="secondName" name="secondName" placeholder="Last Name" required />
        <input type="email" id="email" name="email" placeholder="Email Address" required />
        <input type="password" id="password" name="password" placeholder="Password" required />
        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required />
        <input type="submit" id="signupSubmit" value="Signup" name="signupSubmit" />
    </form> 
    </div>
     <!-- Login Form -->
     <div class="form login">
        <header>Login</header>
        <form id="loginForm">
            <input type="email" id="loginEmail" name="loginEmail" placeholder="Email Address" />
            <input type="password" id="loginPassword" name="loginPassword" placeholder="Password" />
            <a href="password.html" class="forgot-password">Forgot password?</a>
            <input type="submit" id="loginSubmit" value="Login" />
        </form>
    </div>
</section>
<script src="./sign_in.js"></script>
</body>
</html>
