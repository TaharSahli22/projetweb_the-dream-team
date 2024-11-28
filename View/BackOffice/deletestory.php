<?php
include '../../controller/blogController.php';
$blogController = new blogController();
$blogController->deletestory($_GET["id"]);
header('Location:blogdash.php');
