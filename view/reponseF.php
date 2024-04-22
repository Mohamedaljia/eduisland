<?php
require_once "../controller/reponseC.php";
include '../model/reponse.php';

$repC = new ReponsesC(); // Instantiate the corrected class name

// Fetch all idRP values from the reponse table
$idRPs = $repC->getAllIdRPs();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idRP']) && isset($_POST['search'])) {
        $idRP = $_POST['idRP']; // Get the selected idRP from the form
        $reclams = $repC->afficheReclam($idRP); // Fetch reclams based on selected idRP
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Recherche des réclamations</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Custom Styles */
    </style>
</head>

<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <div class="container">
            <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
                <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>EDUISLAND</h2>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto p-4 p-lg-0">
                    <li class="nav-item">
                        <a href="../index.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="../about.html" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="../courses.html" class="nav-link">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a href="../gestion.html" class="nav-link">Exams</a>
                    </li>
                    <li class="nav-item">
                        <a href="../forum.php" class="nav-link">Reclamation</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu fade-down m-0">
                            <a href="../team.html" class="dropdown-item">Our Team</a>
                            <a href="../testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="../404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="../contact.html" class="nav-link">Contact</a>
                    </li>
                </ul>
                <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Join Now<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container mt-5">
    <a href="listreclam.php" class="">Back to list</a>
        <h1 class="mb-4">Recherche de réclamation par réponse !</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="idRP" class="form-label">Sélectionnez un identifiant de réponse :</label>
                <select name="idRP" id="idRP" class="form-select">
                    <?php
                    // Output the idRP options
                    foreach ($idRPs as $idRP) {
                        echo '<option value="' . $idRP . '">' . $idRP . '</option>';
                    }
                    ?>
                </select>
            </div>
            <input type="submit" value="Rechercher" name="search" class="btn btn-primary">
        </form>
        <?php if (isset($reclams)) { ?>
            <div class="mt-5">
                <h2>Réclamations correspondantes :</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Réclamation</th>
                                <th>ID Utilisateur</th>
                                <th>Sujet</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reclams as $reclam) { ?>
                                <tr>
                                    <td><?= $reclam['idR'] ?></td>
                                    <td><?= $reclam['idU'] ?></td>
                                    <td><?= $reclam['subjectt'] ?></td>
                                    <td><?= $reclam['feedback'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
