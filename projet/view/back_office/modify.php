<?php
require_once(__DIR__ . '/../../config.php');

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

// Récupération des informations du client
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM Client WHERE id = ?");
    $stmt->execute([$id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        die("Client not found.");
    }
}

// Mise à jour des données du client
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateClient'])) {
    $firstName = $_POST['firstName'];
    $secondName = $_POST['secondName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation des champs obligatoires
    if (empty($firstName) || empty($secondName) || empty($email)) {
        echo "<p class='error-message'>All fields except password are required.</p>";
    } elseif (!empty($password) && $password !== $_POST['cpassword']) {
        echo "<p class='error-message'>Passwords do not match.</p>";
    } else {
        // Construction de la requête SQL
        if (!empty($password)) {
            $sql = "UPDATE Client SET Name = ?, Last_Name = ?, email = ?, password = ? WHERE id = ?";
            $params = [$firstName, $secondName, $email, $password, $id];
        } else {
            $sql = "UPDATE Client SET Name = ?, Last_Name = ?, email = ? WHERE id = ?";
            $params = [$firstName, $secondName, $email, $id];
        }

        // Exécution de la requête
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($params)) {
            header("Location: modify.php?id=$id&success=1");
            exit;
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "<p class='error-message'>Error updating client: " . $errorInfo[2] . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Client</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            width: 100%;
            padding: 12px;
            background-color: #6c757d;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .success-message {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .msg_success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 15px;
    border-radius: 5px;
    font-family: Arial, sans-serif;
    max-width: 500px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class='msg_success'>
                            <h3>Client updated successfully!</h3>
                    </div>
        <?php endif; ?>
        <h3>Modify Client Data</h3>
        <form action="modify.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($client['Name']); ?>" required>

            <label for="secondName">Last Name:</label>
            <input type="text" id="secondName" name="secondName" value="<?php echo htmlspecialchars($client['Last_Name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>

            <label for="password">New Password (leave empty if not changing):</label>
            <input type="password" id="password" name="password">

            <label for="cpassword">Confirm Password:</label>
            <input type="password" id="cpassword" name="cpassword">

            <button type="submit" name="updateClient">Update Client</button>
        </form>
        <br>
        <a href="clientList.php" class="btn-secondary">Back to Client List</a>
    </div>
</body>
</html>
