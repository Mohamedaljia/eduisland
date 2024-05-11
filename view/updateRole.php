<?php
include '../Controller/Role.php';
include '../model/Role.php';
$error = "";
// create role
$rols = null;
// Création d'une instance du contrôleur
$RoleM = new Role();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["id_role"]) &&
        isset($_POST["type"])
    ) {
        if (
            !empty($_POST['id_role'])&&
            !empty($_POST["type"])
        ) {

            foreach ($_POST as $key => $value) {
                echo "Key: $key, Value: $value<br>";
            }
            $rols = new RoleC(
                null,
                $_POST['type']
            );
            var_dump($rols);
            $RoleM->updateRoleC($rols,$_POST['id_role']); // Utilisez id_user pour l'ID à mettre à jour

            header('Location: listRole.php');
            //exit(); // Assurez-vous de quitter le script après la redirection
        }  else 
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
            <li class="active">
                <a href="listUser.php">
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
                <a href="#">
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
            <h1>Roles</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Update Roles</a>
                </li>
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a class="active" href="#">Home</a>
                </li>
            </ul>
        </div>
        <a href="listRole.php" class="btn-download">
					<span class="text">Back to list Roles</span>
				</a>
    </div>

<div class="table-data" style="margin: auto; width: 50%; text-align: left;"> <!-- Centering the table and adjusting width -->
    <div class="order">
        <div class="head">
            <h3>Update Role</h3>
            <i class='bx bx-search' ></i>
            <i class='bx bx-filter' ></i>
        </div>
    <!-- Navbar End -->
    <div class="container">
        <?php
        // Affichage du formulaire avec les données de l'utilisateur à mettre à jour
        if (isset($_POST['id_role'])) {
            $rols = $RoleM->showRoleC($_POST['id_role']);
        ?>
        <form id="RoleForm" method="POST"> <!-- Ensure you specify the method as POST -->
                <div class="mb-3">
                <label for="id_role" class="form-label">Id role</label>
                <input type="text" class="form-control" id="id_role" name="id_role" value="<?php echo $_POST['id_role'] ?>" style="margin-left: auto; margin-right: auto; display: block;">
                <span id="erreurNom" style="color: red"></span>
                </div>
                <div class="mb-3 row">
                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                    
                        <input type="text" class="form-control" id="type" name="type" style="margin-left: auto; margin-right: auto; display: block;">
                        <span id="erreurnom" style="color: red"></span>
                  
                </div>
               
                <button type="submit" class="btn btn-primary" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">Save</button> 
            </form>
        <?php
       } ?>
    </div>
    <script src="asset/java/script.js"></script>

</body>

</html>
