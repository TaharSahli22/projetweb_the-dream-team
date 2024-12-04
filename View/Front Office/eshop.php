<?php

include '../../Controller/ProduitsC.php';
include '../../Controller/OrdersC.php';
$produitsC = new produitsC();
$produits = $produitsC->getAllProducts();

// Initialize the order variables and the OrdersC controller
$error = "";
$order = null;
$ordersC = new OrdersC();  // Use the OrdersC controller

// Check if order form data is set
if (
   isset($_POST["fullName"])  && $_POST["phoneNumber"]&& $_POST["email"] && $_POST["Clocation"]  && $_POST["Productname"] && $_POST["Productprice"]&& $_POST["productQuantity"]&& $_POST["totalPrice"] && $_POST["idprod"]
) {
   // Check if all the form fields are not empty
   if (
       !empty($_POST["fullName"])&& !empty($_POST["phoneNumber"])&& !empty($_POST["email"]) && !empty($_POST["Clocation"]) && !empty($_POST["Productname"]) && !empty($_POST["Productprice"])&& !empty($_POST["productQuantity"]) && !empty($_POST["totalPrice"])  && !empty($_POST["idprod"]) 
   ) {
       // Create a new Order object with the form data
       $order = new Orders(
        
            null,
           $_POST['fullName'],
           $_POST['phoneNumber'],
           $_POST['email'],
           $_POST['Clocation'],
           $_POST['Productname'],
           $_POST['Productprice'],
           $_POST['productQuantity'],
           $_POST['totalPrice'],
           $_POST['idprod'],
           
       );

       // Call the insertOrder method to add the order to the database
       $ordersC->insertOrder($order);
   } else {
       $error = "Missing information";  // If any required fields are missing
   }
}

// Fetch all orders for display
$orders = $ordersC->getAllOrders();

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
        <link rel="stylesheet" href="modals.css"/>
        
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



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
                                <button class="btn-buy-now btn btn-primary rounded-pill py-2 px-4" 
        data-product-name="' . htmlspecialchars($produit['nomproduit']) . '" 
        data-product-price="' . htmlspecialchars($produit['prixproduit']) . '"
        data-product-id="' . htmlspecialchars($produit['Idproduit']) . '"
        >
    Buy Now
</button>
                            </div>
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
        <!-- Modal HTML Structure for Order -->
<div id="orderModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Order</h2>
        <form id="orderForm" method="POST" action="submit_Order.php">
        <input type="hidden" id="idprod" name="idprod" class="form-control">
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" class="form-control">
                <span class="error-message" id="fullName-error"></span> <!-- Error message for Full Name -->
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control">
                <span class="error-message" id="email-error"></span> <!-- Error message for Email -->
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control">
                <span class="error-message" id="phoneNumber-error"></span> <!-- Error message for Phone Number -->
            </div>
            <div class="form-group">
                <label for="Clocation">Location:</label>
                <input type="text" id="Clocation" name="Clocation" class="form-control">
                <span class="error-message" id="Userlocation-error"></span> <!-- Error message for Location -->
            </div>
            <div class="form-group">
                <label for="Productname">Product Name:</label>
                <input type="text" id="Productname" name="Productname" readonly>
            </div>
            <div class="form-group">
                <label for="Productprice">Product Price:</label>
                <input type="text" id="Productprice" name="Productprice" readonly>
            </div>
            <div>
            <div>
    <label for="productQuantity">Quantity:</label>
    <input type="number" id="productQuantity" name="productQuantity" class="form-control" min="1" value="1">
</div>

<div>
    <label for="totalPrice">Total Price:</label>
    <input type="text" id="totalPrice" name="totalPrice" class="form-control" readonly>
</div>


            <div class="form-group">
                <label for="paymentMethod">Payment Method:</label>
                <select id="paymentMethod" name="paymentMethod" class="form-control">
                    <option value="cash">Cash</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="cheques">Cheques</option>
                </select>
            </div>

            <!-- Credit Card Fields (Hidden by default) -->
            <div id="creditCardFields" class="credit-card-fields" style="display:none;">
                <label for="cardNumber">Card Number:</label>
                <input type="text" id="cardNumber" name="cardNumber" class="form-control">
                <span class="error-message" id="cardNumber-error"></span> <!-- Error message for Card Number -->
            </div>
            <div id="creditCardExpiry" class="credit-card-fields" style="display:none;">
                <label for="cardExpiry">Expiration Date:</label>
                <input type="text" id="cardExpiry" name="cardExpiry" class="form-control">
                <span class="error-message" id="cardExpiry-error"></span> <!-- Error message for Expiry Date -->
            </div>
            <div id="creditCardCVV" class="credit-card-fields" style="display:none;">
                <label for="cardCVV">CVV:</label>
                <input type="text" id="cardCVV" name="cardCVV" class="form-control">
                <span class="error-message" id="cardCVV-error"></span> <!-- Error message for CVV -->
            </div>

            <button type="submit" class="btn">Place Order</button>
        </form>
    </div>
</div>


        <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        
                </div>
            </div>
        </div>
        <!-- Footer End -->
    <script>
        // Get modal elements
var orderModal = document.getElementById("orderModal");

// Get the button that opens the order modal
var btns = document.querySelectorAll(".btn-buy-now");

// Get the <span> element that closes the order modal
var closeBtn = document.querySelector(".close-btn");

// Get the credit card fields section
var creditCardFields = document.getElementById("creditCardFields");
var creditCardExpiry = document.getElementById("creditCardExpiry");
var creditCardCVV = document.getElementById("creditCardCVV");

// Get the quantity and total price fields
var productQuantityField = document.getElementById("productQuantity");
var totalPriceField = document.getElementById("totalPrice");

