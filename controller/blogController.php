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
        VALUES (NULL, :title,:subjects,:dates ,:adminuser,:likes,:eventimage)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $story->getTitle(),
                'subjects' => $story->getsubjects(),
                'dates' => $story->getdates()->format('Y-m-d'), 
                'adminuser' => $story->getadminuser(),
                'likes' => $story->getlikes(),
                'eventimage'=> $story->geteventimage()
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
                likes = :likes,
                eventimage= :eventimage
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'title' => $story->getTitle(),
            'subjects' => $story->getsubjects(),
            'dates' => $story->getdates()->format('Y-m-d'), 
            'adminuser' => $story->getadminuser(),
            'likes' => $story->getlikes(),
            'eventimage'=> $story->geteventimage()
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



    public function liststorys($search_title = null)
{
    $query = "SELECT * FROM storys";
    $db = config::getConnexion();
    
    if ($search_title) {
        // If search term exists, filter by title
        $query .= " WHERE title LIKE :search_title";
    }

    $stmt =  $db->prepare($query);

    if ($search_title) {
        // Bind the search term with '%' wildcard for partial matching
        $stmt->bindValue(':search_title', '%' . $search_title . '%');
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




}











class comController
{
    public function listcomment()
    {
        $sql = "SELECT * FROM commentz";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletecomment($id)
    {
        $sql = "DELETE FROM commentz WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addcomment($comment)
    {
        // Debugging: Output the comment object
        var_dump($comment);
    
        // Retrieve values from the comment object
        $stryid = $comment->getstryid();
        $user = $comment->getuser();
        $message_text = $comment->getmessage_text();
        $voice_file_path = $comment->getvoice_file_path();
        $gif_file_path = $comment->getgif_file_path();
        $message_type = $comment->getmessage_type();
        $likes = $comment->getlikes();
    
        // Ensure all required fields are not NULL (optional, depending on your requirements)
        if ($stryid === null || $user === null || $message_text === null || $message_type === null) {
            echo "Some required fields are missing.";
            return;
        }
    
        // Handle case for text, voice, or gif message type
        if ($message_type !== 'text' && $message_type !== 'voice' && $message_type !== 'gif') {
            echo "Invalid message type.";
            return;
        }
    
        // Debugging: Log values for troubleshooting
        error_log("stryid: $stryid, user: $user, message_text: $message_text, message_type: $message_type, likes: $likes");
    
        // SQL query with column names explicitly listed
        $sql = "INSERT INTO commentz 
                (stryid, user, message_text, voice_file_path, gif_file_path, message_type, dates, likes) 
                VALUES (:stryid, :user, :message_text, :voice_file_path, :gif_file_path, :message_type, NOW(), :likes)";
        
        // Database connection
        $db = config::getConnexion();
        try {
            // Prepare the query
            $query = $db->prepare($sql);
    
            // Execute the query with the provided data
            $query->execute([
                'stryid' => $stryid,
                'user' => $user,
                'message_text' => $message_text,
                'voice_file_path' => $voice_file_path, // May be NULL
                'gif_file_path' => $gif_file_path,     // May be NULL
                'message_type' => $message_type,
                'likes' => $likes
            ]);
    
            // Debugging: Confirm successful execution
            echo 'Comment successfully added.';
        } catch (Exception $e) {
            // Log the error for debugging purposes
            error_log("Error: " . $e->getMessage());
    
            // Display user-friendly error message
            echo 'An error occurred while adding the comment. Please check the logs for more details.';
        }
    }
    
    

    public function updateComment($id, $message_tex) {
        try {
            $sql = "UPDATE commentz SET message_text = :message_text WHERE id = :id";
            $db = config::getConnexion();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':message_text', $message_text, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error updating comment: " . $e->getMessage();
            return false;
        }
    }

    function showcomment($id)
    {
        $sql = "SELECT * from commentz where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $comment = $query->fetch();
            return $comment;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function showcommentlist($stryid)
    {
        $sql = "SELECT * from commentz where stryid = :stryid";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['stryid' => $stryid]);
    
            // Fetch all comments with the specified stryid
            $comments = $query->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getCommentById($id) {
        // Fetch comment by ID
        $query = "SELECT * FROM commentz WHERE id = :id";
        $db = config::getConnexion();
        $stmt =$db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateLikes($id, $newLikes) {
        // Update the likes count
        $query = "UPDATE commentz SET likes = :likes WHERE id = :id";
        $db = config::getConnexion();
        $stmt =$db->prepare($query);
        $stmt->bindValue(':likes', $newLikes, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function reportComment($commentId, $user, $reason) {
        $db = config::getConnexion();
        $query = $db->prepare("INSERT INTO reported_comments (comment_id, reported_by, report_reason, report_date) VALUES (?, ?, ?, NOW())");
        return $query->execute([$commentId, $user, $reason]);
    }
    

    public function reportlist()
    {
        $sql = "SELECT * FROM reported_comments";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

}