<?php
include '../../controller/blogController.php';
$comController = new comController();
$comController->deletecomment($_GET["id"]);
header('Location:blogtem.php');
