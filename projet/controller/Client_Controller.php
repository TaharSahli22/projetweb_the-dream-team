<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/client.php');

class Client_Controller
{
    public function clientList()
    {
        $sql = "SELECT * FROM client";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteOffer($id)
    {
        $sql = "DELETE FROM client WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addOffer($offer)
    {   var_dump($offer);
        $sql = "INSERT INTO client  
        VALUES (NULL, :nom,:pre, :email,:psw, :cpsw)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $offer->getName(),
                'pre' => $offer->getLast_name(),
                'email' => $offer->getemail(), 
                'psw' => $offer->getpassword(),
                'cpsw' => $offer->getcpassword(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateOffer($offer, $id)
{
    var_dump($offer);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE traveloffer SET 
                nom = :nom,
                pre = :pre,
                email = :email,
                psw = :psw,
                cpsw = :cpsw,
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'nom' => $nvclient->getName(),
            'pre' => $nvclient->getLast_name(),
            'email' => $nvclient->getemail(), 
            'psw' => $nvclient->getpassword(),
            'cpsw' => $nvclient->getcpassword(),
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


    function showOffer($id)
    {
        $sql = "SELECT * from client where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $offer = $query->fetch();
            return $offer;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
