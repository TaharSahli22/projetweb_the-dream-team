<?php
$host = 'localhost';
$dbname = 'monumentdb';
$username = 'root';
$password = '';

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bankName = $_POST['bankName'];
    $accountNumber = $_POST['accountNumber'];
    $iban = $_POST['iban'];
    $amount = $_POST['donationAmount'];

    $sql = "INSERT INTO donations (name, address, phone, bank, account, iban, amount) 
            VALUES (:name, :address, :phone, :bank, :account, :iban, :amount)";

    $stmt = $pdo->prepare($sql);

    try {

        $stmt->execute([
            ':name' => $name,
            ':address' => $email, 
            ':phone' => $phone,
            ':bank' => $bankName,
            ':account' => $accountNumber,
            ':iban' => $iban,
            ':amount' => $amount,
        ]);

        echo "<script>alert('Merci pour votre don !')</script>";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
