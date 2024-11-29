<?php
// updateProduit.php

require_once('../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $id = $_POST['editProductId'];
    $nomproduit = $_POST['editProductName'];
    $origin = $_POST['editProductOrigin'];
    $prixproduit = $_POST['editProductPrice'];
    $nbrdisponible = $_POST['editProductQuantity'];

    // Prepare the UPDATE query
    $db = config::getConnexion();
    $sql = "UPDATE produitslist SET nomproduit = :nomproduit, origin = :origin, prixproduit = :prixproduit, nbrdisponible = :nbrdisponible WHERE Idproduit = :id";
    $query = $db->prepare($sql);

    try {
        $query->execute([
            'id' => $id,
            'nomproduit' => $nomproduit,
            'origin' => $origin,
            'prixproduit' => $prixproduit,
            'nbrdisponible' => $nbrdisponible
        ]);

        // Return a success message
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
