<?php
include '../Controller/User.php';
include '../model/User.php';
$error = "";

// create User
$user = null;
// create an instance of the controller
$userController = new User;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (
    
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["mdp"])&&
    isset($_POST["occupation"])

) {
    if (
        
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["mdp"])&&
        !empty($_POST["occupation"])

        
    ) {

        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $user = new UserC(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['mdp'],
            $_POST['occupation']

        );
        var_dump($user);
        $userController->updateUserC($user, $_POST['id']);

        header('Location:listUser.php');
    } else
        $error = "Missing information";

    }
}

// Affichage du reste du code HTML (le formulaire)
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
                <a href="#">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="addUser.php">
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
<main style="text-align: center;">
    <div class="head-title">
        <div class="left">
            <h1>Users</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Update of Users</a>
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
            <h3>User Update</h3>
            <i class='bx bx-search' ></i>
            <i class='bx bx-filter' ></i>
        </div>
    <!-- Navbar End -->

    <div class="container">
        <?php
        // Affichage du formulaire avec les données de l'utilisateur à mettre à jour
        if (isset($_POST['id'])) {
            $user = $userController->showUserC($_POST['id']);
        ?>
            <form id="UserForm" method="POST"> <!-- Ensure you specify the method as POST -->
                <div class="mb-3 row">
                    <label for="userId" class="col-sm-2 col-form-label">Id</label>
                  
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $_POST['id'] ?>" >
                        <span id="erreurNom" style="color: red"></span>
                </div>
                <div class="mb-3 row">
                    <label for="userNom" class="col-sm-2 col-form-label">Nom</label>
                    
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $user['nom'] ?>">
                        <span id="erreurnom" style="color: red"></span>
                  
                </div>
                <div class="mb-3 row">
                    <label for="userPrenom" class="col-sm-2 col-form-label">Prenom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $user['prenom'] ?>">
                        <span id="erreurPrenom" style="color: red"></span>
                   
                </div>
                <div class="mb-3 row">
                    <label for="userEmail" class="col-sm-2 col-form-label">Email</label>
                    
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?>">
                        <span id="erreurEmail" style="color: red"></span>
                   
                </div>
                <div class="mb-3 row">
                    <label for="userMdp" class="col-sm-2 col-form-label">Mdp</label>
                    
                        <input type="password" class="form-control" id="mdp" name="mdp" value="<?php echo $user['mdp'] ?>">
                        <span id="erreurMdp" style="color: red"></span>
                    
                </div>
                <div class="mb-3 row">
                    <label for="userOccupation" class="col-sm-2 col-form-label">Occupation</label>
                    
                        <input type="occupation" class="form-control" id="occupation" name="occupation" value="<?php echo $user['occupation'] ?>">
                        <span id="erreurOccupation" style="color: red"></span>
                    
                </div>
                <button type="submit" class="btn btn-primary">Save</button> 
            <a href="listUser.php" class="btn btn-primary">Back to list</a>
            </form>

        <?php
        } ?>
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
