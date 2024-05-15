<?php
// Enable error reporting to display PHP errors or warnings
include '../controller/Role.php';
include '../model/Role.php';

$rolC = new Role(); // Instantiate the corrected class name

// Fetch all idRP values from the reponse table
$idRPs =$rolC->getAllIdRoles();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_role']) && isset($_POST['search'])) {
        $id_role = $_POST['id_role']; // Get the selected idRP from the form
        $users = $rolC->afficheRole($id_role); // Fetch reclams based on selected idRP
    }
}

$error = "";

// create client
$roles= null;

// create an instance of the controller
$RoleC = new Role();
if (
    isset($_POST["id_role"]) &&
    isset($_POST["type"]) 
) {
    echo "Form submitted!"; // Debugging message

    if (
        !empty($_POST['id_role']) &&
        !empty($_POST["type"]) 

    ) {
        echo "All fields filled!"; // Debugging message
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }

        $roles = new RoleC(
            $_POST['id_role'],
            $_POST['type']

        );
        try {
            // Add Exams to database
            $RoleC->addRoleC($roles);
            // Redirect to listExams.php after successful addition
            header('Location: addRole.php');
            exit(); // Ensure no further code execution after redirection
        } catch (Exception $e) {
            $error = "Error adding role: " . $e->getMessage();
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
    <a href="../index.html" class="brand">
    <img src="4.png" alt=" Logo" class="logo">
      <span class="text"><i class=""></i>EDUISLAND</span>
    </a>

		<ul class="side-menu top">
            <li>
                <a href="test.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li  class="active">
                <a href="listUser.php">
                    <i class='bx bxs-user'></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li>
            <a href="addExams.php">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">EXAMS</span>
                </a>
            </li>
            <li>
                <a href="add-collab.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">Certificate</span>
                </a>
            </li>
            <li>
                <a href="backoff/index.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">Course</span>
                </a>
            </li>
            
           
           
            <li>
                <a href="listreclam.php">
                    <i class='bx bxs-megaphone'></i>
                    <span class="text">Reclamation</span>
                </a>
            </li>
            <li >
            <a href="backoff/index1.php">
                <i class='bx bxs-dashboard'></i>
                <span class="text">partenaire</span>
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
                <a href="listRole.php" class="btn-download">
                    
                    <span class="text">liste de Roles  </span>
                </a>
			</div>



			<div class="table-data">
    <div class="table-data order">
     
  
<table class="table" align="center">
    <tbody>
<div class="table-data" style="margin: auto; width: 60%; text-align: left;">
    <div class="container" style="margin: auto; width: 60%; text-align: left;">
        <div class="head" style="color: #3C7AE9;">
            <h3>Add Roles </h3>
            <i class='bx bx-plus'></i>
            <i class='bx bx-filter'></i>
        </div>
        <form id="RoleForm" method="POST"> <!-- Ensure you specify the method as POST -->
            <div class="mb-3">
                <label for="roleId_Role" class="form-label">Id_Role</label>
                <input type="text" class="form-control" id="id_role" name="id_role" style="margin-left: auto; margin-right: auto; display: block;"> <!-- Modified here -->
                <span class="error" id="erreuridRP"></span>
            </div>
            <div class="mb-3">
                <label for="roleType" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" name="type" style="margin-left: auto; margin-right: auto; display: block;"> <!-- Modified here -->
            </div>
            <input type="submit" value="Save" style="display: block; margin: 20px auto 0; background-color: #3C7AE9; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">
        </form>
    </div>
</div>
<div class="container mt-5" style="margin: auto; width: 80%; text-align: left;">
        <h4 class="mb-4" style="color: #2B67D0;">Recherche de user par role !</h4>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="idRP" class="form-label">Sélectionnez un role d'occupation :</label>
                <select name="id_role" id="id_role" class="form-select" style="margin: auto; width: 5%;border: none; border-radius: 5px;">
                    <?php
                    // Output the idRP options
                    foreach ($idRPs as $id_role) {
                        echo '<option value="' . $id_role . '">' . $id_role . '</option>';
                    }
                    ?>
                </select>
            </div>
            <input type="submit" value="Rechercher" name="search" class="btn btn-primary" style="background-color: #3C7AE9; color: #fff; padding: 10px 20px; border: none; border-radius: 5px;">
        </form>
        <?php if (isset($users)) { ?>
    <div class="mt-5">
        <div class="table-responsive">
            <table class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="color: #2B67D0; font-weight: normal;">ID user</th>
                        <th style="color: #2B67D0; font-weight: normal;">Nom</th>
                        <th style="color: #2B67D0; font-weight: normal;">Prénom</th>
                        <th style="color: #2B67D0; font-weight: normal;">Email</th>
                        <th style="color: #2B67D0; font-weight: normal;">Occupation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $User) { ?>
                        <tr>
                            <td><?= $User['id'] ?></td>
                            <td><?= $User['nom'] ?></td>
                            <td><?= $User['prenom'] ?></td>
                            <td><?= $User['email'] ?></td>
                            <td>
                                <?php
                                if ($User['occupation'] == 1) {
                                    echo 'Prof';
                                } elseif ($User['occupation'] == 2) {
                                    echo 'Etudiant';
                                } else {
                                    echo 'Autre';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>

    </div>

    <script src="asset/java/script.js"></script>

</body>

</html>
