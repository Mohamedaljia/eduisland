<?php
include '../../config/connexion.php';

include '../../controller/typecoursC.php';
include '../../controller/coursC.php';

try {
    // Requête SQL pour compter le nombre d'enregistrements pour chaque matière
    $sql = "SELECT l.matiere, COUNT(tc.emailuser) AS count 
            FROM lessons l
            LEFT JOIN typecours tc ON l.idlesson = tc.idlesson
            GROUP BY l.matiere";

    // Préparez la requête SQL
    $stmt = $conn->prepare($sql);
    
    // Exécutez la requête SQL
    $stmt->execute();
    
    // Tableau pour stocker les statistiques
    $statistics = array();
    
    // Récupérez les résultats sous forme de tableau associatif
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Parcourez les résultats et stockez les statistiques dans un tableau
    foreach ($results as $row) {
        $statistics[$row['matiere']] = $row['count'];
    }
    
    // Encodez les données des statistiques en JSON pour les transmettre à JavaScript
    $statistics_json = json_encode($statistics);
} catch(PDOException $e) {
    // En cas d'erreur, affichez un message d'erreur
    echo "Erreur lors de la récupération des statistiques : " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

<!--Meta Responsive tag-->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    

    <link rel="stylesheet" href="assets/css/template.css">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Liens vers Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
 
<script src="view/frontoff/js/main.js"></script>
<link rel="icon" href="assets/4.png" type="image/x-icon">

<title>EduIsland</title>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>


<div id="overlay"></div>

    


    <!-- SIDEBAR -->
	<section id="sidebar">
    <a href="#" class="brand">
        <img src="assets/4.png" alt="EduIsland Logo" class="logo">
        <span class="text">EduIsland</span>
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
            <li class="active">
                <a href="index.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">Courses</span>
                </a>
            </li>
            <li>
                <a href="add-cours.php">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Add course</span>
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
            <li >
                <a href="../listreclam.php">
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
				<img src="assets/ena">
			</a>
		</nav>
		<!-- NAVBAR -->
    
    <!-- MAIN -->
    <main>
    <div class="conta">
        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent">
                            <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php" aria-current="page" class="text-white">List</a></li>
                            <li class="breadcrumb-item"><a href="add-cours.php" class="text-white">add Courses</a></li>
                        </ol>
        </nav>  
    </div>
    <div class="table-data">
       
    <div class="table-data order">
        <div class="head">
            <h3>List of Regestration to Courses</h3>
             <!-- Champ de recherche par email -->
    
        </div>
        <div class="search">
        <label for="searchEmail">Search by Email:</label>
        <input type="text" id="searchEmail" placeholder="Enter email...">
        <button id="searchEmail1" onclick="searchByEmail()">Search</button>
    </div>
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr> 
                    <th scope="col">Title of course </th>                
                    <th scope="col">Email of user</th>
                    
                    <th scope="col">Type</th>
                    
                    <th scope="col">action</th>
                    <!-- Ajoutez d'autres colonnes au besoin -->
                </tr>
            </thead>
            <tbody>
                <?php foreach($typecours as $Typecours): ?>
                        <td>
                        <?php
// Récupérer l'ID de la collaboration du typecours
$idlesson = $Typecours['idlesson'];

try {
    // Exécuter une requête SQL pour récupérer le titre de la collaboration
    $sql = "SELECT matiere FROM lessons WHERE idlesson = :idlesson";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idlesson', $idlesson, PDO::PARAM_INT);
    $stmt->execute();
    
    // Vérifier si des résultats sont retournés
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $matiere = $row['matiere'];
        echo $matiere; // Afficher le titre du cours
    } else {
        echo "Matière inconnue";
    }
} catch(PDOException $e) {
    // En cas d'erreur, afficher un message d'erreur
    echo "Erreur lors de la récupération de la matière : " . $e->getMessage();
}
?>
</td>                 
                        <td><?php echo $Typecours['emailuser']; ?></td>
                        <td><?php echo $Typecours['type']; ?></td>

                        <td>
                            <button onclick="openModal('<?php echo $Typecours['idtypecours']; ?>')" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </button>
                            <!-- Form for updating typecours -->
                          
                            <div id="myModal_<?php echo $Typecours['idtypecours']; ?>" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal('<?php echo $Typecours['idtypecours']; ?>')">&times;</span>
        <form onsubmit="return validateForm_<?php echo $Typecours['idtypecours']; ?>()" method="POST" name="formulaire">
            <input type="hidden" name="idtypecours" value="<?php echo $Typecours['idtypecours']; ?>">
            <label for="emailuser">Course:</label>
            <input id="emailuser_<?php echo $Typecours['idtypecours']; ?>" type="email" name="emailuser" value="<?php echo $Typecours['emailuser']; ?>"><br>
            <p id="error-emailuser_<?php echo $Typecours['idtypecours']; ?>" style="color:red;"></p>
            <label for="type">Type of course:</label>
            <select id="type_<?php echo $Typecours['idtypecours']; ?>" name="type">
                <option value="PDF" <?php if ($Typecours['type'] == 'PDF') echo 'selected'; ?>>PDF</option>
                <option value="Live" <?php if ($Typecours['type'] == 'Live') echo 'selected'; ?>>Live</option>
            </select><br>
            <p id="error-type_<?php echo $Typecours['idtypecours']; ?>" style="color:red;"></p>
            <button type="submit" name="update" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>
                            
                            
                        
                        
                        <form action="" method="POST">
                                <input type="hidden" name="idtypecours" value="<?php echo $Typecours['idtypecours']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                            </form> </td>

                    
                        <!-- Ajoutez d'autres colonnes au besoin -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

    <div class="table-data">
        <div class="table-data order">
            <div class="head">
                <h3>List of courses</h3>
                
            </div>
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr> 
                        <th scope="col">Title of course</th>                
                        <th scope="col">Level</th>
                        <th scope="col">Number of Hours</th>
                        <th scope="col">ID Teacher</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cours as $Cours): ?>
                        <tr>   
                            <td><?php echo $Cours['matiere']; ?></td>                 
                            <td><?php echo $Cours['niveau']; ?></td>
                            <td><?php echo $Cours['nbheure']; ?></td>
                            <td><?php echo $Cours['idt']; ?></td>
                            <td>
                                <button onclick="openModal('<?php echo $Cours['idlesson']; ?>')" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </button>
                              
                                <!-- Modal de modification -->
