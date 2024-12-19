<?php
include '../../controller/mcontroller.php';
$mcontroller = new mController();
$list = $mcontroller->listmonument();
$dcontroller = new dController();
$don = $dcontroller->listdonations();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monument List</title>
    <link rel="stylesheet" href="css/rela.css">
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
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">



    <style>
        .btn-ajouter {
            background-color: #28a745; /* Vert */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-ajouter:hover {
            background-color: #218838; /* Vert plus foncé */
        }
    </style>
</head>
<body>
<div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="img/logo1.png" width="50" alt="homepage" class="light-logo" />
                           
                        </b>
                        <!--End Logo icon -->
                         <!-- Logo text -->
                        <span class="logo-text">
                            <h6>TERRA DI CULTURA</h6>
                            
                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
                            
                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="full-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        
                        
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                            </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                             <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Event today</h5> 
                                                        <span class="mail-desc">Just a reminder that event</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Settings</h5> 
                                                        <span class="mail-desc">You can customize this template</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Pavan kumar</h5> 
                                                        <span class="mail-desc">Just see the my admin!</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Launch Admin</h5> 
                                                        <span class="mail-desc">Just see the my new admin!</span> 
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">

                                <div class="dropdown-divider"></div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>

                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Gestion_Events.php" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Events</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Gestion_Produits.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">E-shop</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="clientdash.php" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Users </span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="reclamationback.php" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Reclamations</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="mlist.php" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Donation</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="blogdash.php" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">BLOG</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

  
            <div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Monument List</h1>
              </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                 
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Donation</th>
                                    <th>Image</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                          
<?php
foreach ($list as $monument) {
?> 
<tr>
  <td><?= $monument['id']; ?></td>
  <td><?= $monument['name']; ?></td>
  <td><?= $monument['description']; ?></td>
  <td><?= $monument['price']; ?></td>
  <td><?= $monument['image']; ?></td>
  <td align="center">
    <!-- Button for updating the monument -->
    <button 
      class="btn btn-primary btn-sm updateBtn" 
      data-id="<?= $monument['id']; ?>" 
      data-name="<?= $monument['name']; ?>" 
      data-description="<?= $monument['description']; ?>" 
      data-price="<?= $monument['price']; ?>" 
      data-image="<?= $monument['image']; ?>">
      Update
    </button>
  </td>
  <td>
    <a href="mdelete.php?id=<?php echo $monument['id']; ?>">Delete</a>
  </td>
</tr>
<?php
}
?>

                    </table>

                    
                    </div>
                </div>
            </div>
        </div>

      
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="madd.php" class="btn-ajouter">Ajouter un Monument</a>
    </div>



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Donation List</h1>
              </div>


    <div class="row">
    <div class="col-xl-12 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Bank</th>
                                <th>Account</th>
                                <th>IBAN</th>
                                <th>Amount</th>
                                <th colspan="2">Actions</th>
                            </tr>
                            
                            <?php
                            foreach ($don as $donation) {
                            ?> 
                            <tr>
                                <td><?= $donation['name']; ?></td>
                                <td><?= $donation['address']; ?></td>
                                <td><?= $donation['phone']; ?></td>
                                <td><?= $donation['bank']; ?></td>
                                <td><?= $donation['account']; ?></td>
                                <td><?= $donation['iban']; ?></td>
                                <td><?= $donation['amount']; ?></td>
                                <td align="center">
                                    <!-- Button for updating the donation -->
                                    <button 
                                        class="btn btn-primary btn-sm updateBtn²"  
                                        data-name="<?= $donation['name']; ?>" 
                                        data-address="<?= $donation['address']; ?>" 
                                        data-phone="<?= $donation['phone']; ?>" 
                                        data-bank="<?= $donation['bank']; ?>" 
                                        data-account="<?= $donation['account']; ?>" 
                                        data-iban="<?= $donation['iban']; ?>" 
                                        data-amount="<?= $donation['amount']; ?>">
                                        Update
                                    </button>
                                </td>
                                <td>
                                    <a href="ddelete.php?id=<?php echo $donation['phone']; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  

</div>

<!-- Modal for updating monument -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Monument</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateForm" method="POST" action="mupdate.php">
          <input type="hidden" id="updateId" name="id">
          <div class="mb-3">
            <label for="updateName" class="form-label">Name</label>
            <input type="text" class="form-control" id="updateName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="updateDescription" class="form-label">Description</label>
            <textarea class="form-control" id="updateDescription" name="description" required></textarea>
          </div>
          <div class="mb-3">
            <label for="updatePrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="updatePrice" name="price" required>
          </div>
          <div class="mb-3">
            <label for="updateImage" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="updateImage" name="image" required>
          </div>
          <button type="submit" class="btn btn-primary">Update Monument</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const updateButtons = document.querySelectorAll(".updateBtn");
    const updateModal = new bootstrap.Modal(document.getElementById("updateModal"));

    updateButtons.forEach(button => {
      button.addEventListener("click", function () {
        // Pré-remplir les champs du modal avec les valeurs du bouton
        document.getElementById("updateId").value = this.getAttribute("data-id");
        document.getElementById("updateName").value = this.getAttribute("data-name");
        document.getElementById("updateDescription").value = this.getAttribute("data-description");
        document.getElementById("updatePrice").value = this.getAttribute("data-price");
        document.getElementById("updateImage").value = this.getAttribute("data-image");

        // Afficher le modal
        updateModal.show();
      });
    });
  });
