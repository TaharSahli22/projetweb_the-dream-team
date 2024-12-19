<?php
 include '../../Controller/EvenementsC.php';
 include '../../Controller/ReservationsC.php';
 $reservationC = new ReservationC();
 $reservations = $reservationC->getAllReservations();

 $error = "";

 $event= null;
 $evenementsC = new evenementsC();

 if (
    isset($_POST["Nomevenement"])  && $_POST["Lieuevenement"] && $_POST["Dateevenement"]  && $_POST["Prixevenement"] && $_POST["Placedisponible"] 
) {
    if (
        !empty($_POST["Nomevenement"])  && !empty($_POST["Lieuevenement"])  && !empty($_POST["Dateevenement"]) && !empty($_POST["Prixevenement"]) && !empty($_POST["Placedisponible"])
        ) {
            $event = new Evenements(
                null,
                $_POST['Nomevenement'],
                $_POST['Lieuevenement'],
                $_POST['Dateevenement'],
                $_POST['Prixevenement'],
                $_POST['Placedisponible'],
            );
            //
                
            $evenementsC->addEvent($event);
    
           
        } else
            $error = "Missing information";
    }
    $events = $evenementsC->getAllEvents();
?>




<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gestion Events - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
    
    
    
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
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
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
                                <a class="dropdown-item" href="reportedlist.php">reports</a>
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
                                                        <h5 class="m-b-0">Luanch Admin</h5> 
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
                        
                        </li>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Available Events</h5>
                                <div class="btn-group" role="group" aria-label="Event Actions">
                                        <button type="button" class="btn btn-primary" onclick="showAddEventModal()">Add Event</button>
                                </div>
                            </div>
                            <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Name</th>
                                      <th scope="col">Location</th>
                                      <th scope="col">Date evenement</th>
                                      <th scope="col">Prix Evenemment</th>
                                      <th scope="col">Places Available</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                        foreach ($events as $event) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($event['Nomevenement']) . "</td>";
                            echo "<td>" . htmlspecialchars($event['Lieuevenement']) . "</td>";
                            echo "<td>" . htmlspecialchars($event['Dateevenement']) . "</td>";
                            echo "<td>" . htmlspecialchars($event['Prixevenement']) . "$</td>";
                            echo "<td>" . htmlspecialchars($event['Placedisponible']) . "</td>";
                            echo '<td><button class="btn btn-primary" onclick="openEditEventModal(' . htmlspecialchars($event['Idevenement']) . ')">Modify</button>';
                            echo '<td><button class="btn btn-danger" onclick="deleteEvent(' . htmlspecialchars($event['Idevenement']) . ')">Delete</button></td>';
                            echo "</tr>";
                        }
                        ?>
                                  </tbody>
                            </table>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Events Booked</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Cin</th>
                                                <th>Evenement choisi</th>
                                                <th>Date de l'evenement</th>
                                                <th>Date de la Reservation</th>
                                                <th>Baggage</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($reservations as $reservation): ?>
    <tr>
        <td><?= htmlspecialchars($reservation['Nom']) ?></td>
        <td><?= htmlspecialchars($reservation['Prenom']) ?></td>
        <td><?= htmlspecialchars($reservation['CIN']) ?></td>
        <td><?= htmlspecialchars($reservation['eventname']) ?></td>
        <td><?= htmlspecialchars($reservation['eventdate']) ?></td>
        <td><?= htmlspecialchars($reservation['dateReservation']) ?></td>
        <td><?= htmlspecialchars($reservation['Baggage']) ?>KG</td>
        
        <td>
            <button 
                class="btn btn-danger" 
                onclick="deleteReservation('<?= htmlspecialchars($reservation['CIN']) ?>')">
                Delete
            </button>
        </td>
    </tr>
<?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Cin</th>
                                                <th>Evenement choisi</th>
                                                <th>Date de l'evenement</th>
                                                <th>Date de la Reservation</th>
                                                <th>Baggage</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div id="editEventModal" style="display:none;">
    <div class="modal-content">
        <h2>Edit Event</h2>
        <form id="editEventForm">
            <input type="hidden" id="editEventId" name="editEventId" />
            <label for="editEventName">Event Name:</label>
            <input type="text" id="editEventName" name="editEventName" required />
            
            <label for="editEventLocation">Event Location:</label>
            <input type="text" id="editEventLocation" name="editEventLocation" required />

            <label for="editEventDate">Event Date:</label>
            <input type="date" id="editEventDate" name="editEventDate" required />

            <label for="editEventPrice">Event Price:</label>
            <input type="number" id="editEventPrice" name="editEventPrice" required />

            <label for="editEventPlaces">Places Available:</label>
            <input type="text" id="editEventPlaces" name="editEventPlaces" required />

            <button type="submit">Save Changes</button>
            <button type="button" onclick="closeEditModal()">Cancel</button>
        </form>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>

            
            </div>
            <div class="modal" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="addEventForm" method="POST" action="path_to_your_php_script.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="eventName">Event Name</label>
            <input type="text" class="form-control" id="eventName" name="Nomevenement" placeholder="Enter event name" required>
        </div>
        <div class="form-group">
            <label for="eventLocation">Location of Event</label>
            <input type="text" class="form-control" id="eventLocation" name="Lieuevenement" placeholder="Enter location" required>
        </div>
        <div class="form-group">
            <label for="eventDate">Date of Event</label>
            <input type="date" class="form-control" id="eventDate" name="Dateevenement" required>
        </div>
        <div class="form-group">
            <label for="eventPrice">Price of Event</label>
            <input type="text" class="form-control" id="eventPrice" name="Prixevenement" placeholder="Enter price" required>
        </div>
        <div class="form-group">
            <label for="eventPlaces">Places Available</label>
            <input type="text" class="form-control" id="eventPlaces" name="Placedisponible" placeholder="Enter number of places" required>
        </div>
        <div class="form-group">
            <label for="eventImage">Event Image</label>
            <input type="file" class="form-control" id="eventimage" name="image" accept="image/*" required>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
    <button type="button" class="btn btn-primary" onclick="submitForm()">Save Event</button>
