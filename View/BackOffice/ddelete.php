<?php
include '../../controller/dcontroller.php';
$dcontroller = new dController();
$dcontroller->deletedonation($_GET["id"]);
header('Location:mlist.php');
?>