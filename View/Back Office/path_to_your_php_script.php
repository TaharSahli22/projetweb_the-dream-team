<?php
// path_to_your_php_script.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $nomproduit = $_POST['nomproduit'];
    $origin = $_POST['origin'];
    $prixproduit = $_POST['prixproduit'];
    $nbrdisponible = $_POST['nbrdisponible'];

    // Include your classes (ProduitsC, Produits)
    require_once('../../config.php');
    require_once('../../Model/Produits.php');
    require_once('../../Controller/ProduitsC.php');

    // Handle image upload
    $imageproduit = null; // Default to null in case no image is uploaded
    if (isset($_FILES['imageproduit']) && $_FILES['imageproduit']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../../uploads/"; // Directory to save images (adjust path as needed)
        $imageproduit = uniqid() . "_" . basename($_FILES['imageproduit']['name']); // Unique file name
        $targetFilePath = $targetDir . $imageproduit;

        // Create the directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Move the uploaded file
        if (!move_uploaded_file($_FILES['imageproduit']['tmp_name'], $targetFilePath)) {
            echo json_encode(['success' => false, 'message' => 'Error uploading image.']);
            exit; // Stop further processing
        }
    }

    // Create an instance of Produits and ProduitsC to save the data
    $produit = new Produits(null, $nomproduit, $origin, $prixproduit, $nbrdisponible, $imageproduit);
    $controller = new ProduitsC();
    
    try {
        // Add the product
        $controller->addProduct($produit);
        
        // Send a success response
        echo json_encode(['success' => true, 'message' => 'Product added successfully.']);
    } catch (Exception $e) {
        // If there's an error during insertion, catch it and return it as JSON
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>
