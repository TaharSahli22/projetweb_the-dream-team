<?php
include '../../controller/blogController.php';

$comController = new comController();

if (isset($_POST['id'], $_POST['cmt'])) {
    $id = $_POST['id'];
    $cmt = $_POST['cmt'];

    // Update the comment in the database
    $result = $comController->updateComment($id, $cmt);

    if ($result) {
        header('Location: blogtem.php'); // Redirect back to the blog page
        exit();
    } else {
        echo "Failed to update comment.";
    }
} else {
    echo "Invalid request.";
}
?>
