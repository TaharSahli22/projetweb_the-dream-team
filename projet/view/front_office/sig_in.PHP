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
    <link rel="stylesheet" href="#" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Black background */
            margin: 0;
            padding: 0;
        }

        .animated-bg {
            background: linear-gradient(120deg, #000, #333); /* Black gradient */
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
            background-color: #fff; /* White background for form */
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
            color: #28a745; /* Green header */
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
<a href="indexha.php" style="color:#2ecc71;font-weight:bold;font-size:25px;text-decoration:none;margin-left:50px">Stocker</a> 
<section class="wrapper">
    <!-- Signup Form -->
   <?php  
    if (isset($_POST["signupSubmit"])) {
        $firstName = htmlspecialchars($_POST["firstName"] ?? '');
        $secondName = htmlspecialchars($_POST["secondName"] ?? '');
        $email = htmlspecialchars($_POST["email"] ?? '');
        $password = $_POST["password"] ?? '';
        $cpassword = $_POST["cpassword"] ?? '';
        $etat = $_POST["etat"] ?? ''; // Get the selected etat

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
                // Corrected SQL query
                $stmt = $pdo->prepare("INSERT INTO Client (Name, Last_Name, email, password, etat) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$firstName, $secondName, $email,$password,$etat]);

                header("Location: ../back_office/log_in.php");
                exit;
            }
        } catch (PDOException $e) { 
            echo "<div class='error-box'>
                    <i class='error-icon'>⚠️</i>
                    <span class='error-message'>Error adding client: " . $e->getMessage() . "</span>
                  </div>";
        }
    }
    ?>
    
    <div class="form signup">
        <header>Signup</header>
        <form id="signupForm" method="post" action="">
            <input type="text" id="firstName" name="firstName" placeholder="First Name"  />
            <input type="text" id="secondName" name="secondName" placeholder="Last Name"  />
            <input type="email" id="email" name="email" placeholder="Email Address"  />
            <input type="password" id="password" name="password" placeholder="Password"  />
            <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password"  />
            
            <!-- Add radio buttons for selecting etat (Admin or User) -->
            <label>Select Role:</label><br>
            <input type="radio" name="etat" value="1" required /> Admin
            <input type="radio" name="etat" value="2" required /> User
            <br><br>
            
            <input type="submit" id="signupSubmit" value="Signup" name="signupSubmit" />
            <span style="color:black;font-style:italic;">Already have an account?</span>
            <a href="../back_office/log_in.php" style="text-decoration:none;color:#2ecc71;">Login now</a>
        </form>
    </div>
</section>
<script>
    document.getElementById("signupForm").addEventListener("submit", function (event) {
        let isValid = true;

        // Réinitialiser les messages d'erreur
        const errorMessages = document.querySelectorAll(".error-message");
        errorMessages.forEach((msg) => msg.remove());

        // Obtenir les valeurs des champs
        const firstName = document.getElementById("firstName").value.trim();
        const secondName = document.getElementById("secondName").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;
        const cpassword = document.getElementById("cpassword").value;

        // Fonction d'affichage des erreurs
        function showError(inputId, message) {
            const inputField = document.getElementById(inputId);
            const errorSpan = document.createElement("span");
            errorSpan.classList.add("error-message");
            errorSpan.style.color = "red";
            errorSpan.style.fontSize = "0.9em";
            errorSpan.textContent = message;
            inputField.insertAdjacentElement("afterend", errorSpan);
        }

        // Validation du prénom
        if (firstName.length < 2) {
            showError("firstName", "First Name must be at least 2 characters.");
            isValid = false;
        }

        // Validation du nom de famille
        if (secondName.length < 2) {
            showError("secondName", "Last Name must be at least 2 characters.");
            isValid = false;
        }

        // Validation de l'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showError("email", "Please enter a valid email address.");
            isValid = false;
        }

        // Validation du mot de passe
        if (password.length < 8) {
            showError("password", "Password must be at least 8 characters.");
            isValid = false;
        } else if (!/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
            showError("password", "Password must contain at least one uppercase letter and one number.");
            isValid = false;
        }

        // Vérification de la correspondance des mots de passe
        if (cpassword !== password) {
            showError("cpassword", "Passwords do not match.");
            isValid = false;
        }

        // Empêcher la soumission si une erreur est détectée
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>
</body>
</html>
