<?php
include '../controller/coursC.php';
include '../config.php';
include '../controller/typecoursC.php';

if(isset($_GET['id'])) {
    // Récupérer et nettoyer l'ID de cours de l'URL
    $idlesson = $_GET['id'];
    $cours = array();

    try {
        // Requête SQL pour récupérer le matiere de la cours en fonction de l'ID
        $sql = "SELECT matiere, nbheure, niveau, idt FROM lessons WHERE idlesson = :idlesson";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idlesson', $idlesson, PDO::PARAM_INT);
        $stmt->execute();

        // Vérifier si la requête a retourné des résultats
        if ($stmt->rowCount() > 0) {
            // Récupérer le matiere de la lessons
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $matiere = $row['matiere'];
            $nbheure = $row['nbheure'];
            $niveau = $row['niveau'];
            $idt = $row['idt'];
        } else {
            // Gérer le cas où aucun matiere n'est trouvé pour l'ID donné
            $matiere = "matiere inconnu";
        }
    } catch(PDOException $e) {
        // En cas d'erreur, afficher un message d'erreur
        echo "Erreur lors de la récupération du cours : " . $e->getMessage();
    }
} else {
    // Gérer le cas où l'ID de lessons n'est pas présent dans l'URL
    $matiere = "ID de cours non spécifié";
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Course</title>
     <!-- Google Web Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="img/4.png" type="image/x-icon">
</head>

<body>
    

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="#">
                <img src="img/4.png" alt="Logo" width="30" height="30" class="d-inline-block align-top me-2"> EduIsland
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="cours.php">Courses</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pages
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item " href="#">Our Team</a></li>
                            
                            <li><a class="dropdown-item " href="# ">tests</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="# ">Contact</a>
                    </li>
                </ul>
                <button class="btn btn-primary d-none d-lg-block ">Join Now <i class="fas fa-arrow-right ms-3 "></i></button>
            </div>
        </div>
    </nav>
    <!-- Header -->
    <div class="container-fluid bg-primary py-5 mb-5" style="max-height: 300px;">
        <!-- Ajout de la propriété style pour définir une hauteur maximale -->
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 text-center">
                    
                    <h1 class="display-3 text-white">Join Course</h1>
                    <!-- Ajout de la classe text-center pour centrer le titre -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent">
                            <li class="breadcrumb-item"><a href="cours.php" class="text-white">Home</a></li>
                            
                            <li class="breadcrumb-item active text-white" aria-current="page">Join Course</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php


?>

   <div class="containeri">
    <form onsubmit="return validateForm()" name="Form" class="join-form" method="POST">
      <h1 class="main-title">Join <?php echo $matiere; ?> Course</h1>
      <div class="cours-info">
        <p><strong>Level:</strong> <?php echo $niveau; ?></p>
        <p><strong>nb hours:</strong> <?php echo $nbheure; ?></p>
      </div>
      <div class="form-group">
        <label for="emailuser">Email:</label>
        <input type="email" id="emailuser" name="emailuser">
        <p id="error-emailuser" style="color:red;"></p>
      </div>
      <div class="form-group">
        <label for="type">Type:</label>
        <select id="type" name="type">
          <option value="">Type of course</option>
          <option value="Live">Live</option>
          <option value="PDF">PDF</option>
        </select>
        <p id="error-type" style="color:red;"></p>
      </div>
      <button type="submit" name="ajouter" class="main-button">Register to Course</button>
    </form>
    
    <?php
    // Vérifier s'il y a un message d'erreur dans l'URL
    if(isset($_GET['error']) && $_GET['error'] == true) {
        $errorMessage = urldecode($_GET['message']);
        // Afficher le message d'erreur
        if ($errorMessage === '1') {
            // Si le message retourné est '1', afficher un message de succès en vert
            echo '<div class="success-message" style="color:green;">Rigstred Successfully!</div>';
        } else {
            // Sinon, afficher le message d'erreur en rouge
            echo '<div class="error-message" style="color:red;">' . $errorMessage . '</div>';
        }
    }
    
    ?>
    
  </div>
  

  <script src="js/script.js"></script>
  <!-- Footer -->
    <!-- Insérez ici le contenu de la section "Footer " de la template -->
    <footer class="container-fluid bg-dark text-light pt-5 mt-5 wow fadeIn " data-wow-delay="0.1s ">
       
        <!-- Back to Top -->
        <a href="# " class="btn btn-lg btn-primary btn-lg-square back-to-top "><i class="bi bi-arrow-up "></i></a>
    </footer>
</body>

</html>
