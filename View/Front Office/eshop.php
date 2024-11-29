<?php

include '../../Controller/ProduitsC.php';
$produitsC = new produitsC();
$produits = $produitsC->getAllProducts();

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Events - Book Now</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="lib/animate/animate.min.css"/>
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <img src="img/logo.png" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="#" class="nav-item nav-link">Home</a>
                                <a href="" class="nav-item nav-link">Events</a>
                                <a href="#" class="nav-item nav-link">Map</a>
                                <a href="eshop.php" class="nav-item nav-link active">E-shop</a>
                                <a href="#" class="nav-item nav-link">Reclamations</a>
                                <a href="#" class="nav-item nav-link">Our team</a>
                    </div>
                    <a href="#" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Login</a>
                </div>
            </nav>

            <!-- Slides -->
            <div class="header-carousel owl-carousel">
                <div class="header-carousel-item">
                    <img src="img/slide1.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row gy-0 gx-5">
                                <div class="col-lg-0 col-xl-5"></div>
                                <div class="col-xl-7 animated fadeInLeft">
                                    <div class="text-sm-center text-md-end">
                                        <h4 class="text-primary text-uppercase fw-bold mb-4">Welcome to our E-shop</h4>
                                        <h3 class="display-4 text-uppercase text-white mb-4">Buy Our mysterious Products now</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-carousel-item">
                    <img src="img/slide2.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row g-5">
                                <div class="col-12 animated fadeInUp">
                                    <div class="text-center">
                                        <h4 class="text-primary text-uppercase fw-bold mb-4">Welcome to our E-shop</h4>
                                        <h3 class="display-4 text-uppercase text-white mb-4">Buy Our mysterious Products now</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slides -->
        </div>
        <!-- Navbar & Hero End -->


        

        <!-- Services Start -->
        <<div class="container-fluid service pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Our Products</h4>
            <h1 class="display-5 mb-4">Our Most Popular Products</h1>
        </div>
        <div class="row g-4">
            <?php 
            // Check if there are  to display
            if (!empty($produits)) {
                foreach ($produits as $produit) {
                    // Determine the image path (default image if eventimage is empty)
                    $imagePath = !empty($produit['imageproduit']) ? '../../uploads/' . htmlspecialchars($produit['imageproduit']) : 'img/default-event.jpg';
            
                    // Loop through each event and create an HTML card
                    echo '
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="' . $imagePath . '" class="img-fluid rounded-top w-100" alt="Event Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4">' . htmlspecialchars($produit['nomproduit']) . '</a>
                                <p class="mb-4">Buy this Special Products before it becomes out of stock !</p>
                                <p class="mb-4">This product is from  ' . htmlspecialchars($produit['origin']) . ' </p>
                                <p class="mb-4">And it only costs   ' . htmlspecialchars($produit['prixproduit']) . '$ </p>
                                <p class="mb-4">Quantity left : ' . htmlspecialchars($produit['nbrdisponible']) . '</p>
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Buy Now</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No Products available at the moment.</p>";
            }
            ?>
            
        </div>
    </div>
</div>

        <!-- Services End -->
        
        <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        
                </div>
            </div>
        </div>
        <!-- Footer End -->
    
        
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