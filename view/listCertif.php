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
    <<a href="../index.html" class="brand">
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
            <li>
                <a href="listUser.php">
                    <i class='bx bxs-user'></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li  class="active">
                <a href="listExams.php">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">EXAMS</span>
                </a>
            </li>
            <li>
                <a href="readchat.php">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">Chat</span>
                </a>
            </li>
            
            <li>
                <a href="backoff/index.php">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">cours</span>
                </a>
            </li>
            <li>
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
        <a href="login.php" class="logout">
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
        <main>
        <div class="head-title">
				<div class="left">
					<h1>certif</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">certif</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="addCertif.php" class="btn-download">
					<span class="text">addCertif</span>
				</a>
			</div>
        <div class="table-data">
        <div class="table-data order">
					<div class="head">
						<h3>List of certif</h3>
					</div>
            <table class="table table-hover text-center">
                    <tbody>
                    <table class="table" align="center">
                    <thead>
                        <tr>
                            <th >Id_certif</th>
                            <th >Id_exam</th>
                            <th >Date</th>
                            <th >Speciality</th>
                            <th >Id_etudiant</th>
                            <th ></th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($tab as $certif) {
                    ?>

                        <tr>
                            <td><?= $certif['id_certif']; ?></td>
                            <td><?= $certif['id_exam']; ?></td>
                            <td><?= $certif['datee']; ?></td>
                            <td><?= $certif['specialite']; ?></td>
                            <td><?= $certif['id_etudiant']; ?></td>
                           
                            <td> 
                                <a href="deleteCertif.php?id=<?php echo $certif['id_certif']; ?>">Delete</a>
                            </td>
                            <td>
                                <form method="POST" action="updateCertif.php">
                                    <input type="submit" name="update" value="Update"  style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 5px 10px; font-size: 1rem; border: none; border-radius: 3px;">
                                    <input type="hidden" value="<?php echo $certif['id_certif']; ?>" name="id_certif">
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                    </table>
                    </tbody>
                </table>
</script>
   </body>
   </html>