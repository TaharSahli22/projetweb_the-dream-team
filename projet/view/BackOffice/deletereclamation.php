<?php
include '../../controller/reclamationController.php';
$reclamationC = new reclamationController();
$reclamationC->deletereclamation($_GET["id"]);
header('Location:reclamationback.php');
?>

