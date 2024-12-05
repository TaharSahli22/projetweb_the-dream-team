<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/mnmt.php');
include(__DIR__ . '/../Model/dntn.php');

class mcontroller
{
    public function listmonument()
    {
        $sql = "SELECT * FROM monuments";
        $db = database::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletemonument($id)
    {
        $sql = "DELETE FROM monuments WHERE id = :id";
        $db = database::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addmonument($monument) {
        $sql = "INSERT INTO monuments (name, description, price, image) 
                VALUES (:name, :description, :price, :image)";
        $db = database::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $monument->getName(),
                'description' => $monument->getDescription(),
                'price' => $monument->getPrice(),
                'image' => $monument->getImage()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

    function updatemonument($monument, $id)
{
    try {
        $db = database::getConnexion();

        $query = $db->prepare(
            'UPDATE monuments SET 
                name = :name,
                description = :description,
                price = :price,
                image = :image
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'name' => $monument->getName(),
            'description' => $monument->getDescription(),
            'price' => $monument->getPrice(),
            'image' => $monument->getImage()
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


    function showmonument($id)
    {
        $sql = "SELECT * from monuments where id = $id";
        $db = database::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $monument = $query->fetch();
            return $monument;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

class dcontroller
{
    // Liste des dons
    public function listdonations()
    {
        $sql = "SELECT * FROM donations";
        $db = database::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Supprimer un don par son ID
    function deletedonation($id)
    {
        $sql = "DELETE FROM donations WHERE id = :id";
        $db = database::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Ajouter un nouveau don
    function adddonation($donation) {
        $sql = "INSERT INTO donations (name, address, phone, bank, account, iban, amount) 
                VALUES (:name, :address, :phone, :bank, :account, :iban, :amount)";
        $db = database::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $donation->getName(),
                'address' => $donation->getAddress(),
                'phone' => $donation->getPhone(),
                'bank' => $donation->getBank(),
                'account' => $donation->getAccount(),
                'iban' => $donation->getIban(),
                'amount' => $donation->getAmount()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Mettre à jour un don existant
    function updatedonation($donation, $id)
    {
        try {
            $db = database::getConnexion();

            $query = $db->prepare(
                'UPDATE donations SET 
                    name = :name,
                    address = :address,
                    phone = :phone,
                    bank = :bank,
                    account = :account,
                    iban = :iban,
                    amount = :amount
                WHERE id = :id'
            );

            $query->execute([
                'id' => $id,
                'name' => $donation->getName(),
                'address' => $donation->getAddress(),
                'phone' => $donation->getPhone(),
                'bank' => $donation->getBank(),
                'account' => $donation->getAccount(),
                'iban' => $donation->getIban(),
                'amount' => $donation->getAmount()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }

    // Afficher un don par son ID
    function showdonation($id)
    {
        $sql = "SELECT * FROM donations WHERE id = :id";
        $db = database::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();

            $donation = $query->fetch();
            return $donation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

?>
