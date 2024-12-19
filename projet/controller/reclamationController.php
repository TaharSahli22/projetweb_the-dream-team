<?php
// Inclusion des fichiers nécessaires
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/reclamation.php');
include(__DIR__ . '/../model/reponse.php');

class ReclamationController
{
    // Liste de toutes les réclamations
    public function listReclamation()
    {
        $sql = "SELECT * FROM reclamation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

  
    function deleteReclamation($id)
    {
        $sql = "DELETE FROM reclamation WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addReclamation($reclamation)
    {
        $sql = "INSERT INTO reclamation  
                VALUES (NULL,:nom, :prenom, :telephone, :email, :dates, :messages , :voice_file_path)";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $reclamation->getNom(),
                'prenom' => $reclamation->getPrenom(),
                'telephone' => $reclamation->getTelephone(),
                'email' => $reclamation->getEmail(),
                'dates' => $reclamation->getDate()->format('Y-m-d'), 
                'messages' => $reclamation->getMessages(),
                'voice_file_path' => $reclamation->getvoice_file_path()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    // Mettre à jour une réclamation existante
    function updateReclamation($reclamation, $id)
    {
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE reclamation SET 
                    nom = :nom,
                    prenom = :prenom,
                    telephone = :telephone,
                    email = :email,
                    dates = :dates,
                    messages = :messages
                WHERE id = :id'
            );

            $query->execute([
                'id' => $id,
                'nom' => $reclamation->getNom(),
                'prenom' => $reclamation->getPrenom(),
                'telephone' => $reclamation->getTelephone(),
                'email' => $reclamation->getEmail(),
                'dates' => $reclamation->getDate()->format('Y-m-d'),
                'messages' => $reclamation->getMessages()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }

    // Afficher une réclamation par ID
    function showReclamation($id)
    {
        $sql = "SELECT * from reclamation where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $reclamation = $query->fetch();
            return $reclamation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    
 
     public function afficheReclamations(){
         try{
             $pdo = config::getConnexion();
             $query=$pdo->prepare("SELECT * FROM reclamation");
             $query->execute();
             return $query -> fetchAll();
         } catch(PDOException $e){
             echo $e->getMessage();
         }
    }
}
    class ReponseController
{ 

    // Liste de toutes les réponses
    public function listReponse()
    {
        $sql = "SELECT * FROM reponse";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

  
    function deleteReponse($id)
    {
        $sql = "DELETE FROM reponse WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addReponse($reponse)
    {
        $sql = "INSERT INTO reponse  
                VALUES (NULL,:date_reponse, :reponse, :id_reclamations, NULL)";
        
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'date_reponse' => $reponse->getDate()->format('Y-m-d'),
                'reponse' => $reponse->getReponse(),
                'id_reclamations' => $reponse->getId_reclamations(),
                
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    
    public function updateReponse($id, $reponse) {
        $sql = "UPDATE reponse SET reponse = :reponse WHERE id = :id";
        $db = config::getConnexion();
        $stmt =$db->prepare($sql);
        $stmt->bindParam(':reponse', $reponse);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    
    function showReponse($id_reclamations)
    {
        $sql = "SELECT * from reponse where id_reclamations = :id_reclamations"; // Use placeholder
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_reclamations' => $id_reclamations]); // Bind correctly
            $reponse = $query->fetchAll(PDO::FETCH_ASSOC);
            return $reponse;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function enregistrerEvaluation($id, $rating) {
        // Connexion à la base de données via la méthode getConnexion()
        $db = config::getConnexion();
        
        try {
            // Préparer la requête SQL pour enregistrer l'évaluation de la réponse
            $sql = "UPDATE reponse SET evaluation = :rating WHERE id = :id";
    
            // Préparer la requête avec la connexion à la base de données
            $query = $db->prepare($sql);
    
            // Exécuter la requête en passant les valeurs :rating et :reponse
            $query->execute([
                'rating' => $rating,
                'id' => $id
            ]);
    
            // Retourner un message ou un succès, selon vos besoins
            return $query->rowCount() > 0; // Vérifie si la mise à jour a bien eu lieu
        } catch (PDOException $e) {
            // Gérer les erreurs de requête ou de connexion
            echo "Erreur: " . $e->getMessage();
            return false; // Retourner false si une erreur se produit
        }
    }
}
?>