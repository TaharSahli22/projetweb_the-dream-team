<?php
// getProductData.php

require_once('../../config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the query to fetch the product details
    $db = config::getConnexion();
    $sql = "SELECT * FROM produitslist WHERE Idproduit = :id";  // Changed from 'evenements' to 'produits'
    $query = $db->prepare($sql);

    try {
        $query->execute(['id' => $id]);
        $product = $query->fetch();  // Changed $event to $product

        // Return the product data as JSON
        if ($product) {
            echo json_encode(['success' => true, 'product' => $product]);  // Changed from 'event' to 'product'
        } else {
            echo json_encode(['success' => false, 'error' => 'Product not found']);  // Changed error message
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
