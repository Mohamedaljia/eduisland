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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    
	<!-- My CSS -->
	<link rel="stylesheet" href="asset/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
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
                <a href="listUser.php">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">Forum</span>
                </a>
            </li>
            <li>
                <a href="add-collab.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">Collaborators</span>
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
	
			<form action="#">
			
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="asset/img/ena">
			</a>
		</nav>
		<!-- NAVBAR -->

	<!-- MAIN -->
<main style="text-align: center;">
    <div class="head-title">
        <div class="left">
            <h1>Collaborators</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Update of Reponses</a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a class="active" href="#">Home</a>
                </li>
            </ul>
        </div>
        <a href="listeReponse.php" class="btn-download">
					<span class="text">Back to list Reponses</span>
				</a>
    </div>

    <div class="table-data" style="margin: auto; width: 50%; text-align: left;"> <!-- Centering the table and adjusting width -->
        <div class="order">
            <div class="head">
                <h3>Reclamation Form</h3>
                <i class='bx bx-search' ></i>
                <i class='bx bx-filter' ></i>
            </div>
            <form id="reponseForm" method="POST">
            <div class="mb-3">
                <label for="reponseId" class="form-label">reponse ID</label>
                <input type="text" class="form-control" id="idRP" name="idRP"style="margin-left: auto; margin-right: auto; display: block;">
                <span class="error" id="erreuridRP"></span>
            </div>
          
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="descP" name="descP" rows="3" style="margin-left: auto; margin-right: auto; display: block; "></textarea>
                <span class="error" id="erreurdescP"></span>
            </div>
            <button type="submit" class="btn-save" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">Save</button> <!-- Modified here -->        </form>
        </div>
       
    </div>
</main>
<!-- MAIN -->



	</section>
	<!-- CONTENT -->
	

	<script src="asset/java/script.js"></script>
    
</body>
</html>

