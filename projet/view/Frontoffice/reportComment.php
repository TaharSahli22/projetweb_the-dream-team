<?php
include '../../controller/blogController.php';
$comController = new comController();

if (isset($_POST['comment_id']) && isset($_POST['user'])) {
    $commentId = $_POST['comment_id'];
    $user = $_POST['user'];
    $reason = isset($_POST['reason']) ? $_POST['reason'] : 'No reason provided';

    // Save the report to the database
    $success = $comController->reportComment($commentId, $user, $reason);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Comment reported successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to report the comment.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
}
?>