<div id="myModal_<?php echo $Cours['idlesson']; ?>" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal('<?php echo $Cours['idlesson']; ?>')">&times;</span>
        <form onsubmit="return validateForm()" method="POST" name="myForm">
            <input type="hidden" name="idlesson" value="<?php echo $Cours['idlesson']; ?>"><br>
            
            <label for="matiere">Course:</label>
<select id="matiere_<?php echo $Cours['idlesson']; ?>" name="matiere">
    <?php
    // Remplacez cette boucle par la méthode que vous utilisez pour récupérer les valeurs de matiere depuis votre base de données
    $matieres = array("Spanish", "French", "English", "Portuguese", "Italian");
    
    // Boucle à travers les matières existantes et crée une option pour chaque
    foreach ($matieres as $matiere) {
        // Vérifie si la matière correspond à celle en cours de modification
        $selected = ($matiere == $Cours['matiere']) ? "selected" : "";
        echo "<option value='" . $matiere . "' " . $selected . ">" . $matiere . "</option>";
    }
    ?>
</select><br>

            <p id="error-matiere_<?php echo $Cours['idlesson']; ?>" style="color:red;"></p>
            <label for="niveau">Level:</label>
<select id="niveau_<?php echo $Cours['idlesson']; ?>" name="niveau">
    <option value="A1" <?php if ($Cours['niveau'] == "A1") echo "selected"; ?>>A1</option>
    <option value="A2" <?php if ($Cours['niveau'] == "A2") echo "selected"; ?>>A2</option>
    <option value="B1" <?php if ($Cours['niveau'] == "B1") echo "selected"; ?>>B1</option>
    <option value="B2" <?php if ($Cours['niveau'] == "B2") echo "selected"; ?>>B2</option>
    <option value="C1" <?php if ($Cours['niveau'] == "C1") echo "selected"; ?>>C1</option>
    <option value="C2" <?php if ($Cours['niveau'] == "C2") echo "selected"; ?>>C2</option>
</select><br>

            <p id="error-niveau_<?php echo $Cours['idlesson']; ?>" style="color:red;"></p>
            <label for="nbheure">Nb Hours:</label>
            <input id="nbheure_<?php echo $Cours['idlesson']; ?>" type="text" name="nbheure" value="<?php echo $Cours['nbheure']; ?>"><br>
            <p id="error-nbheure_<?php echo $Cours['idlesson']; ?>" style="color:red;"></p>
            
            
            <label for="idt">ID Teacher:</label>
            <input id="idt_<?php echo $Cours['idlesson']; ?>" type="text" name="idt" value="<?php echo $Cours['idt']; ?>"><br>
            <p id="error-idt_<?php echo $Cours['idlesson']; ?>" style="color:red;"></p>
            <button type="submit" name="submit_update" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>

                                <!-- Fin Modal de modification -->
                                <form action="" method="POST">
                                    <input type="hidden" name="idlesson" value="<?php echo $Cours['idlesson']; ?>">
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

    <h1>Download PDF</h1>
    
    <form action="generate_pdf.php" method="post">
    <button id="downloadPdfBtn" type="submit">Download PDF</button>
    </form>

    <div class="legend-container">
    <h2>Statistics of users registration to courses</h2>
    <!-- Redimensionnez l'élément canvas pour réduire la taille -->
    <canvas id="statisticsChart" width="800" height="400"></canvas>
    <!-- Color Squares -->
    <div id="colorSquares"></div>
    </div>
