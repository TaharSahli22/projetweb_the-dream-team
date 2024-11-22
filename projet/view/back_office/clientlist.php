<?php
// Include database connection
require_once(__DIR__ . '/../../config.php');

$error = "";

// Fetch all clients from the database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=projet_web", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM Client");
    $stmt->execute();
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error fetching clients: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client List</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Style pour la page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .btn {
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-warning {
            background-color: #ffc107;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Client List</h2>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <!-- Client List Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clients)): ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($client['id']); ?></td>
                        <td><?php echo htmlspecialchars($client['Name']); ?></td>
                        <td><?php echo htmlspecialchars($client['Last_Name']); ?></td>
                        <td><?php echo htmlspecialchars($client['email']); ?></td>
                        <td>
                            <!-- Modify Button -->
                            <a href="modify.php?id=<?php echo $client['id']; ?>" class="btn btn-warning">Modify</a>

                            <!-- Delete Button with confirmation -->
                            <a href="?confirmDelete=1&id=<?php echo $client['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this client?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No clients found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="../front_office/sig_in.php" class="btn">Add New Client</a>
</div>

<?php
// Vérification si l'ID est passé dans l'URL via la méthode GET
if (isset($_GET['id']) && isset($_GET['confirmDelete']) && $_GET['confirmDelete'] == 1) {
    $clientId = $_GET['id'];

    try {
        // Suppression du client basé sur l'ID
        $stmt = $pdo->prepare("DELETE FROM Client WHERE id = ?");
        $stmt->execute([$clientId]);

        // Redirection après suppression
        header('Location: clientlist.php'); // Redirige vers la page de liste des clients
        exit; // Assure-toi que le script s'arrête ici après redirection
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}
?>

</body>
</html>
