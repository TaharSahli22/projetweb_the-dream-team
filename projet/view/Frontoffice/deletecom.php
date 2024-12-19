<?php
include '../../controller/blogController.php';
$comController = new comController();
$comment=$comController->showcomment($_GET["id"]);

$comController->deletecomment($_GET["id"]);
header('Location:commentpage.php?id='.$comment["stryid"]);
