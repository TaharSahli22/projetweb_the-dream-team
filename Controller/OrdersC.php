<?php
require_once('../../config.php');
require_once('../../Model/Orders.php');

class OrdersC
{
    // Insert reservation into the database
    public function insertOrder($order)
    {
        $sql = "INSERT INTO orders (fullName, Email, phoneNumber, Clocation,  Productname,Productprice,Quantity,TotalPrice,DatePurchase, ProdId) 
                VALUES (:fullName, :Email, :phoneNumber, :Clocation, :Productname, :Productprice, :Quantity, :TotalPrice, :DatePurchase, :ProdId)";
        $db = Config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'fullName' => $order->getfullName(),
                'Email' => $order->getEmail(),
                'phoneNumber' => $order->getphoneNumber(),
                'Clocation' => $order->getClocation(),
                'Productname' => $order->getProductname(),
                'Productprice' => $order->getProductprice(),
                'Quantity' =>$order->getQuantity(),
                'TotalPrice' =>$order->getTotalPrice(),
                'DatePurchase' =>$order->getDatePurchase(),
                'ProdId'=>$order->getProdId(),
            ]);
            return ['success' => true];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    public function getAllOrders() {
        $sql = "SELECT * FROM orders";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();  // Fetch all reservations and return them
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];  // Return an empty array in case of an error
        }
    }
}


?>
