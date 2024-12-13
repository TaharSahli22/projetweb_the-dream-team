
<?php
include '../../controller/blogController.php';
$blogController = new blogController();
$comController = new comController();
$stryid =$_POST['id'] ;
$likes=1;
$comments = $comController->showcommentlist($stryid);

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>TERRA DI CULTURA</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">



        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">

        <style>
        #recordBtn, #stopBtn {
            padding: 10px;
            font-size: 16px;
        }

        #audioPlayer {
            margin-top: 20px;
            width: 100%;
        }
    </style>
        <style>
        /* Basic styling for the pop-up */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .popup-content input {
            width: 80%;
            padding: 8px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .popup-content button {
            margin-top: 15px;
            padding: 8px 16px;
            background: #DACAA4;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .popup-content button:hover {
            background: #DACAA4;
        }
    </style>





<style>

        .comment-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            width: 500px;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .comment-header .username {
            font-weight: bold;
        }

        .comment-header .time {
            font-size: 12px;
            color: #888;
        }

        .comment-text {
            font-size: 14px;
            margin-bottom: 15px;
            color: #333;
        }

        .comment-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comment-footer .likes {
            display: flex;
            align-items: center;
        }

        .comment-footer .likes i {
            margin-right: 5px;
        }

        .comment-footer .reply {
            cursor: pointer;
            color: #007bff;
        }

        .comment-footer .reply:hover {
            text-decoration: underline;
        }

        .like-button {
            color: #DACAA4;
            cursor: pointer;
        }

        .like-button.liked {
            color: #ff6b6b;
        }

        /* Styling for the reply box */
        .reply-box {
            margin-left: 20px;
            margin-top: 10px;
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 8px;
        }

    </style>
<style>

/* From Uiverse.io by ahmed150up2 */ 
.Btn {
  width: 140px;
  height: 35px;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  border: none;
  border-radius: 5px;
  overflow: hidden;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.089);
  cursor: pointer;
  background-color: transparent;
}

.leftContainer {
  width: 60%;
  height: 100%;
  background-color: #dacaa4;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.leftContainer .like {
  color: white;
  font-weight: 600;
}

.likeCount {
  width: 40%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #dacaa4;
  font-weight: 600;
  position: relative;
  background-color: white;
}

.likeCount::before {
  height: 8px;
  width: 8px;
  position: absolute;
  content: "";
  background-color: rgb(255, 255, 255);
  transform: rotate(45deg);
  left: -4px;
}

.Btn:hover .leftContainer {
  background-color: #1d4292;
}

.Btn:active .leftContainer {
  background-color: #072b7a;
}

.Btn:active .leftContainer svg {
  transform: scale(1.15);
  transform-origin: top;
}

    
</style>
<style>
    /* From Uiverse.io by vinodjangid07 */ 
.button {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: rgb(20, 20, 20);
  border: none;
  font-weight: 600;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
  cursor: pointer;
  transition-duration: 0.3s;
  overflow: hidden;
  position: relative;
  gap: 2px;
}

.svgIcon {
  width: 12px;
  transition-duration: 0.3s;
}

.svgIcon path {
  fill: white;
}

.button:hover {
  transition-duration: 0.3s;
  background-color: rgb(255, 69, 69);
  align-items: center;
  gap: 0;
}

.bin-top {
  transform-origin: bottom right;
}
.button:hover .bin-top {
  transition-duration: 0.5s;
  transform: rotate(160deg);
}

</style>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid topbar bg-light px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <a href="#" class="text-muted small me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                        <a href="tel:+01234567890" class="text-muted small me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a>
                        <a href="mailto:example@gmail.com" class="text-muted small me-0"><i class="fas fa-envelope text-primary me-2"></i>Example@gmail.com</a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a href="#"><small class="me-3 text-dark"><i class="fa fa-user text-primary me-2"></i>Register</small></a>
                        <a href="#"><small class="me-3 text-dark"><i class="fa fa-sign-in-alt text-primary me-2"></i>Login</small></a>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown"><small><i class="fa fa-home text-primary me-2"></i> My Dashboard</small></a>
                            <div class="dropdown-menu rounded">
                                <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Inbox</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i> Account Settings</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                    <img src="img/logo1.png" alt="Logo">
                </a>
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary">TERRA DI CULTURA</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="" class="nav-item nav-link">Home</a>
                        <a href="" class="nav-item nav-link">Events</a>
                        <a href="" class="nav-item nav-link">E-Shop</a>
                        <a href="" class="nav-item nav-link active">Blogs</a>
                        <a href="" class="nav-item nav-link ">Donation</a>
                        <a href="" class="nav-item nav-link">Contact Us</a>
                    </div>
                    <a href="#" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Get Started</a>
                </div>
            </nav>







            <?php
    $story = $blogController->showstory($stryid);
            
    $imagePath = !empty($story['eventimage']) ? '../../uploads/' . htmlspecialchars($story['eventimage']) : 'img/default-event.jpg';
    echo '<div class="blog-item p-4" >';
    echo '<div class="blog-img mb-4" >';
    echo '<img src="' . $imagePath . '" class="img-fluid w-100 rounded"  alt="' . htmlspecialchars($story['eventimage']) . '">';
    echo '</div>';
    echo '<a href="#" class="h4 d-inline-block mb-3">' . htmlspecialchars($story['title']) . '</a>';
    echo '<p class="mb-4">' . htmlspecialchars($story['subjects']) . '</p>';
    echo '<div class="d-flex align-items-center justify-content-between" >';
    echo '<div class="d-flex align-items-center">';
    echo '<img src="img/pfp.png" class="img-fluid rounded-circle" style="width: 60px; height: 60px;" alt="">';
    echo '<div class="ms-3">';
    echo '<h5>' . htmlspecialchars($story['adminuser']) . '</h5>';
    echo '<p class="mb-0">' . htmlspecialchars($story['dates']) . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  

