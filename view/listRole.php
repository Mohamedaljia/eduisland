

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
    <thead>
        <tr>
            <th>IdRP</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php 
include "../controller/Role.php";

$c = new Role();
$tab = $c->listRoleC();

?>


<table border="1" align="center" width="70%">
    <tr>
        <th>Id Role</th>
        <th>Type</th>
        <th></th>
    </tr>

    <?php
    foreach ($tab as $Role) {
    ?>

        <tr>
            <td><?= $Role['id_role']; ?></td>
            <td><?= $Role['type']; ?></td>
            <td align="center">
                <form method="POST" action="updateRole.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value="<?php echo $Role['id_role']; ?>" name="id_role">
                </form>
                <a href="deleteRole.php?id_role=<?php echo $Role['id_role']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>


<center style="margin-top: 20px;">
        <form method="POST" action="updateRole.php">
            <input type="submit" name="update" value="Update" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">
        </form>
    </center>

    </div>
     </div>
                                    
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="asset/java/script.js"></script>
    
</body>

</html>