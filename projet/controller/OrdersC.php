<?php
require_once('../../config.php');
require_once('../../Model/Orders.php');
require_once('../../Model/Produits.php');

class OrdersC
{
    // Insert order into the database and update product quantity
    public function insertOrder($order)
    {
        $sql = "INSERT INTO orders (fullName, Email, phoneNumber, Clocation, Productname, Productprice, Quantity, TotalPrice, DatePurchase, ProdId) 
                VALUES (:fullName, :Email, :phoneNumber, :Clocation, :Productname, :Productprice, :Quantity, :TotalPrice, :DatePurchase, :ProdId)";
        $db = Config::getConnexion();
        
        try {
            // Start a transaction
            $db->beginTransaction();

            // Insert the order into the orders table
            $query = $db->prepare($sql);
            $query->execute([
                'fullName' => $order->getfullName(),
                'Email' => $order->getEmail(),
                'phoneNumber' => $order->getphoneNumber(),
                'Clocation' => $order->getClocation(),
                'Productname' => $order->getProductname(),
                'Productprice' => $order->getProductprice(),
                'Quantity' => $order->getQuantity(),
                'TotalPrice' => $order->getTotalPrice(),
                'DatePurchase' => $order->getDatePurchase(),
                'ProdId' => $order->getProdId(),
            ]);

            // Get the product ID and quantity ordered
            $prodId = $order->getProdId();
            $quantityOrdered = $order->getQuantity();

            // Now decrease the product quantity in the produitslist table
            $productController = new ProduitsC();
            $productController->decreaseProductQuantity($prodId, $quantityOrdered);

            // Commit the transaction
            $db->commit();
            return ['success' => true];
        } catch (Exception $e) {
            // Rollback if any error occurs
            $db->rollBack();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getAllOrders() {
        $sql = "SELECT * FROM orders";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();  // Fetch all orders and return them
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];  // Return an empty array in case of an error
        }
    }
}
?>
