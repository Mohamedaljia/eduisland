<?php
include '../../controler/collabC.php';

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
   
	<title>AdminHub</title>
</head>
<body>
<div id="overlay"></div>

	<!-- SIDEBAR -->
	<section id="sidebar">
    <a href="#" class="brand">
        <img src="asset/img/icon.png" alt="AzulTunes Logo" class="logo">
        <span class="text">AzulTunes</span>
    </a>

		<ul class="side-menu top">
            <li class="active">
                <a href="index.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
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
                    <span class="text">Claims</span>
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
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
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
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>



			<div class="table-data">
    <div class="table-data order">
        <div class="head">
            <h3>List of Collaborators</h3>
        </div>
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>                 
                    <th scope="col">titre</th>
                    <th scope="col">description</th>
                    <th scope="col">date_debut</th>
                    <th scope="col">date_fin</th>
                    <th scope="col">type</th>
                    <th scope="col">contrat</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($collabs as $collab): ?>
                    <tr>                      
                        <td><?php echo $collab['titre']; ?></td>
                        <td><?php echo $collab['description']; ?></td>
                        <td><?php echo $collab['date_debut']; ?></td>
                        <td><?php echo $collab['date_fin']; ?></td>
                        <td><?php echo $collab['type']; ?></td>
                        <td><?php echo $collab['contrat']; ?></td>
                        <td>
                        <button onclick="openModal('<?php echo $collab['id_collaboration']; ?>')" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </button>
                            <!-- Form for updating collaboration -->
                          
                            <div id="myModal_<?php echo $collab['id_collaboration']; ?>" class="modal" style="display: none;">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal('<?php echo $collab['id_collaboration']; ?>')">&times;</span>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id_collaboration" value="<?php echo $collab['id_collaboration']; ?>">
                                        <label for="titre">Titre:</label>
                                        <input type="text" name="titre" value="<?php echo $collab['titre']; ?>"><br>
                                        <label for="description">Description:</label>
                                        <textarea name="description" rows="4" cols="50"><?php echo $collab['description']; ?></textarea><br>
                                        <label for="date_debut">Start date:</label>
                                        <input type="date" name="date_debut" value="<?php echo $collab['date_debut']; ?>"><br>
                                        <label for="date_fin">End date:</label>
                                        <input type="date" name="date_fin" value="<?php echo $collab['date_fin']; ?>"><br>
                                        <label for="type">Type:</label><br>
                                        <select name="type">
                                            <option value="sponsoring" <?php if($collab['type'] == 'sponsoring') echo 'selected'; ?>>Sponsoring</option>
                                            <option value="event" <?php if($collab['type'] == 'event') echo 'selected'; ?>>Event</option>
                                        </select><br>
                                        <label for="contrat" class="custom-file-upload">contrat</label>
                                        <input type="file" id="contrat" name="contrat" value="<?php echo $collab['contrat']; ?>"><br>
                                        <button type="submit" name="submit_update" class="btn btn-primary">Enregistrer</button>
                                    </form>
                                </div>
                            </div>
                            <form action="" method="POST">
                                <input type="hidden" name="id_collaboration" value="<?php echo $collab['id_collaboration']; ?>">
                                <button type="submit" name="submit_delete" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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