<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../config.php';
require_once '../../Model/Orders.php'; // Update if the file has a different name
require_once '../../Controller/OrdersC.php'; // Update if the file has a different name

// Include PHPMailer
require '../../vendor/autoload.php'; // Path depends on your PHPMailer setup

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug: Check if the request data is being received correctly
    var_dump($_POST); // Dump the POST data to check if it's correct

    // Retrieve form data
    $OrderId = $_POST['OrderId'];   // Ensure this matches the key used in JavaScript
    $Email = $_POST['Email'];       // Ensure this matches the key used in JavaScript
    $fullName = $_POST['fullName']; // Ensure this matches the key used in JavaScript
    $action = $_POST['action'];

    // Example: Assume you have the necessary functions to handle the action.
    // You can process the order here and send emails based on the action
    if ($action == 'accept') {
        // Process accepting the order (Update status, etc.)
        $orderController = new OrdersC();
        $result = $orderController->acceptOrder($OrderId);

        // Send confirmation email
        if ($result['success']) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'spouz2003@gmail.com';
                $mail->Password = 'fdbx olhy sjgg wdwr';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipient
                $mail->setFrom('your-email@gmail.com', 'Your Company');
                $mail->addAddress($Email, $fullName);

                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'Order Accepted';
                $mail->Body = "<h1>Your order has been accepted</h1><p>Dear $fullName, your order is confirmed.</p>";

                // Send email
                $mail->send();
                echo json_encode(['success' => true, 'message' => 'Order accepted and email sent.']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Email could not be sent. Error: ' . $mail->ErrorInfo]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error accepting the order.']);
        }
    } elseif ($action == 'decline') {
        // Process declining the order (Update status, etc.)
        $orderController = new OrdersC();
        $result = $orderController->declineOrder($OrderId);

        // Send rejection email
        if ($result['success']) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'spouz2003@gmail.com';
                $mail->Password = 'fdbx olhy sjgg wdwr';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipient
                $mail->setFrom('your-email@gmail.com', 'Your Company');
                $mail->addAddress($Email, $fullName);

                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'Order Declined';
                $mail->Body = "<h1>Your order has been declined</h1><p>Dear $fullName, your order has been declined.</p>";

                // Send email
                $mail->send();
                echo json_encode(['success' => true, 'message' => 'Order declined and email sent.']);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Email could not be sent. Error: ' . $mail->ErrorInfo]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error declining the order.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
