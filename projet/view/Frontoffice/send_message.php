<?php
// Assuming you have a Comment class with getters and setters
// Include necessary files (assuming `config` and `Comment` classes exist)
include '../../controller/blogController.php'; // The Comment class file


// Ensure POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $user = $_POST['user'];
    $message_text =$_POST['message_text'];
    $stryid = $_POST['stryid']; // Assuming this value is passed

    // Initialize file paths
    $voice_file_path = null;
    $gif_file_path = null;
    $message_type = 'text';  // Default message type is 'text'
    $likes = 0;  // Assuming likes start at 0

    // Handle uploaded voice message (voice file from input)
    if (isset($_FILES['voice_message']) && $_FILES['voice_message']['error'] === 0) {
        $voice_file_name = time() . '_' . basename($_FILES['voice_message']['name']);
        $voice_file_path = 'uploads/voice/' . $voice_file_name;

        if (!is_dir('uploads/voice')) {
            mkdir('uploads/voice', 0777, true);
        }

        if (move_uploaded_file($_FILES['voice_message']['tmp_name'], $voice_file_path)) {
            $message_type = 'voice';
        }
    }

    // Handle uploaded GIF
    if (isset($_FILES['gif_message']) && $_FILES['gif_message']['error'] === 0) {
        $gif_file_name = time() . '_' . basename($_FILES['gif_message']['name']);
        $gif_file_path = 'uploads/gifs/' . $gif_file_name;

        if (!is_dir('uploads/gifs')) {
            mkdir('uploads/gifs', 0777, true);
        }

        if (move_uploaded_file($_FILES['gif_message']['tmp_name'], $gif_file_path)) {
            $message_type = 'gif';
        }
    }

    // Handle recorded voice message (base64-encoded audio)
    if (!empty($_POST['recordedVoice'])) {
        $audio_data = $_POST['recordedVoice'];
        $audio_data = explode(',', $audio_data);
        $decoded_audio = base64_decode($audio_data[1]);

        $voice_file_path = '../../uploads/voice/' . uniqid() . '.wav';
        if (!is_dir('uploads/voice')) {
            mkdir('uploads/voice', 0777, true);
        }

        file_put_contents($voice_file_path, $decoded_audio);
        $message_type = 'voice';
    }

    // Create a Comment object and set its properties
    $comment = new Comments(
    NULL,
    $_POST['stryid'],
    $user,
    $message_text,
    $voice_file_path,
    $gif_file_path,
    $message_type,
    NULL,
    $likes);

    // Call the addcomment() function to insert the comment into the database
    $commentController = new comController();
    $commentController->addcomment($comment);
    ?>
    <form method="POST" action="commentpage.php">
    <input type="hidden" value=<?PHP echo $_POST['stryid']; ?> name="id">
</form>

<?php
    header('Location:commentpage.php?id='.$_POST["stryid"]);
}
?>
