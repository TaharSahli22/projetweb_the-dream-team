<?php
include '../../controller/blogController.php';
$blogController = new blogController();
$blogController->deletestory($_POST["id"]);
header('Location:blogdash.php');
