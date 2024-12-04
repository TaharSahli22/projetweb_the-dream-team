<?php
// deleteReservation.php

require_once('../../config.php');

// Check if the CIN is provided
if (isset($_GET['OrderId'])) {
    $OrderId = $_GET['OrderId'];

    // Prepare the DELETE query
    $db = config::getConnexion();
    $sql = "DELETE FROM orders WHERE OrderId = :OrderId";
    $query = $db->prepare($sql);

    // Execute the query
    try {
        $query->execute(['OrderId' => $OrderId]);

        // If the query executes successfully, return a success message
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'OrderId not provided']);
}
?>
