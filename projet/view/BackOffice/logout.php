<?php
session_start(); // Démarrer ou reprendre la session

// Détruire toutes les données de la session
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session active

// Rediriger l'utilisateur vers la page de login ou d'accueil
header("Location: ../FrontOffice/index.php");
exit(); // Toujours utiliser exit après un header pour éviter d'exécuter du code inutile
?>
