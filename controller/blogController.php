<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/blogs.php');

class blogController
{
    public function liststory()
    {
        $sql = "SELECT * FROM storys";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletestory($id)
    {
        $sql = "DELETE FROM storys WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addstory($story)
    {   var_dump($story);
        $sql = "INSERT INTO storys  
        VALUES (NULL, :title,:subjects,:dates ,:adminuser,:likes)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $story->getTitle(),
                'subjects' => $story->getsubjects(),
                'dates' => $story->getdates()->format('Y-m-d'), 
                'adminuser' => $story->getadminuser(),
                'likes' => $story->getlikes()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updatestory($story, $id)
{
    var_dump($story);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE storys SET 
                title = :title,
                subjects = :subjects,
                dates = :dates,
                adminuser = :adminuser,
                likes = :likes
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'title' => $story->getTitle(),
            'subjects' => $story->getsubjects(),
            'dates' => $story->getdates()->format('Y-m-d'), 
            'adminuser' => $story->getadminuser(),
            'likes' => $story->getlikes()
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


    function showstory($id)
    {
        $sql = "SELECT * from storys where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $story = $query->fetch();
            return $story;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
