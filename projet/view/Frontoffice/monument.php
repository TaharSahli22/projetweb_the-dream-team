<?php
include '../../controller/mcontroller.php';
$mcontroller = new mController();
$monuments = $mcontroller->listmonument();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>TERRA</title>
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
        <link href="css/like.css" rel="stylesheet">

        <style>
        /* General styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* Style for the notification button */
#notificationButton {
    padding: 10px;
    cursor: pointer;
    background-color: #007BFF;
    color: white;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
}

/* Style for the dropdown menu (Initially hidden) */
#notificationList {
    display: none; /* Initially hidden */
    position: absolute;
    top: 40px;  /* Adjust this to position the dropdown below the button */
    left: 0;
    width: 250px;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    padding: 10px;
    max-height: 300px;
    overflow-y: auto;
}

/* Show the dropdown when hovering over the notification button */
#notificationButton:hover + #notificationList {
    display: block;
}

/* Optional: Style for the notification items */
.notification-item {
    padding: 8px;
    margin: 5px 0;
    background-color: #f9f9f9;
    border-radius: 4px;
    cursor: pointer;
}

.notification-item:hover {
    background-color: #f1f1f1;
}

    </style>
    </head>
    <body>   
    
    <audio id="welcome-audio" src="./assets/wlcm.mp3" preload ='auto'></audio>
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
                    <div id="liveClock" style="font-size: 20px;"></div>
                        <script>
                            function updateClock() {
                                const now = new Date();
                                const time = now.toLocaleTimeString();
                                document.getElementById('liveClock').textContent = time;
                            }
                            setInterval(updateClock, 1000);
                            updateClock(); // Initialize
                        </script>
                    <a href="https://www.youtube.com/watch?v=Fn8PDG8RTZs" class="text-muted small me-4">
    <i class="fas fa-video text-primary me-2"></i>About Monuments
</a>
                        <a href="mailto:terradicultura@gmail.com" class="text-muted small me-0"><i class="fas fa-envelope text-primary me-2"></i>Reach Us</a>
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
                                <a href="notiflist.php" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>

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
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
    <a href="index.php" class="nav-item nav-link">Home</a>
    <a href="event.php" class="nav-item nav-link">Events</a>
    <a href="eshop.php" class="nav-item nav-link">E-Shop</a>
    <a href="blogtem.php" class="nav-item nav-link">Blogs</a>
    
    <!-- Donations Dropdown -->
    <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Donations</a>
        <div class="dropdown-menu rounded-0 border-0 m-0">
            <a href="donation.php" class="dropdown-item">Make a Donation</a>
            <a class="dropdown-item">Donation History</a>
            <a class="dropdown-item">Impact Stories</a>
            <a class="dropdown-item">Volunteer with Us</a>
        </div>
    </div>

    <a href="reclamationfront.php" class="nav-item nav-link">Contact Us</a>
</div>

                </div>
            </nav>

            <!-- Header Start -->
            <div class="container-fluid bg-breadcrumb">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Monuments List</h4>   
                </div>
            </div>
            <!-- Header End -->
        </div>
        <!-- Navbar & Hero End -->

        <div class="container-fluid blog py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">The Monuments That Needs Donations</h4>
                </div>
            <div class="owl-carousel blog-carousel wow fadeInUp" data-wow-delay="0.2s">
            <?php
            if ($monuments) {
                foreach ($monuments as $monument) {
                    echo '<div class="blog-item p-4">';
                    echo '<div class="blog-img mb-4">';?>
                    <img src="<?php echo $monument['image']?> " class="img-fluid w-100 rounded" alt="">
                    <?php
                    echo '</div>';
                    echo '<a href="#" class="h4 d-inline-block mb-3">' .htmlspecialchars($monument['name']) . '</a>';
                    echo '<p class="mb-4">' . htmlspecialchars($monument['description']) . '</p>';
                    echo '<div class="d-flex align-items-center justify-content-between">';
                    echo '<div class="d-flex align-items-center">';
                    echo '<div class="ms-3">';
                    echo '<h5>' . htmlspecialchars($monument['price']) . '$</h5>';
                    echo '</div>';
                    echo '</div>';
                    echo '<button class="donate-button" type="submit">
        <a href="donation.php" class="donate-button">
        <div class="donate-wrapper">
            <div class="ripple"></div>
            <span>Submit Donation</span>
            <div class="particles" style="--total-particles: 6">
                <div class="particle" style="--i: 1; --color: #FFD700"></div>
                <div class="particle" style="--i: 2; --color: #FFA500"></div>
                <div class="particle" style="--i: 3; --color: #FF6347"></div>
                <div class="particle" style="--i: 4; --color: #32CD32"></div>
                <div class="particle" style="--i: 5; --color: #4682B4"></div>
                <div class="particle" style="--i: 6; --color: #BA55D3"></div>
            </div>
        </div>
    </button>';

                    echo '</div>';
                    echo '</div>';
                }
            } else {
                // Message for no monuments
                echo '<h1>no monument yet.</h1>';
            }
            ?>
        </div>
        </div>
    </div> 

<!-- IA Assistant Icon -->
 <!--<a href="chatbot/index.html" target="_blank" id="ia-assistant-icon" class="position-fixed bottom-0 start-50 translate-middle-x m-4">
    <i class="fas fa-robot fa-3x text-primary"></i>
</a>-->

    <!--<div id="audio-prompt" style="display: none;">
    <button id="play-audio">Play Welcome Message</button>
</div>-->

    <!-- Map Section Start -->
    <div class="container-fluid py-5 bg-light">
    <div class="container text-center">
        <h4 class="text-primary mb-4">Find Our Monuments on the Map</h4>
        <!-- Replace with your map's code -->
        <div class="map-container">
            <iframe src="maps/index.html" width="100%" height="500px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</div>
<!-- Map Section End -->

<script>
    window.addEventListener('load', () => {
        const audio = document.getElementById('welcome-audio');
        const prompt = document.getElementById('audio-prompt');
        const playButton = document.getElementById('play-audio');

        audio.play().catch(() => {
            // Show prompt if autoplay is blocked
            prompt.style.display = 'block';
        });

        playButton.addEventListener('click', () => {
            audio.play();
            prompt.style.display = 'none';
        });
    });
</script>
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
        <script src="js/like.js"></script>

        <script>
    // Event listener for the "Like" button
document.querySelectorAll('.like-button').forEach(button => {
    button.addEventListener('click', function() {
        const monid = this.getAttribute('data-monument-id');
        
        // AJAX request using fetch
        fetch('likesys.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                id: monid,
            }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            // Update the like count on the page
            const likeCountElement = document.getElementById(like-count-${monid});
            let currentLikes = parseInt(likeCountElement.textContent.replace('', ''));
            likeCountElement.textContent = ${currentLikes + 1};
        })
        .catch(error => console.error('Error:', error));
    });
});
    </script>
    
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/675753ac49e2fd8dfef58841/1iemhtmo7';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    <script>
        // JavaScript to load notifications when hovering over the notification button
        document.getElementById('notificationButton').addEventListener('mouseenter', function() {
            // Send an AJAX request to load the notifications content
            fetch('notif.php')
                .then(response => response.text())
                .then(data => {
                    // Insert the notifications into the dropdown menu
                    document.getElementById('notificationList').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error loading notifications:', error);
                });
        });
    </script>


    <script>
    // Fetch the latest notification and display it as an alert
    window.onload = function () {
        fetch('notiflast.php')
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message); // Display the notification as an alert
                }
            })
            .catch(error => console.error('Error fetching notification:', error));
    };
    </script>
    </body>

</html>