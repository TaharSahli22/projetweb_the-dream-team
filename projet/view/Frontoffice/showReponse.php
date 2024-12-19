<?php
include '../../controller/reclamationController.php';

$reponseC = new ReponseController();


if (isset($_GET['id'])) {
    $id_reclamation = intval($_GET['id']);
    
   
    $reponse = $reponseC->showReponse($id_reclamation);
} else {
    die('ID de réclamation non spécifié.');
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réponses à la Réclamation</title>
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
</head>
<body>
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
                                <a href="inbox.php" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Inbox</a>
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
                    <a href="index.html" class="nav-item nav-link">Home</a>
                    <a href="about.html" class="nav-item nav-link">Event</a>
                    <a href="service.html" class="nav-item nav-link">E-shop</a>
                    <a href="blog.html" class="nav-item nav-link">Blogs</a>
                  <a href="contact.html" class="nav-item nav-link active">Contact Us</a>
              </div>
              <!--<a href="#" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Get Started</a>-->
          </div>
      </nav>
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
      <div class="container text-center py-5" style="max-width: 900px;">
          <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h4>  
      </div>
  </div>

<h1>Réponses à la Réclamation ID: <?php echo htmlspecialchars($id_reclamation); ?></h1>

<?php if ($reponse): ?>
    <table border="1" cellpadding="10" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col">ID Réponse</th>
                <th scope="col">Date de Réponse</th>
                <th scope="col">Réponse</th>
                <th scope="col">rating</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reponse as $reponse): ?>
                <tr>
                <?php
                echo "<td>" . htmlspecialchars($reponse['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($reponse['date_reponse']). "</td>";
                            echo "<td>" . htmlspecialchars($reponse['reponse']) . "</td>";
                            ?>
                            <style>/* From Uiverse.io by SelfMadeSystem */
.rating {
  display: flex;
  flex-direction: row-reverse; /* Affiche les étoiles de droite à gauche */
  gap: 0.3rem; /* Espacement entre les étoiles */
  --stroke: #666; /* Couleur de bordure */
  --fill: #ffc73a; /* Couleur de remplissage (jaune) pour les étoiles sélectionnées */
}

.rating input {
  appearance: unset; /* Enlève le style par défaut des inputs de type radio */
}

.rating label {
  cursor: pointer; /* Change le curseur pour pointer lorsque l'on survole une étoile */
}

.rating svg {
  width: 2rem; /* Taille de l'étoile */
  height: 2rem;
  overflow: visible;
  fill: transparent; /* Remplissage transparent par défaut */
  stroke: var(--stroke); /* Couleur de la bordure des étoiles */
  stroke-linejoin: bevel; /* Style de jointure des bordures */
  stroke-dasharray: 12; /* Crée une bordure en pointillés */
  animation: idle 4s linear infinite; /* Animation de départ */
  transition: stroke 0.2s, fill 0.5s; /* Transition douce pour le changement de couleurs */
}

@keyframes idle {
  from {
    stroke-dashoffset: 24;
  }
}

.rating label:hover svg {
  stroke: var(--fill); /* Changer la couleur des étoiles au survol */
}

.rating input:checked ~ label svg {
  transition: 0s;
  animation: idle 4s linear infinite, yippee 0.75s backwards; /* Animation au clic */
  fill: var(--fill); /* Remplissage jaune pour l'étoile sélectionnée */
  stroke: var(--fill); /* Bordure jaune pour l'étoile sélectionnée */
  stroke-opacity: 0;
  stroke-dasharray: 0;
  stroke-linejoin: miter; /* Change le style de la jointure de la bordure */
  stroke-width: 8px; /* Épaissir la bordure lorsqu'elle est sélectionnée */
}

@keyframes yippee {
  0% {
    transform: scale(1);
    fill: var(--fill);
    fill-opacity: 0;
    stroke-opacity: 1;
    stroke: var(--stroke);
    stroke-dasharray: 10;
    stroke-width: 1px;
    stroke-linejoin: bevel;
  }

  30% {
    transform: scale(0);
    fill: var(--fill);
    fill-opacity: 0;
    stroke-opacity: 1;
    stroke: var(--stroke);
    stroke-dasharray: 10;
    stroke-width: 1px;
    stroke-linejoin: bevel;
  }

  30.1% {
    stroke: var(--fill);
    stroke-dasharray: 0;
    stroke-linejoin: miter;
    stroke-width: 8px;
  }

  60% {
    transform: scale(1.2); /* Agrandissement de l'étoile sélectionnée */
    fill: var(--fill); /* Remplissage jaune de l'étoile sélectionnée */
  }
}


/* Ajoutez cette règle CSS */
.btn-right {
  margin-left: auto; /* Force le bouton à se placer à droite */
  display: block;    /* Fait en sorte que le bouton occupe toute la largeur de son conteneur */
}



</style>

<?php  if($reponse['evaluation']==0){        ?>    
    <td> 
    <form action="rating.php" method="POST">
              <input type="hidden" name="id" value="<?php echo htmlspecialchars($reponse['id']); ?>"> <!-- Réponse -->
              <input type="hidden" name="id_reclamations" value="<?php echo htmlspecialchars($reponse['id_reclamations']); ?>">
     <div class="rating">
        <input type="radio" id="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="5">
        <label for="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="4">
        <label for="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="3" >
        <label for="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="2">
        <label for="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="1">
        <label for="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>
    </div>
    <button type="submit" class="btn btn-primary btn-right">Évaluer</button>
    </form>
    </td>   
    <?php  }       ?>     

    <?php  if($reponse['evaluation']==1){        ?> 
        <td>     
    <form action="rating.php" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($reponse['id']); ?>"> <!-- Réponse -->
    <input type="hidden" name="id_reclamations" value="<?php echo htmlspecialchars($reponse['id_reclamations']); ?>">
     <div class="rating">
        <input type="radio" id="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="5">
        <label for="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="4">
        <label for="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="3" >
        <label for="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="2">
        <label for="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="1"checked>
        <label for="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>
    </div>
    <button type="submit" class="btn btn-primary btn-right">Évaluer</button>
    </form>
    </td>
    <?php  }       ?>      

    <?php  if($reponse['evaluation']==2){        ?>  
        <td>
    <form action="rating.php" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($reponse['id']); ?>"> <!-- Réponse -->
    <input type="hidden" name="id_reclamations" value="<?php echo htmlspecialchars($reponse['id_reclamations']); ?>">
     <div class="rating">
        <input type="radio" id="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="5">
        <label for="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="4">
        <label for="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="3" >
        <label for="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="2"checked>
        <label for="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="1">
        <label for="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>
    </div>
    <button type="submit" class="btn btn-primary btn-right">Évaluer</button>
    </form>
    </td>
    <?php  }       ?>    

    <?php  if($reponse['evaluation']==3){        ?>  
        <td>
    <form action="rating.php" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($reponse['id']); ?>"> <!-- Réponse -->
    <input type="hidden" name="id_reclamations" value="<?php echo htmlspecialchars($reponse['id_reclamations']); ?>">
     <div class="rating">
        <input type="radio" id="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="5">
        <label for="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="4">
        <label for="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="3" checked>
        <label for="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="2">
        <label for="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="1">
        <label for="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>
    </div>
    <button type="submit" class="btn btn-primary btn-right">Évaluer</button>
    </form>
    </td>
    <?php  }       ?>  


    <?php  if($reponse['evaluation']==4){        ?>  
    <td>
    <form action="rating.php" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($reponse['id']); ?>"> <!-- Réponse -->
    <input type="hidden" name="id_reclamations" value="<?php echo htmlspecialchars($reponse['id_reclamations']); ?>">
     <div class="rating">
        <input type="radio" id="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="5">
        <label for="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="4"checked>
        <label for="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="3" >
        <label for="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="2">
        <label for="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

        <input type="radio" id="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="1">
        <label for="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>
    </div>
    <button type="submit" class="btn btn-primary btn-right">Évaluer</button>
    </form>
    </td>
    <?php  }       ?>  



    <?php  if($reponse['evaluation']==5){        ?>  
    <td>
<form action="rating.php" method="POST">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($reponse['id']); ?>"> <!-- Réponse -->
<input type="hidden" name="id_reclamations" value="<?php echo htmlspecialchars($reponse['id_reclamations']); ?>">
 <div class="rating">
    <input type="radio" id="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="5"checked>
    <label for="star-1-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

    <input type="radio" id="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="4">
    <label for="star-2-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

    <input type="radio" id="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="3" >
    <label for="star-3-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

    <input type="radio" id="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="2">
    <label for="star-4-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>

    <input type="radio" id="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>" name="rating_" value="1">
    <label for="star-5-<?php echo htmlspecialchars($reponse['reponse']); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path></svg></label>
</div>
<button type="submit" class="btn btn-primary btn-right" >Évaluer</button>
</form>
</td>
<?php  }       ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucune réponse disponible pour cette réclamation.</p>
<?php endif; ?>

<a href="inbox.php">Retour aux Réclamations</a>




<!-- IA Assistant Icon 
<a href="./chatbot/index.html" target="_blank" id="ia-assistant-icon" class="position-fixed bottom-0 start-50 translate-middle-x m-4">
    <i class="fas fa-robot fa-3x text-primary"></i>
</a>-->
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
</body>
</html>