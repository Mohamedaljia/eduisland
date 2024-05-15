
<?php
include "../controller/User.php";

$c = new User();
$tab = $c->listUserC();
$occupationByType = $c->countOccupationByType();

$labels = [];
$data = [];
$colors = [];

// Define a mapping for occupation IDs to names
$occupationNames = [
    1 => 'Prof',
    2 => 'Etudiant',
    3 => 'Autre',
    4 => 'Admin'
];

foreach ($occupationByType as $occupation) {
    // Get the name corresponding to the occupation ID
    $occupationName = $occupationNames[$occupation['occupation']];
    
    // Add the name to labels array
    $labels[] = $occupationName;
    
    // Add count to data array
    $data[] = $occupation['count'];
    // You can define colors here if needed
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
     
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <ul class="side-menu top">
            <li class="active">
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
                    <span class="text">Course</span>
                </a>
            </li>
           
           
            
            <li >
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
        <!-- Other navbar elements -->
        
    </nav>
    <!-- NAVBAR -->
        <main>
        <div class="head-title">
            <div class="left">
                <h1>Statestic</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Statestic of type </a>
                    </li>
                    <li><i class='bx bx-chevron-right' ></i></li>
                    <li>
                        <a class="active" href="test.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
            <!-- Display the chart here -->
            <div style="width: 600px; height: 400px; margin: 20px auto;">
                <canvas id="occupationChart"></canvas>
            </div>
            <div class="table-data">
            <!-- Your existing table code -->
        </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <!-- Script to generate the chart -->
    <script>
        // PHP variables passed from the controller
        var labels = <?php echo json_encode($labels); ?>;
        var data = <?php echo json_encode($data); ?>;
        var colors = ['#F1948A','#8E44AD', '#7FB3D5', '#D7BDE2']; // You can define colors here
        
        // Create a new chart with Chart.js
        var ctx = document.getElementById('occupationChart').getContext('2d');
        var occupationChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Distribution of Occupations'
                }
            }
        });
    </script>
</body>
</html>
