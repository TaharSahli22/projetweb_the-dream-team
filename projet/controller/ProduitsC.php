<?php
require_once('../../config.php');
require_once('../../Model/Produits.php');

class ProduitsC
{
    // Method to add a new product
    function addProduct($produit)
    {
        $sql = "INSERT INTO produitslist (nomproduit, origin, prixproduit, nbrdisponible, imageproduit) 
                VALUES (:nomproduit, :origin, :prixproduit, :nbrdisponible, :imageproduit)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nomproduit' => $produit->getNomproduit(),
                'origin' => $produit->getOrigin(),
                'prixproduit' => $produit->getPrixproduit(),
                'nbrdisponible' => $produit->getNbrdisponible(),
                'imageproduit' => $produit->getImageproduit(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Method to get all products
    public function getAllProducts() {
        $sql = "SELECT * FROM produitslist";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();  // Fetch all products and return them
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];  // Return an empty array in case of an error
        }
    }

    // Method to decrease product quantity after an order is placed
    public function decreaseProductQuantity($prodId, $quantityOrdered)
    {
        // Get the current quantity of the product
        $sql = "SELECT nbrdisponible FROM produitslist WHERE Idproduit = :prodId";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['prodId' => $prodId]);
            $product = $query->fetch();

            // If product exists, update the quantity
            if ($product) {
                $newQuantity = $product['nbrdisponible'] - $quantityOrdered;
                if ($newQuantity >= 0) {
                    // Update the product quantity in the database
                    $updateSql = "UPDATE produitslist SET nbrdisponible = :newQuantity WHERE Idproduit = :prodId";
                    $updateQuery = $db->prepare($updateSql);
                    $updateQuery->execute([
                        'newQuantity' => $newQuantity,
                        'prodId' => $prodId,
                    ]);
                } else {
                    throw new Exception("Not enough stock available.");
                }
            } else {
                throw new Exception("Product not found.");
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>
