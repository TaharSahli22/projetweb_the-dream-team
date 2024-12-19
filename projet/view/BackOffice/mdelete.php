<?php
include '../../controller/mcontroller.php';
$mcontroller = new mController();
$mcontroller->deletemonument($_GET["id"]);
header('Location:mlist.php');
?>