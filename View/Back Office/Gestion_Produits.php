<?php
include '../../Controller/ProduitsC.php';

$error = "";

$product = null;
$produitsC = new ProduitsC();

if (
    isset($_POST["nomproduit"]) && $_POST["origin"] && $_POST["prixproduit"] && $_POST["nbrdisponible"]
) {
    if (
        !empty($_POST["nomproduit"]) && !empty($_POST["origin"]) && !empty($_POST["prixproduit"]) && !empty($_POST["nbrdisponible"])
    ) {
        $product = new Produits(
            null,
            $_POST['nomproduit'],
            $_POST['origin'],
            $_POST['prixproduit'],
            $_POST['nbrdisponible'],
        );
                
        $produitsC->addProduct($product);
    } else {
        $error = "Missing information";
    }
}

$products = $produitsC->getAllProducts();
?>





<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gestion Produits - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
    
    
    
</head>

<body>
    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">     
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="index.html">
                        <b class="logo-icon p-l-10">
                            <img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <span class="logo-text"> 
                             <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" />   
                        </span>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-right">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Events</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Gestion_Produits.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">E-shop</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Users</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Reclamations</span></a></li>
                        
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
       
        <div class="page-wrapper">
          
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Tables</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="container-fluid">

            <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title m-b-0">Available Products</h5>
                <div class="btn-group" role="group" aria-label="Product Actions">
                    <button type="button" class="btn btn-primary" onclick="showAddProductModal()">Add Product</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Price</th>
                        <th scope="col">Available Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($product['nomproduit']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['origin']) . "</td>";
                        echo "<td>" . htmlspecialchars($product['prixproduit']) . "$</td>";
                        echo "<td>" . htmlspecialchars($product['nbrdisponible']) . "</td>";
                        echo '<td><button class="btn btn-primary" onclick="openEditProductModal(' . htmlspecialchars($product['Idproduit']) . ')">Modify</button>';
                        echo '<td><button class="btn btn-danger" onclick="deleteProduct(' . htmlspecialchars($product['Idproduit']) . ')">Delete</button></td>';
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Commandes of products</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Last Name</th>
                                                <th>Product chosen</th>
                                                <th>Date of commande</th>
                                                <th>quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Name</th>
                                                <th>Last Name</th>
                                                <th>Product chosen</th>
                                                <th>Date of commande</th>
                                                <th>quantity</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div id="editProductModal" style="display:none;">
                                <div class="modal-content">
    <h2>Edit Product</h2>
    <form id="editProductForm">
        <input type="hidden" id="editProductId" name="editProductId" />
        
        <label for="editProductName">Product Name:</label>
        <input type="text" id="editProductName" name="editProductName" required />
        
        <label for="editProductOrigin">Product Origin:</label>
        <input type="text" id="editProductOrigin" name="editProductOrigin" required />

        <label for="editProductPrice">Product Price:</label>
        <input type="number" id="editProductPrice" name="editProductPrice" required />

        <label for="editProductQuantity">Available Quantity:</label>
        <input type="number" id="editProductQuantity" name="editProductQuantity" required />

        <button type="submit">Save Changes</button>
        <button type="button" onclick="closeEditModal()">Cancel</button>
    </form>
</div>


                            </div>
                        </div>
                    </div>
                </div>

            
            </div>
            <div class="modal" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" method="POST" action="path_to_your_php_script.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="nomproduit" placeholder="Enter product name" required>
                    </div>
                    <div class="form-group">
                        <label for="productOrigin">Product Origin</label>
                        <input type="text" class="form-control" id="productOrigin" name="origin" placeholder="Enter product origin" required>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Price of Product</label>
                        <input type="text" class="form-control" id="productPrice" name="prixproduit" placeholder="Enter price" required>
                    </div>
                    <div class="form-group">
                        <label for="productQuantity">Available Quantity</label>
                        <input type="number" class="form-control" id="productQuantity" name="nbrdisponible" placeholder="Enter number of available products" required>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="imageproduit" accept="image/*" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Save Product</button>
            </div>
        </div>
    </div>