</script>


<!-- Modal for updating donation -->
<div class="modal fade" id="updateModel" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Donation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateForm" method="POST" action="dupdate.php">
          <input type="hidden" id="updateId" name="id">
          <div class="mb-3">
            <label for="updateDonorName" class="form-label">Donor Name</label>
            <input type="text" class="form-control" id="updateDonorName" name="donor_name" required>
          </div>
          <div class="mb-3">
            <label for="updateEmail" class="form-label">E-Mail Address</label>
            <input type="email" class="form-control" id="updateEmail" name="email" required>
          </div>
          <div class="mb-3">
            <label for="updatePhone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="updatePhone" name="phone" required>
          </div>
          <div class="mb-3">
            <label for="updateBankName" class="form-label">Bank Name</label>
            <input type="text" class="form-control" id="updateBankName" name="bank_name" required>
          </div>
          <div class="mb-3">
            <label for="updateAccountNumber" class="form-label">Account Number</label>
            <input type="text" class="form-control" id="updateAccountNumber" name="account_number" required>
          </div>
          <div class="mb-3">
            <label for="updateIban" class="form-label">IBAN</label>
            <input type="text" class="form-control" id="updateIban" name="iban" required>
          </div>
          <div class="mb-3">
            <label for="updateAmount" class="form-label">Donation Amount</label>
            <input type="number" class="form-control" id="updateAmount" name="amount" required>
          </div>
          <button type="submit" class="btn btn-primary">Update Donation</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const updateButtons = document.querySelectorAll(".updateBtn²");
    const updateModal = new bootstrap.Modal(document.getElementById("updateModel"));

    updateButtons.forEach(button => {
      button.addEventListener("click", function () {
        // Pré-remplir les champs du modal avec les valeurs du bouton
        document.getElementById("updateId").value = this.getAttribute("data-id");
        document.getElementById("updateDonorName").value = this.getAttribute("data-donor-name");
        document.getElementById("updateEmail").value = this.getAttribute("data-email");
        document.getElementById("updatePhone").value = this.getAttribute("data-phone");
        document.getElementById("updateBankName").value = this.getAttribute("data-bank-name");
        document.getElementById("updateAccountNumber").value = this.getAttribute("data-account-number");
        document.getElementById("updateIban").value = this.getAttribute("data-iban");
        document.getElementById("updateAmount").value = this.getAttribute("data-amount");

        // Afficher le modal
        updateModal.show();
      });
    });
  });
</script>


    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="assets/libs/flot/excanvas.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>


   
</body>
</html>