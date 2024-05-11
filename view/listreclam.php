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
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Reclamation</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Reclamation</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="test.php">Home</a>
						</li>
					</ul>
				</div>
                <a href="sta.php" class="btn-download">
                     <span class="text">Statestic of subject</span>
                </a>
			</div>



			<div class="table-data">
    <div class="table-data order">
        <div class="head">
            <h3>List of reclam</h3>
        </div>
        <table class="table table-hover text-center">
       
            <tbody>
                
                    <table class="table" align="center">
                        <thead>
                            <tr>
                                <th>IdR</th>
                                <th>IdU</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Feedback</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            include '../controller/reclamC.php';
                            $c = new reclamsC();
                            $tab = $c->listreclam();
                            foreach ($tab as $reclam) : ?>
                                <tr>
                                    <td><?= $reclam['idR']; ?></td>
                                    <td><?= $reclam['idU']; ?></td>
                                    <td><?= $reclam['subjectt']; ?></td>
                                    <td><?= $reclam['descriptionn']; ?></td>
                                    <td><?= $reclam['feedback']; ?></td>
                                    <td>
                                        <a href="deletreclam.php?id=<?= $reclam['idR']; ?>">Delete</a>
                                    </td>
                                    <td>
                                        <a href="reponseF.php?id=<?= $reclam['idR']; ?>">Traiter</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <center style="margin-top: 20px;">
                        <form method="POST" action="updatereclam.php">
                            <input type="submit" name="update" value="Update" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">
                        </form>
                    </center>
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