<?php
include '../../controller/blogController.php';
$com=null;
$comController = new comController();
$com = $comController->showcomment($_GET["id"]);
$id=$com['stryid'];
$comController->deletecomment($com['id']);
header("Location:blogdash.php");