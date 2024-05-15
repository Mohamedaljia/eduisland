<?php
    include "../controller/ExamsC.php";

    $c = new ExamsC();
    $tab = $c->listExams();
    //$statistiques = $c->statistiqueParNiveau();
   //$totalExams = array_sum(array_column($statistiques, 'nombre_certificats'));
   $reclamationsByType = $c->countReclamationsByType();

   // Extracting labels, data, and colors from the result
   $labels = [];
   $data = [];
   $colors = [];
   
   foreach ($reclamationsByType as $reclamation) {
       $labels[] = $reclamation['niveau'];
       $data[] = $reclamation['count'];
       $colors[] = getNiveauColor($reclamation['niveau']);
   }
   
   // Function to get color based on difficulty level
   function getNiveauColor($niveau)
   {
       // Define colors for each niveau
       $colors = [
           1 => ['#8E44AD', 'Orange'], // Easy: Orange
           2 => ['#F1948A', 'Green'], // Medium: Green
           3 => ['#3362FF', 'Blue']  // Hard: Blue
       ];
   
       // Return the color based on niveau
       return $colors[$niveau];
   }
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
    <a href="../index.html" class="brand">
       <img src="4.png" alt=" Logo" class="logo">
      <span class="text"><i class=""></i>EDUISLAND</span>
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
                <a href="index.php">
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
				
                <ul class="breadcrumb">
                    <a href="addExams.php" class="btn-download">
                        
                        <span class="text">ADD Exams</span>
                    </a>
                    <br>
                    <a href="listCertif.php" class="btn-download">
                        
                        <span class="text">list Certificat</span>
                    </a>
                </ul>
			</div>
            <div class="table-data">
				<div class="order">
					<div class="head">
						
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
       <!-- Div to display the chart -->
       <div style="width: 600px; height: 400px;">
           <canvas id="difficultyChart"></canvas>
       </div>
   
     <!-- Div to display the chart -->
   <div class="chart-container">
       <div class="chart">
           <?php
           $startAngle = 0;
           foreach ($reclamationsByType as $key => $reclamation) {
               $percentage = round(($reclamation['count'] / array_sum($data)) * 100); // Calculate percentage
               $angle = $startAngle + ($percentage / 2); // Calculate the angle for placing the text
               $textX = 50 + (cos(deg2rad($angle)) * 25); // X-coordinate for text
               $textY = 50 + (sin(deg2rad($angle)) * 25); // Y-coordinate for text
               $color = $colors[$key][0];
               echo "<div class='circle niveau{$reclamation['niveau']}' style='transform: rotate({$startAngle}deg); background-color: {$color};'>
                       <span style='position: absolute; top: {$textY}%; left: {$textX}%; transform: translate(-50%, -50%); font-weight: bold; color: white;'>{$percentage}%<br>{$colors[$key][1]}</span>
                     </div>\n";
               $startAngle += ($percentage / 100) * 360; // Update the start angle for the next circle
           }
           ?>
       </div>
   </div>
   
   
   <script>
       // Retrieve difficulty data from PHP
       var labels = <?php echo json_encode($labels); ?>; // Labels for the levels (e.g., Easy, Medium, Hard)
       var data = <?php echo json_encode($data); ?>; // Data for the number of exams per level
       var colors = <?php echo json_encode(array_column($colors, 0)); ?>; // Colors for each level
   
       // Create a new chart with Chart.js
       var ctx = document.getElementById('difficultyChart').getContext('2d');
       var difficultyChart = new Chart(ctx, {
           type: 'pie', // Pie chart type
           data: {
               labels: labels, // Labels for the levels
               datasets: [{
                   data: data, // Data for the number of exams per level
                   backgroundColor: colors // Background colors for each level
               }]
           },
           options: {
               responsive: true,
               title: {
                   display: true,
                   text: 'Distribution of Exams by Difficulty Level'
               }
           }
       });
   </script>
   </body>
   </html>

    <center>
        <h1>List of Exams</h1>
        <h2>
            
        </h2>
    </center>
    <table class="table table-hover text-center">
    <tbody>
                        <table class="table" align="center">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>nom</th>
                                    <th>typee</th>
                                    <th>langue</th>
                                    <th>niveau</th>
                                    <th>Image</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
        <?php
        foreach ($tab as $exams) {
        ?>

<tr>
                                            <td><?= $exams['id']; ?></td>
                                            <td><?= $exams['nom']; ?></td>
                                            <td><?php echo isset($exams['typee']) ? $exams['typee'] : ''; ?></td>
                                            <td><?= $exams['langue']; ?></td>
                                            <td><?= $exams['niveau']; ?></td>
                                            <td><img src="<?= isset($exams['image_path']) ? $exams['image_path'] : '' ?>" alt="Exam Image" style="max-width: 100px; max-height: 100px;"></td>
                                           <td>
                                                <a href="deleteExams.php?id=<?php echo $exams['id']; ?>">Delete</a>
                                            </td>                                          
                                            <td>
                                                <form method="POST" action="updateExams.php">
                                                    <input type="submit" name="update" value="Update"  style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 5px 10px; font-size: 1rem; border: none; border-radius: 3px;">
                                                    <input type="hidden" value="<?php echo $exams['id']; ?>" name="id">
                                                </form>
                                            </td>
                                        </tr>
        <?php
        }
        ?>
    </table>
    