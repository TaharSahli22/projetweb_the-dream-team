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
}
