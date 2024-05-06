<?php
include "../controller/CertifC.php";

$c = new CertifC();
$tab = $c->listcertif();

?>

<!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Statistics on Difficulty Levels</title>
       <!-- Include Chart.js JavaScript library -->
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="asset/css/add.css">
    
   </head>
   <body>
    <!-- SIDEBAR -->
	<section id="sidebar">
    <a href="#" class="brand">
        
        <span class="text">EDUISLAND</span>
    </a>

		<ul class="side-menu top">
            <li class="active">
                <a href="index.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="http://localhost/2a27/view/addExams.php?id=963&search=#">
                    <i class='bx bxs-user'></i>
                    <span class="text">add exam</span>
                </a>
            </li>
            <li>
                <a href="http://localhost/2a27/view/listExams.php">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">list exam</span>
                </a>
            </li>
            <li>
                <a href="http://localhost/2a27/view/addCertif.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">add certif</span>
                </a>
            </li>
            <li>
                <a href="http://localhost/2a27/view/listCertif.php">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">list certif</span>
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
        <main>
        <div class="head-title">
				<div class="left">
					<h1>Collaborators</h1>
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
				<div class="order">
					<div class="head">
						<h3>Add New Collab</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
                    </script>
   </body>
   </html>
<center>
    <h1>List of Certificates</h1>
    <h2>
        <a href="addCertif.php">Add Certificate</a>
    </h2>
</center>
<table border="1" align="center" width="70%" style="border-collapse: collapse; margin-top: 30px;">
    <tr style="background-color: #f2f2f2;">
        <th style="padding: 10px;">Id_certif</th>
        <th style="padding: 10px;">Id_exam</th>
        <th style="padding: 10px;">Date</th>
        <th style="padding: 10px;">Speciality</th>
        <th style="padding: 10px;">Id_etudiant</th>
        <th style="padding: 10px;"></th>

    </tr>

    <?php
    foreach ($tab as $certif) {
    ?>

        <tr style="background-color: #ffffff;">
            <td style="padding: 10px;"><?= $certif['id_certif']; ?></td>
            <td style="padding: 10px;"><?= $certif['id_exam']; ?></td>
            <td style="padding: 10px;"><?= $certif['datee']; ?></td>
            <td style="padding: 10px;"><?= $certif['specialite']; ?></td>
            <td style="padding: 10px;"><?= $certif['id_etudiant']; ?></td>
            <td style="padding: 10px; text-align: center;">
                <form method="POST" action="updateCertif.php">
                    <input type="submit" name="update" value="Update" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">
                    <input type="hidden" value="<?php echo $certif['id_certif']; ?>" name="id_certif">
                </form>
                <a href="deleteCertif.php?id=<?php echo $certif['id_certif']; ?>" style="color: #dc3545; text-decoration: none; margin-left: 5px;">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
