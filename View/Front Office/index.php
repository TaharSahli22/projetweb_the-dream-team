<?php
include '../../Controller/ReservationsC.php';
include '../../Controller/EvenementsC.php';
$evenementsC = new evenementsC();
$events = $evenementsC->getAllEvents();
$error = "";

$reservation = null;
$reservationC = new ReservationC();  // Use the ReservationC controller

// Check if reservation form data is set
if (
   isset($_POST["nom"]) && $_POST["prenom"] && $_POST["cin"] && $_POST["nomEvenement"] && $_POST["dateEvenement"] && $_POST["baggage"]
) {
   // Check if all the form fields are not empty
   if (
       !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["cin"]) && !empty($_POST["nomEvenement"]) && !empty($_POST["dateEvenement"]) && !empty($_POST["baggage"])
   ) {
       // Create a new Reservation object with the form data
       $reservation = new Reservation(
           $_POST['nom'],
           $_POST['prenom'],
           $_POST['cin'],
           $_POST['nomEvenement'],
           $_POST['dateEvenement'],
           $_POST['baggage']
       );

       // Call the insertReservation method to add the reservation to the database
       $reservationC->insertReservation($reservation);
   } else {
       $error = "Missing information";  // If any required fields are missing
   }
}
$reservations = $reservationC->getAllReservations();
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
        <link rel="stylesheet" href="stylemodal.css"/>
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
                                <a href="index.html" class="nav-item nav-link active ">Events</a>
                                <a href="#" class="nav-item nav-link">Map</a>
                                <a href="#" class="nav-item nav-link">E-shop</a>
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
                                        <h4 class="text-primary text-uppercase fw-bold mb-4">Welcome to our Events</h4>
                                        <h3 class="display-4 text-uppercase text-white mb-4">Book Your event now before places become out of stock</h3>
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
                                        <h4 class="text-primary text-uppercase fw-bold mb-4">Welcome to our Events</h4>
                                        <h3 class="display-4 text-uppercase text-white mb-4">Book Your event now before places become out of stock</h3>
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


        <!-- Abvout Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                        <div>
                            <h4 class="prime">About our Events</h4>
                            <h1 class="display-5 mb-4">Try our various events to meet new people and find out new places</h1>
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="d-flex">
                                        <div><i class="bi bi-bookmark-heart-fill fa-3x text-primary"></i></div>
                                        <div class="ms-4">
                                            <h4>Year Of Expertise</h4>
                                            <p>Enjoy our 20 years of experience</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex">
                                        <i class="fas fa-phone-alt fa-2x text-primary me-4"></i>
                                        <div>
                                            <h4>Call Us</h4>
                                            <p class="mb-0 fs-5" style="letter-spacing: 1px;">+216 98.765.432</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 wow fadeInRight" data-wow-delay="0.2s">
                                <img src="img/about-5.jpg" class="img-fluid rounded-bottom w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Services Start -->
        <div class="container-fluid service pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="prime">Our Events</h4>
            <h1 class="display-5 mb-4">Our Most Popular Events of Every Year</h1>
        </div>
        <div class="row g-4">
            <?php 
            // Check if there are events to display
            if (!empty($events)) {
                foreach ($events as $event) {
                    // Determine the image path (default image if eventimage is empty)
                    $imagePath = !empty($event['eventimage']) ? '../../uploads/' . htmlspecialchars($event['eventimage']) : 'img/default-event.jpg';
            
                    // Loop through each event and create an HTML card
                    echo '
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="' . $imagePath . '" class="img-fluid rounded-top w-100" alt="Event Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4">' . htmlspecialchars($event['Nomevenement']) . '</a>
                                <p class="mb-4">This Event is located in   ' . htmlspecialchars($event['Lieuevenement']) . '</p>
                                <p class="mb-4">Book for your event before  ' . htmlspecialchars($event['Dateevenement']) . ' arrives!</p>
                                <p class="mb-4">Places Left: ' . htmlspecialchars($event['Placedisponible']) . '</p>
                                <button class="btn-reserve-now btn btn-primary rounded-pill py-2 px-4" 
                        data-event-name="' . htmlspecialchars($event['Nomevenement']) . '" 
                        data-event-date="' . htmlspecialchars($event['Dateevenement']) . '">Book Now</button>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No events available at the moment.</p>";
            }
            ?>
            
        </div>
    </div>
</div>
<!-- Modal HTML Structure -->
<div id="reservationModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Réservation</h2>
        <form id="reservationForm"  method="POST" action="submit_reservation.php">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" class="form-control">
                <span class="error-message" id="nom-error"></span> <!-- Error message for Nom -->
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" class="form-control">
                <span class="error-message" id="prenom-error"></span> <!-- Error message for Prénom -->
            </div>
            <div class="form-group">
                <label for="cin">CIN (Carte d'Identité Nationale):</label>
                <input type="text" id="cin" name="cin" class="form-control">
                <span class="error-message" id="cin-error"></span> <!-- Error message for CIN -->
            </div>
            <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="form-control" required>
    <span class="error-message" id="email-error"></span> <!-- Error message for Email -->
</div>
            <div class="form-group">
                <label for="nomEvenement">Nom de l'événement:</label>
                <input type="text" id="nomEvenement" name="nomEvenement" readonly>
            </div>
            <div class="form-group">
                <label for="dateEvenement">Date de l'événement:</label>
                <input type="text" id="dateEvenement" name="dateEvenement" readonly>
            </div>
            <div class="form-group">
                <label for="baggage">Baggage:</label>
                <input type="text" id="baggage" name="baggage" class="form-control">
                <span class="error-message" id="baggage-error"></span> <!-- Error message for Baggage -->
            </div>

            <button type="submit" class="btn">Réserver</button>
        </form>
    </div>
</div>
<!-- Confirmation Modal HTML Structure -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeConfirmationModal">&times;</span>
        <h2 class="modal-title">Reservation Confirmed</h2>
        <p class="confirmation-message">Thank you for your reservation! We have Sent you an email for the confirmation . Below are your reservation details:</p>
        <p><strong>Nom:</strong> <span id="confirmationNom"></span></p>
        <p><strong>Prénom:</strong> <span id="confirmationPrenom"></span></p>
        <p><strong>CIN:</strong> <span id="confirmationCIN"></span></p>
        <p><strong>Nom de l'événement:</strong> <span id="confirmationEventName"></span></p>
        <p><strong>Date de l'événement:</strong> <span id="confirmationEventDate"></span></p>
        <p><strong>Baggage:</strong> <span id="confirmationBaggage"></span></p>
        <button id="printReservation" class="btn">Imprimer</button>
    </div>
</div>


        <!-- Services End -->
        <!-- Offer Start -->
        <div class="container-fluid offer-section pb-5">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="prime">Our Offer</h4>
                    <h1 class="display-5 mb-4">Benefits We offer</h1>
                    <p class="mb-0">Looking to make your event truly unforgettable? Let us handle the details! we offer seamless event booking services tailored to your specific needs. 
                    </p>
                </div>
                <div class="row g-5 align-items-center">
                    <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="nav nav-pills bg-light rounded p-5">
                            <a class="accordion-link p-4 active mb-4" data-bs-toggle="pill" href="#collapseOne">
                                <h5 class="mb-0">Tailored Services</h5>
                            </a>
                            <a class="accordion-link p-4 mb-4" data-bs-toggle="pill" href="#collapseTwo">
                                <h5 class="mb-0">Expert Management</h5>
                            </a>
                            <a class="accordion-link p-4 mb-4" data-bs-toggle="pill" href="#collapseThree">
                                <h5 class="mb-0">Stress-Free Experience</h5>
                            </a>
                            <a class="accordion-link p-4 mb-0" data-bs-toggle="pill" href="#collapseFour">
                                <h5 class="mb-0">Memorable Experiences</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 wow fadeInRight" data-wow-delay="0.4s">
                        <div class="tab-content">
                            <div id="collapseOne" class="tab-pane fade show p-0 active">
                                <div class="row g-4">
                                    <div class="col-md-7">
                                        <img src="img/offer-1.jpg" class="img-fluid w-100 rounded" alt="">
                                    </div>
                                    <div class="col-md-5">
                                        <h1 class="display-5 mb-4">We provide customized event planning to match your specific vision and needs.</h1>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseTwo" class="tab-pane fade show p-0">
                                <div class="row g-4">
                                    <div class="col-md-7">
                                        <img src="img/offer-2.jpg" class="img-fluid w-100 rounded" alt="">
                                    </div>
                                    <div class="col-md-5">
                                        <h1 class="display-5 mb-4">Experienced team to handle all aspects of event coordination—from logistics to execution.</h1>
                                      
                                    </div>
                                </div>
                            </div>
                            <div id="collapseThree" class="tab-pane fade show p-0">
                                <div class="row g-4">
                                    <div class="col-md-7">
                                        <img src="img/offer-3.jpg" class="img-fluid w-100 rounded" alt="">
                                    </div>
                                    <div class="col-md-5">
                                        <h1 class="display-5 mb-4">We take care of the details so you can focus on enjoying your event.</h1>
                            
                                    </div>
                                </div>
                            </div>
                            <div id="collapseFour" class="tab-pane fade show p-0">
                                <div class="row g-4">
                                    <div class="col-md-7">
                                        <img src="img/offer-4.jpg" class="img-fluid w-100 rounded" alt="">
                                    </div>
                                    <div class="col-md-5">
                                        <h1 class="display-5 mb-4">We help create events that leave a lasting impact on your guests.</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Offer End -->
        <!-- FAQs Start -->
        <div class="container-fluid faq-section pb-5">
            <div class="container pb-5 overflow-hidden">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="prime">FAQs</h4>
                    <h1 class="display-5 mb-4">Frequently Asked Questions</h1>
                </div>
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="accordion accordion-flush bg-light rounded p-5" id="accordionFlushSection">
                            <div class="accordion-item rounded-top">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        1.How do I book an event with your team?
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushSection">
                                    <div class="accordion-body">Simply reach out to us via our website’s contact form, email, or phone. Our team will schedule a consultation to understand your needs, budget, and vision. From there, we’ll handle the rest—crafting a customized plan just for you.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        2. Can you help with venue selection?
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushSection">
                                    <div class="accordion-body">Yes! We have access to a variety of stunning venues, and we’ll recommend the perfect one based on your event type, guest count, and location preferences. We’ll also manage venue bookings, ensuring everything is secured on your behalf.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                        3. Do you provide catering services?
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushSection">
                                    <div class="accordion-body">Absolutely! We offer a wide range of catering options—from plated meals to buffet spreads, cocktail receptions, and themed menus. Whether you have dietary preferences or special requests, we work with trusted caterers to provide high-quality food and beverages.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                        4. How much does it cost to book an event?
                                    </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushSection">
                                    <div class="accordion-body">Event pricing varies depending on the type, scale, and location of the event, as well as the services required (e.g., catering, entertainment, decor). After our initial consultation, we’ll provide a detailed quote based on your specific needs and preferences.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                        5. Can I make changes to my event after booking?
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushSection">
                                    <div class="accordion-body">Yes! We understand that plans may evolve. We’ll work with you to accommodate any changes, whether it’s adjusting the guest list, altering the timeline, or tweaking the design. Flexibility is key to creating the perfect event.</div>
                                </div>
                            </div>
                            <div class="accordion-item rounded-bottom">
                                <h2 class="accordion-header" id="flush-headingSix">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                        6. What is included in your full-service event planning?
                                    </button>
                                </h2>
                                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushSection">
                                    <div class="accordion-body">Our full-service package covers everything from concept creation and venue selection to catering, entertainment, decor, lighting, and more. We handle all logistics, timelines, and vendor coordination to ensure a smooth experience from start to finish.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                        <div class="bg-primary rounded">
                            <img src="img/about-2.jpg" class="img-fluid w-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQs End -->
        <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        
                </div>
            </div>
        </div>

        <script>
// Get modal elements
var reservationModal = document.getElementById("reservationModal");
var confirmationModal = document.getElementById("confirmationModal");

// Get the button that opens the reservation modal
var btns = document.querySelectorAll(".btn-reserve-now");

// Get the <span> element that closes the reservation modal
var closeBtn = document.querySelector(".close-btn");

// Get the <span> element that closes the confirmation modal
var closeConfirmationModal = document.getElementById("closeConfirmationModal");

// When the user clicks on the "Reservez maintenant" button, open the reservation modal
btns.forEach(function(btn) {
    btn.addEventListener("click", function() {
        // Get event details from the button's parent card
        var eventName = this.getAttribute("data-event-name");
        var eventDate = this.getAttribute("data-event-date");

        // Set the event name and date in the reservation modal form
        document.getElementById("nomEvenement").value = eventName;
        document.getElementById("dateEvenement").value = eventDate;

        // Show the reservation modal
        reservationModal.style.display = "block";
    });
});

// When the user clicks on <span> (x), close the reservation modal
closeBtn.onclick = function() {
    reservationModal.style.display = "none";
}

// When the user clicks anywhere outside of the reservation modal, close it
window.onclick = function(event) {
    if (event.target == reservationModal) {
        reservationModal.style.display = "none";
    }
    if (event.target == confirmationModal) {
        confirmationModal.style.display = "none";
    }
}

// Handle reservation form submission with validation
document.getElementById("reservationForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission to handle validation

    // Clear any previous error messages
    const errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach(function(error) {
        error.textContent = "";
    });

    let isValid = true;

    // Get form values
    const nom = document.getElementById("nom").value;
    const prenom = document.getElementById("prenom").value;
    const cin = document.getElementById("cin").value;
    const baggage = document.getElementById("baggage").value;
    const eventName = document.getElementById("nomEvenement").value;
    const eventDate = document.getElementById("dateEvenement").value;
    const email = document.getElementById("email").value;

    // Validation logic
    const nomRegex = /^[A-Za-zÀ-ÿ\s]+$/;
    const prenomRegex = /^[A-Za-zÀ-ÿ\s]+$/;
    const cinRegex = /^[0-9]+$/;

    // Validate fields
    if (nom.length < 1 || nom.length > 50 || !nomRegex.test(nom)) {
        document.getElementById("nom-error").textContent = "Nom should be between 1-50 characters and contain no special characters.";
        isValid = false;
    }

    if (prenom.length < 1 || prenom.length > 50 || !prenomRegex.test(prenom)) {
        document.getElementById("prenom-error").textContent = "Prénom should be between 1-50 characters and contain no special characters.";
        isValid = false;
    }

    if (!cinRegex.test(cin)) {
        document.getElementById("cin-error").textContent = "CIN should contain only numeric values.";
        isValid = false;
    }

    if (!/^[0-9]+$/.test(baggage)) {
        document.getElementById("baggage-error").textContent = "Baggage should be a numeric value.";
        isValid = false;
    }
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
if (!emailRegex.test(email)) {
    document.getElementById("email-error").textContent = "Please enter a valid email address.";
    isValid = false;
}

    // If validation passes, send the form data to the server
    if (isValid) {
        const formData = new FormData(document.getElementById("reservationForm"));

        fetch('submit_reservation.php', {
            method: 'POST',
            body: formData // Send form data to the backend
        })
        .then(response => response.json())
        .then(data => {
            // Handle server response
            if (data.success) {
                // Populate the confirmation modal with the reservation details
                document.getElementById("confirmationNom").textContent = nom;
                document.getElementById("confirmationPrenom").textContent = prenom;
                document.getElementById("confirmationCIN").textContent = cin;
                document.getElementById("confirmationEventName").textContent = eventName;
                document.getElementById("confirmationEventDate").textContent = eventDate;
                document.getElementById("confirmationBaggage").textContent = baggage;

                // Show the confirmation modal
                confirmationModal.style.display = "block";
                closeModal();  // Close the reservation modal
            } else {
                alert('Error: ' + data.message); // Show error message returned by PHP
            }
        })
        .catch(error => {
            alert('Error: ' + error); // Handle any errors with the request
        });
    }
});

// Close the reservation modal
function closeModal() {
    reservationModal.style.display = "none"; // Hide the reservation modal
}

// Close the confirmation modal when user clicks the close button
closeConfirmationModal.addEventListener("click", function() {
    confirmationModal.style.display = "none"; // Close the confirmation modal
});

// Add the print functionality
document.getElementById("printReservation").addEventListener("click", function() {
    window.print(); // This will trigger the print dialog for the page
});
</script>

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