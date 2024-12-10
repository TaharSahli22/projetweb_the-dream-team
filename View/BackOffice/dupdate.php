<?php
include_once '../../controller/dcontroller.php';
include_once '../../Model/dntn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $bank = $_POST['bank'];
    $account = $_POST['account'];
    $iban = $_POST['iban'];
    $amount = $_POST['amount']; 
    
    $donation = new donations($name, $address, $phone, $bank, $account, $iban, $amount);
    $dcontroller = new dController();
    $dcontroller->updatedonation($donation, $id);
    header('Location: mlist.php'); 
    exit;
}
?>
