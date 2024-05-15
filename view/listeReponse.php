

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
                <a href="backoff/index.php">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">Course</span>
                </a>
            </li>
            
           
            
            <li  >
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
					<h1>Reponses</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">liste of Reponses</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="test.php">Home</a>
						</li>
					</ul>
				</div>
                <a href="reponseF.php" class="btn-download">
                    
                    <span class="text">Add Reponses  </span>
                </a>
			</div>



			<div class="table-data">
    <div class="table-data order">
        <div class="head">
            <h3>List of Reponses</h3>
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
        include '../controller/reponseC.php';

        $c = new ReponsesC();
        $tab = $c->afficheRep();
        foreach ($tab as $reponse) : ?>
            <tr>
                <td><?= $reponse['idRP']; ?></td>
                <td><?= $reponse['descP']; ?></td>
                <td>
                    <a href="deleterep.php?id=<?= $reponse['idRP']; ?>">Delete</a>
                </td>
                <td>    </td>
             
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <center style="margin-top: 20px;">
        <form method="POST" action="updatereponse.php">
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