</div>

            </div>
        </div>
    </div>
</div>

          
            <footer class="footer text-center">
            </footer>
        </div>

    </div>
    <script>
        function showAddEventModal() {
    const modal = document.getElementById('addEventModal');
    modal.style.display = 'block';
}

function closeModal() {
    const modal = document.getElementById('addEventModal');
    modal.style.display = 'none';
}

function validateForm() {
    const eventName = document.getElementById('eventName').value.trim();
    const eventLocation = document.getElementById('eventLocation').value.trim();
    const eventDate = document.getElementById('eventDate').value;
    const eventPrice = document.getElementById('eventPrice').value.trim();
    const eventPlaces = document.getElementById('eventPlaces').value.trim();

    const nameRegex = /^[a-zA-Z0-9 ]{1,50}$/; // Only alphanumeric and spaces, max 50 chars
    const placesRegex = /^\d+\/\d+$/; // Matches "number/number"
    let isValid = true;

    // Clear previous error messages
    clearErrorMessages();

    // Validate Event Name
    if (!nameRegex.test(eventName)) {
        displayErrorMessage('eventName', "Event Name must be between 1 and 50 characters long and contain no special symbols.");
        isValid = false;
    }

    // Validate Event Location
    if (!nameRegex.test(eventLocation)) {
        displayErrorMessage('eventLocation', "Location must be between 1 and 50 characters long and contain no special symbols.");
        isValid = false;
    }

    // Validate Event Date
    const currentDate = new Date();
    const selectedDate = new Date(eventDate);
    if (!eventDate || selectedDate < currentDate) {
        displayErrorMessage('eventDate', "Date of Event must not be before today's date.");
        isValid = false;
    }

    // Validate Event Price
    if (!/^\d+$/.test(eventPrice)) {
        displayErrorMessage('eventPrice', "Price must contain only numeric characters.");
        isValid = false;
    }

    // Validate Places Available
    if (!placesRegex.test(eventPlaces)) {
        displayErrorMessage('eventPlaces', "Places Available must follow the format 'number/number' (e.g., 20/45).");
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

function submitForm() {
    // First, validate the form
    if (validateForm()) {
        // Grab the form data
        const formData = new FormData(document.getElementById('addEventForm'));

        // Use fetch to send data to the server
        fetch('path_to_your_php_script.php', {
            method: 'POST',
            body: formData // This sends the form data to the PHP backend
        })
        .then(response => response.json()) // Assuming the server sends back a JSON response
        .then(data => {
            // Handle the server response
            if (data.success) {
                alert('Event saved successfully!');
                closeModal();  // Close the modal if the event is saved
            } else {
                alert('Error: ' + data.message); // Show error message returned by PHP
            }
        })
        .catch(error => {
            alert('Error: ' + error); // Handle any errors with the request
        });
    }
}
function deleteEvent(eventId) {
    // Confirm the deletion
    if (confirm('Are you sure you want to delete this event?')) {
        // Use fetch to send the delete request to deleteEvent.php
        fetch('deleteEvent.php?id=' + eventId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Event deleted successfully!');
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
function deleteReservation(cin) {
    // Confirm the deletion
    if (confirm('Are you sure you want to delete this reservation?')) {
        // Use fetch to send the delete request to deleteReservation.php
        fetch('deleteReservation.php?CIN=' + cin)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Reservation deleted successfully!');
                    // Reload the page to reflect the change
                    location.reload();
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => {
                alert('Error: ' + error); // Handle any errors
            });
    }
}

    </script>
    <script>
        function openEditEventModal(eventId) {
    // Fetch the event data from the server using the event ID
    fetch('getEventData.php?id=' + eventId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Fill the form fields with the event data
                document.getElementById('editEventId').value = data.event.Idevenement;
                document.getElementById('editEventName').value = data.event.Nomevenement;
                document.getElementById('editEventLocation').value = data.event.Lieuevenement;
                document.getElementById('editEventDate').value = data.event.Dateevenement;
                document.getElementById('editEventPrice').value = data.event.Prixevenement;
                document.getElementById('editEventPlaces').value = data.event.Placedisponible;

                // Show the edit modal
                document.getElementById('editEventModal').style.display = 'block';
            } else {
                alert('Error fetching event data.');
            }
        })
        .catch(error => {
            alert('Error: ' + error);
        });
}

function closeEditModal() {
    document.getElementById('editEventModal').style.display = 'none';
}
document.getElementById('editEventForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(document.getElementById('editEventForm'));

    fetch('updateEvent.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Event updated successfully!');
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