</div>

          
            <footer class="footer text-center">
            </footer>
        </div>

    </div>
    <script>
    // Show the Add Product Modal
    function showAddProductModal() {
        const modal = document.getElementById('addProductModal');
        modal.style.display = 'block';
    }

    // Close the Modal
    function closeModal() {
        const modal = document.getElementById('addProductModal');
        modal.style.display = 'none';
    }

    // Validate the Add Product Form
    function validateForm() {
        const productName = document.getElementById('productName').value.trim();
        const productOrigin = document.getElementById('productOrigin').value.trim();
        const productPrice = document.getElementById('productPrice').value.trim();
        const productQuantity = document.getElementById('productQuantity').value.trim();

        const nameRegex = /^[a-zA-Z0-9 ]{1,50}$/; // Only alphanumeric and spaces, max 50 chars
        let isValid = true;

        // Clear previous error messages
        clearErrorMessages();

        // Validate Product Name
        if (!nameRegex.test(productName)) {
            displayErrorMessage('productName', "Product Name must be between 1 and 50 characters long and contain no special symbols.");
            isValid = false;
        }

        // Validate Product Origin
        if (!nameRegex.test(productOrigin)) {
            displayErrorMessage('productOrigin', "Origin must be between 1 and 50 characters long and contain no special symbols.");
            isValid = false;
        }

        // Validate Product Price
        if (!/^\d+(\.\d{1,2})?$/.test(productPrice)) {
            displayErrorMessage('productPrice', "Price must be a valid number.");
            isValid = false;
        }

        // Validate Product Quantity
        if (!/^\d+$/.test(productQuantity)) {
            displayErrorMessage('productQuantity', "Quantity must be a valid number.");
            isValid = false;
        }

        return isValid; // If all validations pass, return true
    }

    // Function to display error messages next to form fields
    function displayErrorMessage(fieldId, message) {
        const field = document.getElementById(fieldId);
        const errorSpan = document.createElement('span');
        errorSpan.classList.add('error-message');
        errorSpan.style.color = 'red';
        errorSpan.textContent = message;

        // Append error message after the input field
        field.parentNode.appendChild(errorSpan);
    }

    // Function to clear any previous error messages
    function clearErrorMessages() {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(error => error.remove());
    }

    // Submit the Add Product Form
    function submitForm() {
        // First, validate the form
        if (validateForm()) {
            // Grab the form data
            const formData = new FormData(document.getElementById('addProductForm'));

            // Use fetch to send data to the server
            fetch('path_to_your_php_script.php', {
    method: 'POST',
    body: formData // Send the form data to the PHP backend
})
.then(response => response.json()) // Assuming the server sends back a JSON response
.then(data => {
    // Handle the server response
    if (data.success) {
        alert('Product saved successfully!');
        closeModal();  // Close the modal if the product is saved
    } else {
        alert('Error: ' + data.message); // Show error message returned by PHP
    }
})
.catch(error => {
    alert('Error: ' + error); // Handle any errors with the request
});

        }
    }

    // Delete a product
    function deleteProduct(productId) {
        // Confirm the deletion
        if (confirm('Are you sure you want to delete this product?')) {
            // Use fetch to send the delete request to deleteProduct.php
            fetch('deleteProduct.php?id=' + productId)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Product deleted successfully!');
                        // Reload the page to reflect the change
                        location.reload();
                    } else {
                        alert('Error: ' + data.error);
                    }
                })
                .catch(error => {
                    alert('Error: ' + error);  // Handle any errors
                });
        }
    }
</script>

<script>
    // Open the Edit Product Modal
    function openEditProductModal(productId) {
        // Fetch the product data from the server using the product ID
        fetch('getProductData.php?id=' + productId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Fill the form fields with the product data
                    document.getElementById('editProductId').value = data.product.Idproduit;
                    document.getElementById('editProductName').value = data.product.nomproduit;
                    document.getElementById('editProductOrigin').value = data.product.origin;
                    document.getElementById('editProductPrice').value = data.product.prixproduit;
                    document.getElementById('editProductQuantity').value = data.product.nbrdisponible;

                    // Show the edit modal
                    document.getElementById('editProductModal').style.display = 'block';
                } else {
                    alert('Error fetching product data.');
                }
            })
            .catch(error => {
                alert('Error: ' + error);
            });
    }

    // Close the Edit Product Modal
    function closeEditModal() {
        document.getElementById('editProductModal').style.display = 'none';
    }

    // Handle the Edit Product Form submission
    document.getElementById('editProductForm').addEventListener('submit', function (e) {
        e.preventDefault();

        // Prepare form data for submission
        const formData = new FormData(document.getElementById('editProductForm'));

        // Send the form data to the server using fetch
        fetch('updateProduct.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product updated successfully!');
                closeEditModal();  // Close the modal
                location.reload();  // Reload the page to reflect the changes
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            alert('Error: ' + error);
        });
    });
</script>

    <style>
        .error-message {
    font-size: 12px;
    color: red;
    margin-top: 5px;
}
    </style>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        $('#zero_config').DataTable();
    </script>

</body>

</html>