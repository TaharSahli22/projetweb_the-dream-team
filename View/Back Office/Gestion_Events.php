<?php
 include '../../Controller/EvenementsC.php';


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
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Gestion_Events.html" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Events</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">E-shop</span></a></li>
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
                                                <th>Name</th>
                                                <th>Last Name</th>
                                                <th>Event chosen</th>
                                                <th>Nationality</th>
                                                <th>Date of Event</th>
                                                <th>Luagage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Mohsen</td>
                                                <td> Ben Saleh</td>
                                                <td>Rome Cathedral</td>
                                                <td>Tunisian</td>
                                                <td>2025/04/25</td>
                                                <td>25Kg</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Last Name</th>
                                                <th>Event chosen</th>
                                                <th>Nationality</th>
                                                <th>Date of Event</th>
                                                <th>Luagage</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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