// When the user clicks on the "Buy Now" button, open the order modal
btns.forEach(function(btn) {
    btn.addEventListener("click", function() {
        // Get product details from the button's data attributes
        var nomproduit = this.getAttribute("data-product-name");
        var prixproduit = parseFloat(this.getAttribute("data-product-price")); // Convert price to float
        var prodid = this.getAttribute("data-product-id");

        // Set the product name, price, and productId in the order modal form
        document.getElementById("Productname").value = nomproduit;
        document.getElementById("Productprice").value = prixproduit.toFixed(2); // Display price as a fixed decimal
        document.getElementById("idprod").value = prodid;
        // Reset quantity and calculate the total price for the default value
        productQuantityField.value = 1; // Default quantity
        totalPriceField.value = prixproduit.toFixed(2); // Default total price

        // Show the order modal
        orderModal.style.display = "block";

        // Update total price dynamically when quantity changes
        productQuantityField.addEventListener("input", function() {
            var quantity = parseInt(productQuantityField.value, 10);
            if (quantity >= 1) {
                totalPriceField.value = (quantity * prixproduit).toFixed(2); // Calculate total price
            } else {
                totalPriceField.value = "0.00"; // Handle invalid quantity input
            }
        });
    });
});

// When the user clicks on <span> (x), close the order modal
closeBtn.onclick = function() {
    orderModal.style.display = "none";
}

// When the user clicks anywhere outside of the order modal, close it
window.onclick = function(event) {
    if (event.target == orderModal) {
        orderModal.style.display = "none";
    }
}

// Show/hide credit card fields based on payment method selection
document.getElementById("paymentMethod").addEventListener("change", function() {
    var selectedPaymentMethod = this.value;

    if (selectedPaymentMethod === "credit_card") {
        creditCardFields.style.display = "block"; // Show card number field
        creditCardExpiry.style.display = "block"; // Show expiry date field
        creditCardCVV.style.display = "block"; // Show CVV field
    } else {
        creditCardFields.style.display = "none"; // Hide card number field
        creditCardExpiry.style.display = "none"; // Hide expiry date field
        creditCardCVV.style.display = "none"; // Hide CVV field
    }
});

// Handle order form submission with validation
document.getElementById("orderForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission to handle validation

    // Clear any previous error messages
    const errorMessages = document.querySelectorAll(".error-message");
    errorMessages.forEach(function(error) {
        error.textContent = "";
    });

    let isValid = true;

    // Get form values
    const fullName = document.getElementById("fullName").value;
    const email = document.getElementById("email").value;
    const phoneNumber = document.getElementById("phoneNumber").value;
    const Userlocation = document.getElementById("Clocation").value;
    const produitname = document.getElementById("Productname").value;
    const produitprix = document.getElementById("Productprice").value;
    const paymentMethod = document.getElementById("paymentMethod").value;
    const cardNumber = document.getElementById("cardNumber").value;
    const cardExpiry = document.getElementById("cardExpiry").value;
    const cardCVV = document.getElementById("cardCVV").value;

    // Validation logic
    const nameRegex = /^[A-Za-zÀ-ÿ\s]+$/;
    const phoneRegex = /^[0-9]+$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Validate fields
    if (fullName.length < 1 || fullName.length > 50 || !nameRegex.test(fullName)) {
        document.getElementById("fullName-error").textContent = "Name should be between 1-50 characters and contain no special characters.";
        isValid = false;
    }

    if (!email || email.length <= 1 || !emailRegex.test(email)) {
        document.getElementById("email-error").textContent = "Please enter a valid email address with more than 1 character.";
        isValid = false;
    }

    if (!phoneRegex.test(phoneNumber) || phoneNumber.length <= 1) {
        document.getElementById("phoneNumber-error").textContent = "Phone number should contain only numeric values and be longer than 1 digit.";
        isValid = false;
    }

    if (Userlocation.length < 1 || Userlocation.length > 100) {
        document.getElementById("Userlocation-error").textContent = "Location should be between 1-100 characters.";
        isValid = false;
    }

    if (paymentMethod === "credit_card") {
        if (cardNumber.length < 16) {
            document.getElementById("cardNumber-error").textContent = "Card number must be 16 digits.";
            isValid = false;
        }

        if (!cardExpiry.match(/^(0[1-9]|1[0-2])\/[0-9]{2}$/)) {
            document.getElementById("cardExpiry-error").textContent = "Expiration date should be in MM/YY format.";
            isValid = false;
        }

        if (cardCVV.length !== 3 || isNaN(cardCVV)) {
            document.getElementById("cardCVV-error").textContent = "CVV should be 3 digits.";
            isValid = false;
        }
    }

    // If validation passes, send the form data to the server
    if (isValid) {
        const formData = new FormData(document.getElementById("orderForm"));

        fetch('submit_Order.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Handle server response
            if (data.success) {
                closeModal();  // Close the order modal
                Swal.fire({
                        title: '<strong style="font-size: 24px; color: #28a745;">Order Placed Successfully!</strong>',
                        html: '<p style="font-size: 18px; color: #333;">Your order will be processed shortly. Thank you for choosing us!</p>',
                        icon: 'success',
                        confirmButtonText: '<span style="font-size: 16px;">OK</span>',
                        width: '500px',
                        padding: '30px',
                        showCloseButton: true,
                        background: '#f9f9f9',
                    });
                } else {
                    Swal.fire('Order Failed', data.message, 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error', 'Something went wrong. Please try again later.', 'error');
            });
    }
});

// Close the order modal
function closeModal() {
    orderModal.style.display = "none"; // Hide the order modal
}



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
    </body>

</html>