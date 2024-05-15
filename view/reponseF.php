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

//ajouter d'une reponse

$error = "";

// create client
$reponses = null;

// create an instance of the controller
$reponseC = new ReponsesC();
if (
    isset($_POST["idRP"]) &&
    isset($_POST["descP"])
 
) {
    //echo "Form submitted!"; // Debugging message

    if (
        !empty($_POST['idRP']) &&
        !empty($_POST["descP"]) 
    ) {
       // echo "All fields filled!"; // Debugging message
        foreach ($_POST as $key => $value) {
           // echo "Key: $key, Value: $value<br>";
        }

        $reponses = new reponseC(
            
            $_POST['idRP'],
            $_POST['descP']
        );
        try {
            // Add Exams to database
            $reponseC->addreponse($reponses);
            header('Location: reponseF.php');
            exit(); // Ensure no further code execution after redirection
        } catch (Exception $e) {
            $error = "Error adding reclam: " . $e->getMessage();
           // echo $error; // Display error message for debugging
        }
    } else {
        $error = "Missing information";
        echo "Missing information!<br>"; // Debugging message
    }

}
// fin d'ajout de reponse 
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    
	<!-- My CSS -->
	<link rel="stylesheet" href="asset/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    /* Custom Styles */
    .footer-links {
        margin-top: 50px;
    }

    .footer-links a {
        display: block;
        margin-bottom: 10px;
        font-size: 18px;
        color: #333;
    }

    .error {
        color: #B22323;
    }
    </style>
</head>
<body>
<div id="overlay"></div>

	<!-- SIDEBAR -->
	<section id="sidebar">
    <a href="../index.html" class="brand">
    <img src="4.png" alt=" Logo" class="logo">
      <span class="text"><i class=""></i>EDUISLAND</span>
    </a>

		<ul class="side-menu top">
            <li >
                <a href="test.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="listUser.php">
                    <i class='bx bxs-user'></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li>
            <a href="listExams.php">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">EXAMS</span>
                </a>
            </li>
          
            
            <li>
                <a href="backoff/index.php">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">Course</span>
                </a>
            </li>
            
           
           
            <li class="active">
                <a href="listreclam.php">
                    <i class='bx bxs-megaphone'></i>
                    <span class="text">Reclamation</span>
                </a>
            </li>
            <li>
                <a href="backoff/index1.php">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Partenaire</span>
                </a>
            </li>
        </ul>
<ul class="side-menu">
    <li>
        <a href="#">
            <i class='bx bxs-cog'></i>
            <span class="text">Settings</span>
        </a>
    </li>
    <li>
        <a href="#" class="logout">
            <i class='bx bxs-log-out-circle'></i>
            <span class="text">Logout</span>
        </a>
    </li>
</ul>

	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
		</nav>
		<!-- NAVBAR -->


	<!-- MAIN -->
    <main style="text-align: center;">
    <div class="head-title">
        <div class="left" style="color: #3C7AE9;">
            <h1>Traiter</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#" >Add Reponses </a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a class="active" href="#" style="color: #3C7AE9;">Home</a>
                </li>
            </ul>
        </div>
        <a href="listeReponse.php" class="btn-download">
            <span class="text" >List of Reponses </span>
        </a>
    </div>



<div class="table-data">
<div class="table-data order">
<table class="table" align="center">
    <tbody>



    <div class="table-data" style="margin: auto; width: 60%; text-align: left;">
        <div class="container" style="margin: auto; width: 60%; text-align: left;">
            <div class="head" style="color: #3C7AE9;">
                <h3>Traiter les reclamtion</h3>
                <i class='bx bx-plus'></i>
                <i class='bx bx-filter'></i>
            </div>
            <form id="reponseForm" method="POST">
                <div class="mb-3">
                    <label for="reponseId" class="form-label" >reponse ID</label>
                    <input type="text" class="form-control" id="idRP" name="idRP" style="margin-left: auto; margin-right: auto; display: block;">
                    <span class="error" id="erreuridRP"></span>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label" >Description</label>
                    <textarea class="form-control" id="descP" name="descP" rows="3" style="margin-left: auto; margin-right: auto; display: block;"></textarea>
                    <span class="error" id="erreurdescP"></span>
                </div>
                <input type="submit" value="Save" style="display: block; margin: 20px auto 0; background-color: #3C7AE9; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">
            </form>
        </div>
    </div>

    <div class="container mt-5" style="margin: auto; width: 80%; text-align: left;">
        <div class="head" style="color: #3C7AE9;">
            <h3>Search</h3>
            <i class='bx bx-search'></i>
                <i class='bx bx-filter'></i>
        </div>
        <div class="container mt-5" style="margin: auto; width: 80%; text-align: left;">
            <h4 class="mb-4"style="color: #2B67D0;">Recherche de réclamation par réponse !</h4>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="idRP" class="form-label" >Sélectionnez un identifiant de réponse :</label>
                    <select name="idRP" id="idRP" class="form-select"  style="margin: auto; width: 5%;border: none; border-radius: 5px;">
                        <?php
                        // Output the idRP options
                        foreach ($idRPs as $idRP) {
                            echo '<option value="' . $idRP . '">' . $idRP . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" value="Rechercher" name="search" class="btn btn-primary" style="background-color: #3C7AE9; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">
            </form>
            <?php if (isset($reclams)) { ?>
                <div class="mt-5">
  
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%;">
                        <h2 style="color: #2B67D0;">Réclamations correspondantes :</h2>
                            <thead>
                                <tr>
                                <th style="color: #2B67D0; font-weight: normal;">ID Réclamation</th>
                                <th style="color: #2B67D0; font-weight: normal;">ID Utilisateur</th>
                                <th style="color: #2B67D0; font-weight: normal;">Sujet</th>
                                <th style="color:#2B67D0; font-weight: normal;">Description</th>
                                <th style="color: #2B67D0; font-weight: normal;">Feedback</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reclams as $reclam) { ?>
                                    <tr>
                                        <td><?= $reclam['idR'] ?></td>
                                        <td><?= $reclam['idU'] ?></td>
                                        <td><?= $reclam['subjectt'] ?></td>
                                        <td><?= $reclam['descriptionn'] ?></td>
                                        <td><?= $reclam['feedback'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>


	<!-- CONTENT -->
    <script>
        document.getElementById('reponseForm').addEventListener('submit', function(event) {
            var idRP = document.getElementById('idRP').value.trim();
            var descP = document.getElementById('descP').value.trim();

            // Clear previous error messages
            document.getElementById("erreuridRP").innerHTML = '';
            document.getElementById("erreurdescP").innerHTML = '';

            // Regular expressions for validation
            var idRPRegex = /^\d+$/;
            var descPRegex = /^.{1,500}$/;

            // Validation for idRP
            if (!/^\d+$/.test(idRP)) {
                event.preventDefault();
                document.getElementById("erreuridRP").innerHTML = "ID must be a number.";
            }

            // Validation for descP length
            if (!descPRegex.test(descP)) {
            event.preventDefault();
            document.getElementById("erreurdescP").innerHTML = "Description must have between 1 and 500 characters";
        }
        });
    </script>

	<script src="asset/java/script.js"></script>
    
</body>
</html>