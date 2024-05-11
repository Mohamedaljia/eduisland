<?php
include '../controller/reclamC.php';
include '../model/reclamC.php'; // Update the path to match the location of reclam.php


$error = "";

// Create an instance of the controller
$reclamC = new reclamsC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["idR"]) &&
        isset($_POST["idU"]) &&
        isset($_POST["sub"]) &&
        isset($_POST["typee"]) &&
        isset($_POST["fed"])
    ) {
        if (
            !empty($_POST["idR"]) &&
            !empty($_POST["idU"]) &&
            !empty($_POST["sub"]) &&
            !empty($_POST["typee"]) &&
            !empty($_POST["fed"])
        ) {
            // Fetch form data
            $idR = $_POST["idR"];
            $idU = $_POST["idU"];
            $subject = $_POST["sub"];
            $description = $_POST["typee"];
            $feedback = $_POST["fed"];

            // Create a new Reclam object
            $reclams = new reclamC(null, $idU, $subject, $description,$feedback);

            // Call the update method
            $reclamC->updatereclam($reclams, $idR, $idU);


            header('Location: listreclam.php');
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
        color: red;
    }
</style>
</head>
<body>
<div id="overlay"></div>

	<!-- SIDEBAR -->
	<section id="sidebar">
    <a href="../index.html" class="brand">
      <!-- <img src="asset/img/icon.png" alt="AzulTunes Logo" class="logo">-->
      <span class="text"><i class="fa fa-book me-3"></i>EDUISLAND</span>
    </a>

    <ul class="side-menu top">
        <ul class="side-menu top">
            <li>
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
                <a href="http://localhost/inegration(amjed,lina)/projetWEB/view/addExams.php">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">EXAMS</span>
                </a>
            </li>
            <li>
                <a href="http://localhost/inegration(amjed,lina)/projetWEB/view/addCertif.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">certificate</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Deals</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">Events</span>
                </a>
            </li>
            <li class="active">
                <a href="listreclam.php">
                    <i class='bx bxs-megaphone'></i>
                    <span class="text">Reclamation</span>
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
        <div class="left">
            <h1>Reclamation</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Update of reclamtion</a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a class="active" href="#">Home</a>
                </li>
            </ul>
        </div>
      
    </div>

    <div class="table-data" style="margin: auto; width: 50%; text-align: left;"> <!-- Centering the table and adjusting width -->
        <div class="order">
            <div class="head">
                <h3>Reclamation Form</h3>
                <i class='bx bx-search' ></i>
                <i class='bx bx-filter' ></i>
            </div>
            <form id="reclamationForm" method="POST"> <!-- Ensure you specify the method as POST -->
                <div class="mb-3">
                    <label for="reclamationId" class="form-label">Reclamation ID</label>
                    <input type="text" class="form-control" id="reclamationId" name="idR" style="margin-left: auto; margin-right: auto; display: block;"> <!-- Modified here -->
                </div>
                <div class="mb-3">
                    <label for="userId" class="form-label">User ID</label>
                    <input type="text" class="form-control" id="userId" name="idU" style="margin-left: auto; margin-right: auto; display: block;"> <!-- Modified here -->
                </div>
                <div class="mb-3">
                    <label for="sub" class="form-label">Subject</label>
                    <select class="form-select" id="sub" name="sub" style="margin-left: auto; margin-right: auto; display: block;"> <!-- Modified here -->
                        <option value="cours">Cours</option>
                        <option value="prof">Prof</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea class="form-control" id="desc" name="typee" rows="3" style="margin-left: auto; margin-right: auto; display: block; "></textarea> <!-- Modified here -->
                </div>
                <div class="mb-3">
                    <label for="fed" class="form-label">Feedback</label>
                    <textarea class="form-control" id="fed" name="fed" rows="3" style="margin-left: auto; margin-right: auto; display: block;"></textarea> <!-- Modified here -->
                </div>
                <button type="submit" class="btn-save" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">Save</button> <!-- Modified here -->
            </form>
        </div>
       
    </div>
</main>
<!-- MAIN -->



	</section>
	<!-- CONTENT -->
	
    <script>
        document.getElementById('reclamationForm').addEventListener('submit', function(event) {
            var idR = document.getElementById('idR').value.trim();
            var idU = document.getElementById('idU').value.trim();
            var description = document.getElementById('desc').value.trim();
            var feedback = document.getElementById('fed').value.trim();

            // Clear previous error messages
            document.getElementById("erreurid").innerHTML = '';
            document.getElementById("erreuridu").innerHTML = '';
            document.getElementById("erreurTypee").innerHTML = '';
            document.getElementById("erreurNom").innerHTML = '';

            // Regular expressions for validation
            var idRegex = /^\d+$/;
            var descriptionRegex = /^.{1,500}$/;
            var feedbackRegex = /^.{1,100}$/;

            // Validation for idR
            if (!/^\d+$/.test(idR)) {
                event.preventDefault();
                document.getElementById("erreurid").innerHTML = "ID must be a number.";
            }

            // Validation for idU
            if (!/^\d+$/.test(idU)) {
                event.preventDefault();
                document.getElementById("erreuridu").innerHTML = "ID USER must be a number.";
            }
           
            // Validation for description length
            if (!descriptionRegex.test(desc)) {
                event.preventDefault();
                document.getElementById("erreurTypee").innerHTML = "Description must have fewer than 500 characters";
            }

            // Validation for feedback length
            if (!feedbackRegex.test(fed)) {
                event.preventDefault();
                document.getElementById("erreurNom").innerHTML = "Feedback must have fewer than 100 characters";
            }
        });
    </script>

	<script src="asset/java/script.js"></script>
    
</body>
</html>