?>
<br>









       

<div class="modal fade" id="reportCommentModal" tabindex="-1" aria-labelledby="reportCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportCommentModalLabel">Report Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="reportCommentForm" method="POST" action="reportComment.php">
                <div class="modal-body">
                    <input type="hidden" id="reportCommentId" name="comment_id">
                    <div class="mb-3">
                        <label for="reportUser" class="form-label">Your Username</label>
                        <input type="text" class="form-control" id="reportUser" name="user" required>
                    </div>
                    <div class="mb-3">
                        <label for="reportReason" class="form-label">Reason (Optional)</label>
                        <textarea class="form-control" id="reportReason" name="reason" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Submit Report</button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="bg-light p-5 rounded h-100 wow fadeInUp" data-wow-delay="0.2s">
                                <h4 class="text-primary">Comments</h4>
                                <br>
                                    <div class="row g-4">
                                    <?php
if (!empty($comments)) {
    echo "<ul>";
    foreach ($comments as $comment) {
        echo '<div class="comment-box">';
        echo '<div class="comment-header">';
        echo '<div class="username">' . htmlspecialchars($comment['user']) . "</div>";
        echo '<div class="time">' . htmlspecialchars($comment['dates']) . "</div>";
        echo '</div>';
        if (!empty($comment['message_text'])) {
            echo "<p>" . htmlspecialchars($comment['message_text']) . "</p>";
        }

        // Display the voice message (audio player)
        if (!empty($comment['voice_file_path']) && file_exists($comment['voice_file_path'])) {
            echo "<audio controls><source src='" . htmlspecialchars($comment['voice_file_path']) . "' type='audio/mpeg'></audio><br>";
        }

        // Display the GIF
        if (!empty($comment['gif_file_path']) && file_exists($comment['gif_file_path'])) {
            echo "<img src='" . htmlspecialchars($comment['gif_file_path']) . "' alt='GIF'><br>";
        } ?>
        <div class="comment-footer">



        <button class="Btn" onclick="likeComment(<?php echo $comment['id']; ?>)">
  <span class="leftContainer">
    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#fff"><path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z"></path></svg>
    <span class="like">Like</span>
  </span>
    <span class="likeCount" id="likes-<?php echo $comment['id']; ?>">
        <?php echo htmlspecialchars($comment['likes']); ?> 
    </span >
    </button>



    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCommentModal" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($comment)); ?>)">Edit</button>



<button class="button" onclick="window.location.href='deletecom.php?id=<?php echo $comment['id']; ?>'">

  <svg
    xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 69 14"
    class="svgIcon bin-top"
  >
    <g clip-path="url(#clip0_35_24)">
      <path
        fill="black"
        d="M20.8232 2.62734L19.9948 4.21304C19.8224 4.54309 19.4808 4.75 19.1085 4.75H4.92857C2.20246 4.75 0 6.87266 0 9.5C0 12.1273 2.20246 14.25 4.92857 14.25H64.0714C66.7975 14.25 69 12.1273 69 9.5C69 6.87266 66.7975 4.75 64.0714 4.75H49.8915C49.5192 4.75 49.1776 4.54309 49.0052 4.21305L48.1768 2.62734C47.3451 1.00938 45.6355 0 43.7719 0H25.2281C23.3645 0 21.6549 1.00938 20.8232 2.62734ZM64.0023 20.0648C64.0397 19.4882 63.5822 19 63.0044 19H5.99556C5.4178 19 4.96025 19.4882 4.99766 20.0648L8.19375 69.3203C8.44018 73.0758 11.6746 76 15.5712 76H53.4288C57.3254 76 60.5598 73.0758 60.8062 69.3203L64.0023 20.0648Z"
      ></path>
    </g>
    <defs>
      <clipPath id="clip0_35_24">
        <rect fill="white" height="14" width="69"></rect>
      </clipPath>
    </defs>
  </svg>

  <svg
    xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 69 57"
    class="svgIcon bin-bottom"
  >
    <g clip-path="url(#clip0_35_22)">
      <path
        fill="black"
        d="M20.8232 -16.3727L19.9948 -14.787C19.8224 -14.4569 19.4808 -14.25 19.1085 -14.25H4.92857C2.20246 -14.25 0 -12.1273 0 -9.5C0 -6.8727 2.20246 -4.75 4.92857 -4.75H64.0714C66.7975 -4.75 69 -6.8727 69 -9.5C69 -12.1273 66.7975 -14.25 64.0714 -14.25H49.8915C49.5192 -14.25 49.1776 -14.4569 49.0052 -14.787L48.1768 -16.3727C47.3451 -17.9906 45.6355 -19 43.7719 -19H25.2281C23.3645 -19 21.6549 -17.9906 20.8232 -16.3727ZM64.0023 1.0648C64.0397 0.4882 63.5822 0 63.0044 0H5.99556C5.4178 0 4.96025 0.4882 4.99766 1.0648L8.19375 50.3203C8.44018 54.0758 11.6746 57 15.5712 57H53.4288C57.3254 57 60.5598 54.0758 60.8062 50.3203L64.0023 1.0648Z"
      ></path>
    </g>
    <defs>
      <clipPath id="clip0_35_22">
        <rect fill="white" height="57" width="69"></rect>
      </clipPath>
    </defs>
  </svg>
</button>




</div>
<br>
<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reportCommentModal" onclick="setReportCommentId(<?php echo $comment['id']; ?>)">Report</button>



<?php 

        echo '</div>';
    }
    echo "</ul>";
} else {
    echo "No comments found for this story ID.";
}
?>


