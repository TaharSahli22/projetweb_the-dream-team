<?php
include '../../controller/blogController.php';
$comController = new comController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $commentId = intval($_POST['id']);
    
    // Fetch the current comment to get its likes
    $comment = $comController->getCommentById($commentId);

    if ($comment) {
        $newLikes = $comment['likes'] + 1;

        // Update the likes in the database
        $updated = $comController->updateLikes($commentId, $newLikes);

        if ($updated) {
            echo json_encode(['success' => true, 'newLikes' => $newLikes]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Comment not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
