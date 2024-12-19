<?php

include '../../controller/reclamationController.php';


$error = "";
$reclamation=null;


$reclamationController = new ReclamationController();
session_start();



    if (isset($_POST["nom"]) && $_POST["prenom"] && $_POST["telephone"] &&
        $_POST["email"] && $_POST["dates"] && $_POST["messages"])
     {
        if (
            !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["telephone"]) &&
            !empty($_POST["email"]) && !empty($_POST["dates"]) && !empty($_POST["messages"])
        ) {
            if (!empty($_POST['recordedVoice'])) {
                $audio_data = $_POST['recordedVoice'];
                $audio_data = explode(',', $audio_data);
                $decoded_audio = base64_decode($audio_data[1]);
                
                $voice_file_path = '../../uploads/voice/' . uniqid() . '.wav';
                if (!is_dir('uploads/voice')) {
                    mkdir('uploads/voice', 0777, true);
                }file_put_contents($voice_file_path, $decoded_audio);
        
            }
            $reclamation = new reclamation(
                NULL,
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['telephone'],
                $_POST['email'],
                new DateTime($_POST['dates']), 
                $_POST['messages'],
                $voice_file_path
            );

           
            $reclamationController->addReclamation($reclamation);

            header('Location:../backoffice/reclamationback.php');
            
           
        } else {
            $error = "Veuillez remplir tous les champs.";
            
        }
    }

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
                        <div class="dropdown">
                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown"><small><i class="fa fa-home text-primary me-2"></i> My Dashboard</small></a>
                            <div class="dropdown-menu rounded">
                                <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> <?php echo htmlspecialchars($_SESSION['user_nom']); ?></a>
                                <a href="../BackOffice/logout.php" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <a href="sig_in.php"><small class="me-3 text-dark"><i class="fa fa-user text-primary me-2"></i>Register</small></a>
                        <a href="../BackOffice/log_in.php"><small class="me-3 text-dark"><i class="fa fa-sign-in-alt text-primary me-2"></i>Login</small></a>
                        <?php } ?>
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
                    <img src="img/logo.jpg" alt="Logo">
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
                    <a href="event.php" class="nav-item nav-link">Event</a>
                    <a href="eshop.php" class="nav-item nav-link">E-shop</a>
                    <a href="blogtem.php" class="nav-item nav-link">Blogs</a>
                    <a href="monument.php" class="nav-item nav-link">Donation</a>
                  <a href="" class="nav-item nav-link active">Contact Us</a>
              </div>
              <?php if(empty($_SESSION['user_nom'])){ ?>
                    <a href="sig_in.php" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Get Started</a>
                    <?php }?>
                  </div>
      </nav>
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
      <div class="container text-center py-5" style="max-width: 900px;">
          <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h4>  
      </div>
  </div>
            <!-- Header End -->
        </div>
        <!-- Navbar & Hero End -->
        <!-- Contact Start -->