<form id="comform" action="send_message.php" method="POST" enctype="multipart/form-data">
    <input class="form-control form-control-user" type="hidden" id="stryid" name="stryid" value="<?php echo $stryid ?>" readonly>

    <!-- Username Field -->
    <div class="col-12">
        <div class="form-floating">
            <input type="text" class="form-control border-0" id="user" name="user" placeholder="username">
            <label for="user">Username</label>
        </div>
    </div>

    <br>

    <!-- Message Text Field -->
    <div class="col-12">
        <div class="form-floating">
            <textarea class="form-control border-0" placeholder="Write a comment..." id="message_text" name="message_text" style="height: 160px"></textarea>
            <label for="message_text">Comment</label>
            <span id="cmtError"></span>
        </div>
    </div>
    <input class="form-control form-control-user"  type="hidden" id="dates" name="dates" readonly >
                        <script>
                        // Get the current date and time
                        const currentDate = new Date();

                        // Format the date in YYYY-MM-DDTHH:MM format for datetime-local
                        const formattedDate = currentDate.toISOString().slice(0, 16);

                        // Set the value of the input field to the current date and time
                        document.getElementById('dates').value = formattedDate;
                    </script>

    <!-- Likes (hidden input) -->
    <input class="form-control form-control-user" type="hidden" id="likes" name="likes" step="1" value="<?php echo $likes ?>">

    <br>

    <!-- GIF Upload Field -->
    <label for="gif_message">GIF:</label>
    <input type="file" id="gif_message" name="gif_message" accept="image/gif"><br><br>

    <!-- Audio Recording Controls -->
    <button class="btn btn-primary" type="button" id="recordBtn" onclick="startRecording()">Start Recording</button>
    <button class="btn btn-primary" type="button" id="stopBtn" onclick="stopRecording()" disabled>Stop Recording</button>
    <audio id="audioPlayer" controls></audio>
    
    <input type="hidden" id="recordedVoice" name="recordedVoice">

    <!-- Submit Button -->
    <div class="col-12">
        <button type="submit" class="btn btn-primary w-100 py-3">Add Comment</button>
    </div>
</form>

<script>
    let mediaRecorder;
    let audioChunks = [];

    function startRecording() {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ audio: true })
                .then(stream => {
                    mediaRecorder = new MediaRecorder(stream);
                    audioChunks = []; // Clear previous recordings
                    
                    mediaRecorder.ondataavailable = event => {
                        audioChunks.push(event.data);
                    };

                    mediaRecorder.onstop = () => {
                        const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                        const audioUrl = URL.createObjectURL(audioBlob);
                        document.getElementById('audioPlayer').src = audioUrl;

                        // Convert the Blob to Base64 to include it in the form submission
                        const reader = new FileReader();
                        reader.onload = () => {
                            document.getElementById('recordedVoice').value = reader.result;
                        };
                        reader.readAsDataURL(audioBlob);
                    };

                    mediaRecorder.start();
                    document.getElementById('stopBtn').disabled = false;
                    document.getElementById('recordBtn').disabled = true;
                })
                .catch(err => {
                    console.error('Error accessing microphone: ', err);
                });
        } else {
            alert("Your browser doesn't support audio recording.");
        }
    }

    function stopRecording() {
        if (mediaRecorder) {
            mediaRecorder.stop();
            document.getElementById('stopBtn').disabled = true;
            document.getElementById('recordBtn').disabled = false;
        }
    }
