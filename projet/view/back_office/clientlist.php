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
         body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Black background */
            color: #fff; /* White text */
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #222; /* Darker container background for contrast */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #28a745; /* Green header */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #333; /* Dark table background */
            color: #fff; /* White text for table */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #444; /* Subtle border for better readability */
        }

        th {
            background-color: #28a745; /* Green header background */
            color: white;
        }

        .btn {
            padding: 6px 12px;
            background-color: #28a745; /* Green buttons */
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-danger {
            background-color: #c82333; /* Red for danger button */
        }

        .btn-warning {
            background-color: #e0a800; /* Yellow for warning button */
        }
        .btn-b {
            background-color:#0000ff; /* Yellow for warning button */
        }
        .btn:hover {
            opacity: 0.9; /* Slight dimming on hover */
        }

        .btn-danger:hover {
            background-color: #a71d2a; /* Darker red on hover */
        }

        .btn-warning:hover {
            background-color: #d39e00; /* Darker yellow on hover */
        }

        .btn-secondary {
            background-color: #6c757d; /* Gray for secondary button */
        }

        .btn-secondary:hover {
            background-color: #5a6268; /* Darker gray on hover */
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
                <th>Status</th>
                <th>Banned until</th>
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
                        <td><?php echo htmlspecialchars($client['status']); ?></td>
                        <td><?php echo htmlspecialchars($client['ban_until']); ?></td>
                        <td>
                            <!-- Modify Button -->
                            <a href="modify.php?id=<?php echo $client['id']; ?>" class="btn btn-warning">Modify</a>

                            <!-- Delete Button with confirmation -->
                            <a href="?confirmDelete=1&id=<?php echo $client['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this client?');">Delete</a>
                            <!-- banne Button with confirmation -->
                            
                            <?php if ($client['status'] === 'banned'): ?>
                                <!-- Show Cancel Ban button if client is banned -->
                                <a href="cancel_ban.php?id=<?php echo $client['id']; ?>" class="btn btn-b">Cancel</a>
                            <?php else: ?>
                                <!-- Show Ban button if client is active -->
                                <a href="ban.php?id=<?php echo $client['id']; ?>" class="btn btn-danger">Ban</a>
                            <?php endif; ?>
                        

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
    <a href="index.php" class="btn">back to dashboard</a>
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
