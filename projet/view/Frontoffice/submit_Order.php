<?php
// submit_order.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../config.php';
require_once '../../Model/Orders.php';
require_once '../../Controller/OrdersC.php';

// Include PHPMailer
require '../../vendor/autoload.php'; // Path depends on your PHPMailer setup

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fullName = $_POST['fullName'];
    $Email = $_POST['email']; 
    $phoneNumber = $_POST['phoneNumber'];
    $Clocation = $_POST['Clocation'];
    $Productname = $_POST['Productname'];
    $Productprice = $_POST['Productprice'];
    $Quantity = $_POST['productQuantity'];
    $TotalPrice = $_POST['totalPrice'];
    $ProdId = $_POST['idprod'];
    $PhoneNumber = "21629751606";

    // Insert order
    $order = new Orders(null, $fullName, $Email, $phoneNumber, $Clocation, $Productname, $Productprice, $Quantity, $TotalPrice, $ProdId);
    $ordersC = new OrdersC();
    $result = $ordersC->insertOrder($order);

    if ($result['success']) {
        // Send confirmation email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'spouz2003@gmail.com'; 
            $mail->Password = 'fdbx olhy sjgg wdwr'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipient
            $mail->setFrom('your-email@gmail.com', 'Terra Di Cultura');
            $mail->addAddress($Email, "$fullName");

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Order Confirmed';
            $mail->Body = "
                <h1>Order Confirmed</h1>
                <p>Dear $fullName,</p>
                <p>Your purchase for the product <strong>$Productname</strong> with the price <strong>$Productprice</strong> has been received.</p>
                <p>You bought $Quantity of this product, and it will cost you <strong>$TotalPrice</strong>.</p>
                <p>We will deliver your product in 3 Days.</p>
                <p>If you encounter any problem with delivery, please contact us at <a href='mailto:spouz2003@gmail.com'>TerraDiCultura</a></p>
                <p>Thank you for choosing us!</p>
                <p>Best regards,<br>Terra Di Cultura</p>
            ";

            // Send email
            $mail->send();
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Order saved, but email could not be sent. Error: ' . $mail->ErrorInfo]);
        }

        // Send SMS notification
        $smsMessage = [
            "messages" => [
                [
                    "destinations" => [["to" => $PhoneNumber]],
                    "from" => "TerraDiCultura",
                    "text" => "Dear Admin , $fullName  ordered  for $Productname with quantity $Quantity . Check Dashboard for more infos ."
                ]
            ]
        ];

        $smsHeaders = [
            "Authorization: App 6293e5f5877d37347042bfe9cc938274-60f57a13-179d-43d6-bed3-14f601a2d0fd",
            "Content-Type: application/json",
            "Accept: application/json"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://v3wx6e.api.infobip.com/sms/2/text/advanced");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($smsMessage));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $smsHeaders);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $smsResponse = curl_exec($ch);
        $smsError = curl_error($ch);
        curl_close($ch);

        if ($smsError) {
            echo json_encode(['success' => false, 'message' => 'Order saved, but SMS could not be sent. Error: ' . $smsError]);
        } else {
            echo json_encode(['success' => true]);
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Order failed: ' . $result['message']]);
    }
}
?>