<div class="container-fluid contact py-5">
  <div class="container py-5">
      <div class="row g-5">
          <div class="col-xl-6">
              <div class="wow fadeInUp" data-wow-delay="0.2s">
                  <div class="bg-light rounded p-5 mb-5">
                      <h4 class="text-primary mb-4">Get in Touch</h4>
                      <div class="row g-4">
                          <div class="col-md-6">
                              <div class="contact-add-item">
                                  <div class="contact-icon text-primary mb-4">
                                      <i class="fas fa-map-marker-alt fa-2x"></i>
                                  </div>
                                  <div>
                                      <h4>Address</h4>
                                      <p class="mb-0">123rue andre ampere.la gazelle</p>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="contact-add-item">
                                  <div class="contact-icon text-primary mb-4">
                                      <i class="fas fa-envelope fa-2x"></i>
                                  </div>
                                  <div>
                                      <h4>Mail Us</h4>
                                      <p class="mb-0">terradicultura@gmail.com</p>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="contact-add-item">
                                  <div class="contact-icon text-primary mb-4">
                                      <i class="fa fa-phone-alt fa-2x"></i>
                                  </div>
                                  <div>
                                      <h4>Telephone</h4>
                                      <p class="mb-0">(+216) 34567890</p>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="contact-add-item">
                                  <div class="contact-icon text-primary mb-4">
                                      <i class="fab fa-firefox-browser fa-2x"></i>
                                  </div>
                                  <div>
                                      <h4>terradicultura@gmail.com</h4>
                                      <p class="mb-0">(+216) 34567890</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
        
                  <div class="bg-light p-5 rounded h-100 wow fadeInUp" data-wow-delay="0.2s" >
                      <h4 class="text-primary">Send Your Message</h4>
                      <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a class="text-primary fw-bold" href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                      <form id="addreclamationForm" action="" method="POST" >
                          <div class="row g-4">
                              <div class="col-lg-12 col-xl-6">
                                  <div class="form-floating">
                                      <input type="text" class="form-control border-0" id="nom" name="nom" placeholder="ton nom">
                                      <label for="nom">nom</label>
                                      <span id="nom_error"></span><br>
                                  </div>
                              </div>
                              <div class="col-lg-12 col-xl-6">
                                  <div class="form-floating">
                                      <input type="text" class="form-control border-0" id="prenom" name="prenom" placeholder="ton prenom">
                                      <label for="prenom"> prenom</label>
                                      <span id="prenom_error"></span><br>
                                  </div>
                              </div>
                              <div class="col-lg-12 col-xl-6">
                                  <div class="form-floating">
                                      <input type="telephone" class="form-control border-0" id="telephone" name="telephone" placeholder="ton telephone">
                                      <label for="telephone">telephone</label>
                                      <span id="telephone_error"></span><br>
                                  </div>
                              </div>
                              <div class="col-lg-12 col-xl-6">
                                  <div class="form-floating">
                                      <input type="email" class="form-control border-0" id="email"  name="email" placeholder="Your Email">
                                      <label for="email">Your Email</label>
                                      <span id="email_error"></span><br>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-floating">
                                      <input type="date" class="form-control border-0" id="dates" name="dates" placeholder="dates">
                                      <label for="dates">date</label>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-floating">
                                      <textarea class="form-control border-0" placeholder="Leave a message here" id="messages"  name="messages" style="height: 160px"></textarea>
                                      <label for="messages">Message</label>
                                      <span id="messages_error"></span><br>
                                  </div>
                               <!-- Audio Recording Controls -->
    <button class="btn btn-primary" type="button" id="recordBtn" onclick="startRecording()">Start Recording</button>
    <button class="btn btn-primary" type="button" id="stopBtn" onclick="stopRecording()" disabled>Stop Recording</button>
    <audio id="audioPlayer" controls></audio>
    
    <input type="hidden" id="recordedVoice" name="recordedVoice">
                              </div>
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
                              <div class="col-12">
                                  <button type="submit" class="btn btn-primary w-100 py-3" onClick="validerFormulaire()" >Send Message</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
              <div class="rounded h-100">
                  <iframe class="rounded h-100 w-100" 
                  style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1694259649153!5m2!1sen!2sbd" 
                  loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- IA Assistant Icon -->
<a href="./chatbot/index.html" target="_blank" id="ia-assistant-icon" class="position-fixed bottom-0 start-50 translate-middle-x m-4">
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
        <script src="reclamtest.js"></script>







<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
  <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
      <div class="row g-5">
          <div class="col-md-6 col-lg-6 col-xl-4">
              <div class="footer-item">
                  <a href="index.html" class="p-0">
                      <h4 class="text-white"><i class="fas fa-search-dollar me-3"></i>tr</h4>
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
                  
                  <a href="#"><i class="fas fa-angle-right me-2"></i> home</a>
                  <a href="#"><i class="fas fa-angle-right me-2"></i> events</a>
                  <a href="#"><i class="fas fa-angle-right me-2"></i> e-shp</a>
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
                      <p class="text-white mb-0">123 rueandre ampere.la gazelle</p>
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
                      <p class="text-white mb-0">terradicultura@gmail.com</p>
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



        
    </body>

</html>