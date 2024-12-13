<?php
include '../../controller/blogController.php';


$comController = new comController();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_email = $_POST['recipient_email'];
    $report_id = $_POST['report_id'];
    $comment= $comController->showcomment($report_id);
    $message=$comment['cmt'];
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
        $mail->addAddress($recipient_email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "worning";
        $mail->Body = nl2br("Dear User,<br><br>this is a worning for unapropriate behavier:<br><br>$message<br><br>Best regards,<br>Your Company");
        
        $mail->send();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Reservation saved, but email could not be sent. Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Reservation failed: ' . $result['message']]);
}
    
?>
