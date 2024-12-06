
<?php
include '../../controller/reclamationController.php';
$reponseC = new ReponseController();
$reponseC->deleteReponse($_GET['id']);
header('Location:showReponse.php');
?>