</script>



<div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCommentForm" action="editcom.php" method="POST">
    <div class="modal-body">
        <input type="hidden" id="editCommentId" name="id">
        <div class="mb-3">
            <label for="editUser" class="form-label">User</label>
            <input type="text" class="form-control" id="editUser" name="user" readonly>
        </div>
        <div class="mb-3">
            <label for="editCmt" class="form-label">Comment</label>
            <textarea class="form-control" id="editCmt" name="cmt" rows="4"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>
</div>
</div>
<script>function openEditModal(comment) {
    // Populate the modal fields with the comment data
    document.getElementById("editCommentId").value = comment.id;
    document.getElementById("editUser").value = comment.user;
    document.getElementById("editCmt").value = comment.cmt;

    // Open the modal (optional if Bootstrap handles it automatically)
    const editModal = new bootstrap.Modal(document.getElementById("editCommentModal"));
    editModal.show();
}

function setReportCommentId(commentId) {
    document.getElementById('reportCommentId').value = commentId;
}

</script>
<script>
    function likeComment(commentId) {
        $.ajax({
            url: "likeComment.php", // The PHP script to handle the request
            method: "POST",
            data: { id: commentId },
            success: function (response) {
                // Parse the response
                let result = JSON.parse(response);

                if (result.success) {
                    // Update the likes count on the page
                    document.getElementById("likes-" + commentId).innerHTML =
                        `${result.newLikes} `;
                } else {
                    alert("Failed to like the comment. Please try again.");
                }
            },
            error: function () {
                alert("An error occurred. Please try again.");
            }
        });
    }
</script>
<script>
    // Array of banned words
    const bannedWords = ["fuck", "shit", "damn", "nigger"];

    function validateComment() {
        // Get the comment text
        const commentInput = document.getElementById("cmt");
        const commentText = commentInput.value.toLowerCase();

        // Check for banned words
        for (const word of bannedWords) {
            if (commentText.includes(word)) {
                // Show an error message and prevent submission
                alert("Your comment contains inappropriate language and cannot be submitted.");
                return false; // Prevent the form from being submitted
            }
        }

        return true; // Allow the form to be submitted if no banned words are found
    }

    // Attach the validation function to the form submission event
    const form = document.getElementById("comform");
    form.addEventListener("submit", function (event) {
        if (!validateComment()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
</script>
</div>
</div>
</div>




            <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="footer-item">
                            <a href="index.html" class="p-0">
                                <h4 class="text-white">TERRA</h4>
                                <!-- <img src="img/logo.png" alt="Logo"> -->
                            </a>
                            <p class="mb-4">Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem ipsum dolor sit amet, consectetur adipiscing...</p>
                            <div class="d-flex">
                                <a href="#" class="bg-primary d-flex rounded align-items-center py-2 px-3 me-2">
                                    <i class="fas fa-apple-alt text-white"></i>
                                    <div class="ms-3">
                                        <small class="text-white">Download on the</small>
                                        <h6 class="text-white">App Store</h6>
                                    </div>
                                </a>
                                <a href="#" class="bg-dark d-flex rounded align-items-center py-2 px-3 ms-2">
                                    <i class="fas fa-play text-primary"></i>
                                    <div class="ms-3">
                                        <small class="text-white">Get it on</small>
                                        <h6 class="text-white">Google Play</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-2">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Quick Links</h4>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> About Us</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Feature</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Attractions</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Tickets</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Blog</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Contact us</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Support</h4>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Disclaimer</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Support</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> FAQ</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Help</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <h4 class="text-white mb-4">Contact Info</h4>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                <p class="text-white mb-0">123 Street New York.USA</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope text-primary me-3"></i>
                                <p class="text-white mb-0">info@example.com</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa fa-phone-alt text-primary me-3"></i>
                                <p class="text-white mb-0">(+012) 3456 7890</p>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <i class="fab fa-firefox-browser text-primary me-3"></i>
                                <p class="text-white mb-0">Yoursite@ex.com</p>
                            </div>
                            <div class="d-flex">
                                <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f text-white"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-twitter text-white"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-instagram text-white"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="#"><i class="fab fa-linkedin-in text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0">
                        <span class="text-body"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end text-body">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom text-white" href="https://themewagon.com">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

</html>