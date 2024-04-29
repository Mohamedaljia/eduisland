<?php
include '../controller/reponseC.php';
include '../model/reponse.php'; // Update the path to match the location of reclam.php


$error = "";

// Create an instance of the controller
$reponseC = new ReponsesC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["idRP"]) &&
         isset($_POST["descP"])
    ) {
        if (
            !empty($_POST['idRP']) &&
            !empty($_POST["descP"]) 
        ) {
            // Fetch form data
            $idRP=$_POST['idRP'];
            $descP=$_POST['descP'];

            // Create a new Reclam object
            $reponses= new reponseC(null,$descP);

            // Call the update method
            $reponseC->updaterep($reponses, $idRP);


            header('Location: listeReponse.php');
            exit;
        } else {
            $error = "Missing information";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reclamation Form</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>


 <!-- Spinner Start -->
 <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>EDUISLAND</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="../index.html" class="nav-item nav-link active">Home</a>
            <a href="../about.html" class="nav-item nav-link">About</a>
            <a href="../courses.html" class="nav-item nav-link">Courses</a>
            <a href="../gestion.html" class="nav-item nav-link active">Exams</a>
            <a href="../reclamation.html" class="nav-item nav-link active">Reclamation</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu fade-down m-0">
                    <a href="../team.html" class="dropdown-item">Our Team</a>
                    <a href="../testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="../404.html" class="dropdown-item">404 Page</a>
                </div>
            </div>
            <a href="../contact.html" class="nav-item nav-link">Contact</a>
        </div>
        <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Join Now<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
<!-- Navbar End -->
<div class="container">
        <h1>Update Reponse</h1>
        <form id="reponseForm" method="POST">
            <div class="mb-3">
                <label for="reponseId" class="form-label">reponse ID</label>
                <input type="text" class="form-control" id="idRP" name="idRP">
                <span class="error" id="erreuridRP"></span>
            </div>
          
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="descP" name="descP" rows="3"></textarea>
                <span class="error" id="erreurdescP"></span>
            </div>
            <input type="submit" value="Save">
        </form>
</div>
<div class="container footer-links">
    <br>
        <a href="listeReponse.php" class="btn btn-primary">liste de reponse</a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
