<?php
include '../../controller/controllerpartenaire.php';
include '../../controller/controllerprofile.php';

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
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    
    <title>AdminHub</title>
</head>
<body>
<div id="overlay"></div>
<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <img src="asset/img/logo.png" alt="eduiland" class="logo" weidth=100px height=100px  >
        <span class="text">Eduiland</span>
    </a>
    <ul class="side-menu top">
    <li>
                <a href="../test.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../listUser.php">
                    <i class='bx bxs-user'></i>
                    <span class="text">Users</span>
                </a>
            </li>
            <li>
                <a href="../addExams.php">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="text">Exams</span>
                </a>
            </li>
            <li>
                <a href="../addCertif.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">certificate</span>
                </a>
            </li>
            <li >
                <a href="index.php">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">Courses</span>
                </a>
            </li>
           
           
            
            <li >
                <a href="../listreclam.php">
                    <i class='bx bxs-megaphone'></i>
                    <span class="text">Reclamation</span>
                </a>
            </li>
            <li class="active">
            <a href="index1.php">
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
            <img src="asset/img/ena.jpg">
        </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1> Partenaires Dashboard</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Add Partenaire</a>
                    </li>
                    <li><i class='bx bx-chevron-right' ></i></li>
                    <li>
                        <a class="active" href="add-profile.php">Back</a>
                    </li>
                </ul>
            </div>
            <form action="pdfpartenaire.php" method="post">
                <button name="pdf" class="btn-download">
                <i class='bx bxs-cloud-download' ></i>
                <span class="text">Download PDF</span>
                </button>
            </form>
        </div>
        
        <div class="table-data">
            <div class="table-data order">
                <div class="head">
                    <h3>List of Partners</h3>
                </div>
                <table class="table table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Date de recrutement</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Offre</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($partenaires as $Partenaire): ?>
                        <tr>
                            <td><?php echo $Partenaire['nom']; ?></td>
                            <td><?php echo $Partenaire['contact']; ?></td>
                            <td><?php echo $Partenaire['date_recru']; ?></td>
                            <td><?php echo $Partenaire['adresse']; ?></td>
                            <td><?php echo $Partenaire['offre']; ?></td>
                            <td>
                                <button onclick="openModal('<?php echo $Partenaire['idpartenaire']; ?>')" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Form for updating partner -->
                                <div id="myModal_<?php echo $Partenaire['idpartenaire']; ?>" class="modal" style="display: none;">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('<?php echo $Partenaire['idpartenaire']; ?>')">&times;</span>
                                        <form action="" method="POST">
                                            <input type="hidden" name="idpartenaire" value="<?php echo $Partenaire['idpartenaire']; ?>">
                                            <label for="nom">Nom:</label>
                                            <input type="text" id="nom" name="nom" value="<?php echo $Partenaire['nom']; ?>"><br>
                                            <label for="contact">Contact:</label><br>
                                            <input type="text" id="contact" name="contact" value="<?php echo $Partenaire['contact']; ?>"><br><br>
                                            
                                            <label for="date_recru">Date de recrutement:</label>
                                            <input type="date" id="date_recru" name="date_recru" value="<?php echo $Partenaire['date_recru']; ?>"><br><br>
                                            
                                            <label for="adresse">Adresse:</label>
                                            <input type="text" id="adresse" name="adresse" value="<?php echo $Partenaire['adresse']; ?>"><br><br>
                                            
                                            <label for="offre">Offre:</label>
                                            <input type="text" id="offre" name="offre" value="<?php echo $Partenaire['offre']; ?>"><br><br>
                                            
                                            <button type="submit" name="update" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                                <form action="" method="POST">
                                    <input type="hidden" name="idpartenaire" value="<?php echo $Partenaire['idpartenaire']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger">
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
        <!-- Pie chart -->
        <div class="table-data">
            <div class="table-data order">
                <div class="head">
                    <h3>Offre Statistics</h3>
                </div>
                <canvas id="pieChart" style="width: 500px; height: 500px;"></canvas>
            </div>
        </div>
    </main>
    <!-- MAIN -->
</section>

<script src="asset/java/script.js"></script>
<script>
    // Get data for the pie chart from PHP
    let offres = <?php echo json_encode(array_column($partenaires, 'offre')); ?>;
    
    // Count occurrences of each offre
    let offreCounts = {};
    offres.forEach(offre => {
        offreCounts[offre] = (offreCounts[offre] || 0) + 1;
    });

    // Generate labels and data for the pie chart
    let labels = Object.keys(offreCounts);
    let data = Object.values(offreCounts);

    // Generate colors for the pie chart
    let colors = labels.map(() => '#' + (Math.random().toString(16) + '000000').substring(2, 8));

    // Create the pie chart
    var ctx = document.getElementById('pieChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Offre Distribution',
                data: data,
                backgroundColor: colors,
                borderWidth: 1 // Ajouter une bordure
            }]
        },
        options: {
            animation: {
                duration: 2000 // Durée de l'animation en millisecondes
            },
            responsive: false, // Désactiver la réactivité
            maintainAspectRatio: false, // Ne pas maintenir le rapport d'aspect
            width: 300, // Largeur du graphique
            height: 300, // Hauteur du graphique
            plugins: {
                legend: {
                    position: 'right'
                }
            }
        }
    });
</script>

</body>
</html>
