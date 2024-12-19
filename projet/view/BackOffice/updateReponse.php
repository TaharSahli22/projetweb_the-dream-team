<?php
include '../../controller/reclamationController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $reponse = $_POST['reponse'];

    $reponseController = new ReponseController();
    $reponseController->updateReponse($id, $reponse);

    // Redirect back to the main page
    header('Location: showReponse.php'); // Replace "yourPage.php" with your actual page name
    exit;
}
?>
