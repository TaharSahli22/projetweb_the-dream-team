<?php
// GetReservationData.php

require_once('../../config.php');

if (isset($_GET['OrderId'])) {
    $cin = $_GET['OrderId']; // Get the CIN value from the query string

    // Prepare and execute the query to fetch the reservation details
    $db = config::getConnexion();
    $sql = "SELECT * FROM orders WHERE OrderId = :OrderId";
    $query = $db->prepare($sql);

    try {
        $query->execute(['OrderId' => $OrderId]);
        $order = $query->fetch();

        // Return the reservation data as JSON
        if ($order) {
            echo json_encode(['success' => true, 'order' => $order]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Order not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
