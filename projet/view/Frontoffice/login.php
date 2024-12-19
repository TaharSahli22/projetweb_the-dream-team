<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
include('../../config.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
    

    // Connexion à la base de données
    try {
        $db = config::getConnexion();

        // Requête pour récupérer l'utilisateur avec ce nom
        $stmt = $db->prepare("SELECT * FROM client WHERE email = :email");
        $stmt->execute(['email' => $email]);

        // Vérifier si un utilisateur a été trouvé
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérifier si le mot de passe est correct
            if ($password== $user['password']) {
                // Démarrer la session de l'utilisateur
                $_SESSION['user_id'] = $user['id']; // Id de l'utilisateur
                $_SESSION['user_nom'] = $user['Name']; // Nom de l'utilisateur

                // Rediriger vers une page protégée ou la page d'accueil
                header('Location: blogtem.php');
                exit();
            } else {
                // Si le mot de passe est incorrect
                header("Location: sig_in.php?error=Mot de passe incorrect .'$password'");
                exit();
            }
        } else {
            // Si l'utilisateur n'existe pas
            header('Location: sig_in.php?error=Nom d\'utilisateur incorrect');
            exit();
        }
    } catch (PDOException $e) {
        // En cas d'erreur de connexion
        echo "Erreur: " . $e->getMessage();
    }
}
?>