</main>

</section>

<!-- Script JavaScript pour afficher les statistiques sous forme de graphique -->

<script>
        // Récupérez les statistiques depuis PHP
        var statistics = <?php echo $statistics_json; ?>;
        var labels = Object.keys(statistics);
        var data = Object.values(statistics);

        // Tableau de couleurs personnalisées pour les carrés
        var backgroundColors = [
            'rgba(255, 99, 132, 0.7)', // Rouge
            'rgba(54, 162, 235, 0.7)', // Bleu
            'rgba(255, 206, 86, 0.7)', // Jaune
            'rgba(75, 192, 180, 0.7)', // Vert
            'rgba(153, 102, 255, 0.7)', // Violet
            'rgba(255, 159, 64, 0.7)', // Orange
            // Ajoutez d'autres couleurs personnalisées au besoin
        ];

        var borderColor = [
            'rgba(255, 99, 132, 1)', // Rouge
            'rgba(54, 162, 235, 1)', // Bleu
            'rgba(255, 206, 86, 1)', // Jaune
            'rgba(75, 192, 192, 1)', // Vert
            'rgba(153, 102, 255, 1)', // Violet
            'rgba(255, 159, 64, 1)', // Orange
            // Ajoutez d'autres couleurs personnalisées au besoin
        ];

        var ctx = document.getElementById('statisticsChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: '',
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: borderColor,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: 'rgba(0, 0, 0, 0.7)',
                            fontSize: 12
                        },
                        gridLines: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            fontColor: 'rgba(0, 0, 0, 0.7)',
                            fontSize: 12
                        },
                        gridLines: {
                            color: 'rgba(0, 0, 0, 0)'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Statistiques par matière',
                    fontSize: 16,
                    fontColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 20
                },
                animation: {
                    duration: 4000,
                    easing: 'easeInOutQuart'
                }
            }
        });

        // Créez des carrés de couleur avec les titres des matières
        var colorSquares = document.getElementById('colorSquares');
        labels.forEach((label, index) => {
            var square = document.createElement('div');
            square.style.width = '20px';
            square.style.height = '20px';
            square.style.backgroundColor = backgroundColors[index];
            square.style.marginRight = '10px';
            square.style.display = 'inline-block';
            colorSquares.appendChild(square);

            var title = document.createElement('span');
            title.textContent = label;
            colorSquares.appendChild(title);
            
            colorSquares.appendChild(document.createElement('br'));
        });
    </script>


<!-- Import de la bibliothèque jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>



<script>
     function validateForm_<?php echo $Typecours['idtypecours']; ?>() {
        var email = document.getElementById("emailuser_<?php echo $Typecours['idtypecours']; ?>").value;
        var type = document.getElementById("type_<?php echo $Typecours['idtypecours']; ?>").value;
        var errorEmail = document.getElementById("error-emailuser_<?php echo $Typecours['idtypecours']; ?>");
        var errorType = document.getElementById("error-type_<?php echo $Typecours['idtypecours']; ?>");

        // Vérification de l'email
        if (email === "") {
            errorEmail.innerHTML = "Enter your email";
            return false;
        } else {
            errorEmail.innerHTML = "";
        }

        // Vérification du type de cours
        if (type === "") {
            errorType.innerHTML = "Select a type of course";
            return false;
        } else {
            errorType.innerHTML = "";
        }

        return true; // Le formulaire peut être soumis
    }
    
</script>

<script >
    function openModal(id) {
    // Récupérer le modal par son ID
    var modal = document.getElementById("myModal_" + id);
    document.getElementById("overlay").style.display = "block";
    // Afficher le modal
    modal.style.display = "block";
}

function closeModal(id) {
    // Récupérer le modal par son ID
    var modal = document.getElementById("myModal_" + id);
    document.getElementById("overlay").style.display = "none";
    // Cacher le modal
    modal.style.display = "none";
}

</script>
<script>
    function searchByEmail() {
        // Récupérer la valeur de l'email de recherche
        var searchValue = document.getElementById('searchEmail').value.toLowerCase();

        // Récupérer toutes les lignes du tableau
        var rows = document.querySelectorAll('.table-data tbody tr');

        // Parcourir toutes les lignes du tableau
        rows.forEach(function(row) {
            // Récupérer la colonne de l'email de l'utilisateur dans la ligne
            var emailCell = row.querySelector('td:nth-child(2)');
            var email = emailCell.textContent.trim().toLowerCase();

            // Vérifier si l'email de la ligne contient l'email recherché
            if (email.includes(searchValue)) {
                // Afficher la ligne si l'email correspond
                row.style.display = '';
            } else {
                // Masquer la ligne si l'email ne correspond pas
                row.style.display = 'none';
            }
        });
    }
</script>

<!-- Footer -->
    
    
   
</body>
</html>
