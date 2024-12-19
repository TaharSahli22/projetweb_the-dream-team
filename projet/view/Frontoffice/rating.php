<?php
// Inclure la connexion à la base de données et le contrôleur des réponses
include_once '../../controller/reclamationController.php';
var_dump($_POST['id']);
var_dump($_POST['rating_']);
// Vérifier si la réponse et la note ont été envoyées
if (isset($_POST['id']) && isset($_POST['rating_'])   && isset($_POST['id_reclamations'])   ) {
   $id_reclamations=$_POST['id_reclamations'];
    $id = $_POST['id'];  
    $rating = $_POST['rating_'];  // La note associée à cette réponse

    // Créer une instance du contrôleur
    $reponseController = new reponseController();

    // Appeler la fonction pour enregistrer la note
    $reponseController->enregistrerEvaluation($id, $rating);

    // Rediriger vers la page des réponses avec succès
    header("Location: showReponse.php?id=" . $id_reclamations); // redirection avec la réponse comme paramètre
    exit;
} else {
    echo "Données manquantes.";
}

?>