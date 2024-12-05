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
                        <a href="tel:+01234567890" class="text-muted small me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+216420500</a>
                        <a href="mailto:example@gmail.com" class="text-muted small me-0"><i class="fas fa-envelope text-primary me-2"></i>Terra@gmail.com</a>
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
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="" class="nav-item nav-link">Home</a>
                        <a href="" class="nav-item nav-link">Events</a>
                        <a href="" class="nav-item nav-link">E-Shop</a>
                        <a href="" class="nav-item nav-link">Blogs</a>
                        <a href="" class="nav-item nav-link active">Donations</a>
                        <a href="" class="nav-item nav-link">Contact Us</a>
                    </div>
                    <a href="#" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Get Started</a>
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




    <!-- IA Assistant Icon -->
    <a href="chatbot/index.html" target="_blank" id="ia-assistant-icon" class="position-fixed bottom-0 end-0 m-4">
        <i class="fas fa-robot fa-3x text-primary"></i>
    </a>



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
    </body>

</html>