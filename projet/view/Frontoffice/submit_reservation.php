<?php
// submit_reservation.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../config.php';
require_once '../../Model/Reservations.php';
require_once '../../Controller/ReservationsC.php';

// Include PHPMailer
require '../../vendor/autoload.php'; // Path depends on your PHPMailer setup

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $Nom = $_POST['nom'];
    $Prenom = $_POST['prenom'];
    $CIN = $_POST['cin'];
    $eventname = $_POST['nomEvenement'];
    $eventdate = $_POST['dateEvenement'];
    $Baggage = $_POST['baggage'];
    $Email = $_POST['email']; // Add an email field in the form
    $IdEvent = $_POST['evenid'];
    $PhoneNumber = "21651894193";

    // Insert reservation
    $reservation = new Reservation($Nom, $Prenom, $CIN, $eventname, $eventdate, $Baggage, $Email,$IdEvent);
    $reservationC = new ReservationC();
    $result = $reservationC->insertReservation($reservation);

    if ($result['success']) {
        // Send confirmation email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Use your email provider's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'spouz2003@gmail.com'; // Your email address
            $mail->Password = 'fdbx olhy sjgg wdwr'; // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipient
            $mail->setFrom('your-email@gmail.com', 'Terra Di Cultura'); // Sender's email and name
            $mail->addAddress($Email, "$Prenom $Nom"); // Recipient's email and name

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Reservation Confirmation';
            $mail->Body = "
                <h1>Reservation Confirmed</h1>
                <p>Dear $Prenom $Nom,</p>
                <p>Your reservation for the event <strong>$eventname</strong> on <strong>$eventdate</strong> has been confirmed.</p>
                <p>Baggage Quantity: $Baggage</p>
                <p>Thank you for choosing us!</p>
                <p>Best regards,<br>Terra Di Cultura </p>
            ";

            // Send email
            $mail->send();
            // Send SMS using Infobip API
            $smsHeaders = [
                "Authorization: App d13b6363fdcc18fbe52de531d03e066f-4e7ce715-9911-499a-8b4b-898cd31422da",
                "Content-Type: application/json",
                "Accept: application/json",
            ];

            $smsBody = json_encode([
                "messages" => [
                    [
                        "destinations" => [["to" => $PhoneNumber]],
                        "from" => "TerraDiCult",
                        "text" => "Dear Admin , $Nom $Prenom reserved for $eventname on $eventdate !",
                    ]
                ]
            ]);

            $smsCh = curl_init();
            curl_setopt($smsCh, CURLOPT_URL, "https://9kzdlv.api.infobip.com/sms/2/text/advanced");
            curl_setopt($smsCh, CURLOPT_POST, true);
            curl_setopt($smsCh, CURLOPT_HTTPHEADER, $smsHeaders);
            curl_setopt($smsCh, CURLOPT_POSTFIELDS, $smsBody);
            curl_setopt($smsCh, CURLOPT_RETURNTRANSFER, true);

            $smsResponse = curl_exec($smsCh);
            $smsError = curl_error($smsCh);
            curl_close($smsCh);

            if ($smsError) {
                echo json_encode(['success' => true, 'message' => 'Email sent, but SMS could not be delivered.']);
            } else {
                echo json_encode(['success' => true, 'message' => 'Reservation confirmed, email sent, and SMS delivered.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Reservation saved, but email could not be sent. Error: ' . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Reservation failed: ' . $result['message']]);
    }
}
?>
