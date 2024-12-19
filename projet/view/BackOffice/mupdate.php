<?php
include_once '../../controller/mcontroller.php';
include_once '../../Model/mnmt.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image']; 
    $monument = new monuments($name, $description, $price, $image);
    $mcontroller = new mController();
    $mcontroller->updatemonument($monument, $id);
    header('Location: mlist.php'); 
    exit;
}
?>



