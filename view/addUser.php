<?php
// Enable error reporting to display PHP errors or warnings
include '../controller/User.php';
include '../model/User.php';
require_once __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
$error = "";

// create client
$userr = null;

// create an instance of the controller
$UserC = new User();
if (
    isset($_POST["id"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["mdp"])&&
    isset($_POST["occupation"])

) {
    echo "Form submitted!"; // Debugging message

    if (
        !empty($_POST['id']) &&
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["mdp"])&&
        !empty($_POST["occupation"])
    ) {
        echo "All fields filled!"; // Debugging message
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }

        $userr = new UserC(
            
            $_POST['id'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['mdp'],
            $_POST['occupation']

        );
        try {
            // Add Exams to database
            $UserC->addUserC($userr);
            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);
 
            // SMTP configuration for Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'amjedchemchik@gmail.com';  // Replace with your Gmail address
            $mail->Password = 'hddg gjyu lljj voll';          // Replace with your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender and recipient settings
            $mail->setFrom('amjedchemchik@gmail.com', 'amjed');
            $mail->addAddress('amjedchemchik1@gmail.com', 'AMJED');

            // Create email body with form data
            $emailBody = '<h3>New USER</h3>' .
                         '<p><strong> id:</strong> ' . $_POST['id'] . '</p>' .
                         '<p><strong>nom :</strong> ' . $_POST['nom'] . '</p>' .
                         '<p><strong>prenom:</strong> ' . $_POST['prenom'] . '</p>' .
                         '<p><strong>email:</strong> ' . $_POST['email'] . '</p>' .
                         '<p><strong>mdp:</strong> ' . $_POST['mdp'] . '</p>' .
                         '<p><strong>occupation:</strong> ' . $_POST['occupation'] . '</p>';

            // Set email content type to HTML
            $mail->isHTML(true);

            // Set email subject
            $mail->Subject = 'New User';

            // Set email body
            $mail->Body = $emailBody;

            // Send email
            $mail->send();
            echo 'Email has been sent successfully';

            // Redirect to listExams.php after successful addition
            header('Location: addUser.php');
            exit(); // Ensure no further code execution after redirection
        } catch (Exception $e) {
            $error = "Error adding user: " . $e->getMessage();
            echo $error; // Display error message for debugging
        }
    } else {
        $error = "Missing information";
        echo "Missing information!<br>"; // Debugging message
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
    <a href="forum.php" class="brand">
      <!-- <img src="asset/img/icon.png" alt="AzulTunes Logo" class="logo">-->
      <span class="text"><i class="fa fa-book me-3"></i>EDUISLAND</span>
    </a>

		<ul class="side-menu top">
            <li class="active">
                <a href="test.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="listRole.php">
                    <i class='bx bxs-user'></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li>
                <a href="#">
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
            <li>
                <a href="#">
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
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Roles</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">list of Roles</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="test.php">Home</a>
						</li>
					</ul>
				</div>
                <a href="addRole.php" class="btn-download">
                    
                    <span class="text">Add Role  </span>
                </a>
			</div>



			<div class="table-data">
    <div class="table-data order">
        <div class="head">
            <h3>List of Roles</h3>
        </div>
       
  
<table class="table" align="center">
    
    <tbody>
    <div class="container">
        <h1>Add User </h1>
        <form id="UserForm" method="POST"> <!-- Ensure you specify the method as POST -->
            <div class="mb-3">
                <label for="userId" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="userNom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom">
            </div>
            <div class="mb-3">
                <label for="userPrenom" class="form-label">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom">
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="userMdp" class="form-label">Mdp</label>
                <input type="password" class="form-control" id="mdp" name="mdp">
            </div>
            <div class="mb-3">
                <label for="occupation" class="form-label">Occupation</label>
                <select class="form-select" id="occupation" name="occupation">
                    <option value="1">Prof</option>
                    <option value="2">Etudiant</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button> 
            <a href="listUser.php" class="btn btn-primary">Back to list</a>
            <a href="addRole.php" class="btn btn-primary">Search the role</a>

        </form>
    </div>
    
    
    <script>
document.getElementById('UserForm').addEventListener('submit', function(event) {
    var id = document.getElementById('id').value.trim();
    var nom = document.getElementById('nom').value.trim();
    var prenom = document.getElementById('prenom').value.trim();
    var email = document.getElementById('email').value.trim();
    var mdp = document.getElementById('mdp').value.trim();
    var occupation = document.getElementById('occupation').value.trim();

    // Clear previous error messages
    document.getElementById("erreurNom").innerHTML = '';
    document.getElementById("erreurnom").innerHTML = '';
    document.getElementById("erreurPrenom").innerHTML = '';
    document.getElementById("erreurEmail").innerHTML = '';
    document.getElementById("erreurMdp").innerHTML = '';
    document.getElementById("erreurOccupation").innerHTML = '';

    // Regular expressions for validation
    var idRegex = /^\d+$/;
    var nameRegex = /^[a-zA-Z\s]*$/;
    var emailRegex = /\S+@\S+\.\S+/;

    // Validation for id
    if (!idRegex.test(id)) {
        event.preventDefault();
        document.getElementById("erreurNom").innerHTML = "ID must be a number.";
    }

    // Validation for nom
    if (!nameRegex.test(nom)) {
        event.preventDefault();
        document.getElementById("erreurnom").innerHTML = "Nom must contain only letters and spaces.";
    }

    // Validation for prenom
    if (!nameRegex.test(prenom)) {
        event.preventDefault();
        document.getElementById("erreurPrenom").innerHTML = "Prenom must contain only letters and spaces.";
    }

    // Validation for email
    if (!emailRegex.test(email)) {
        event.preventDefault();
        document.getElementById("erreurEmail").innerHTML = "Invalid email format.";
    }

    // Validation for mdp (password)
    if (mdp.length < 6) {
        event.preventDefault();
        document.getElementById("erreurMdp").innerHTML = "Password must be at least 6 characters long.";
    }

    // Validation for occupation
    if (!nameRegex.test(occupation)) {
        event.preventDefault();
        document.getElementById("erreurOccupation").innerHTML = "Occupation must contain only letters and spaces.";
    }
});
</script>


    <script src="asset/java/script.js"></script>

</body>

</html>
