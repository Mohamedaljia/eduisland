<?php
include '../../config/connexion.php';
include '../../controler/coursC.php'; // Assure-toi que le chemin vers le contrôleur est correct


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<!--Meta Responsive tag-->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
    <link rel="stylesheet" href="assets/css/cours.css">
    
    
   <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <link rel="icon" href="4.png" type="image/x-icon">
    <title>EduIsland</title>
</head>
<body>
    

<div id="overlay"></div>

    


<!-- SIDEBAR -->
<section id="sidebar">
<a href="#" class="brand">
    <img src="4.png" alt="EduIsland Logo" class="logo">
    <span class="text">EduIsland</span>
</a>

    <ul class="side-menu top">
        <li>
            <a href="#">
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
        <li >
            <a href="index.php">
                <i class='bx bxs-group'></i>
                <span class="text">Courses</span>
            </a>
        </li>
        <li class="active">
            <a href="add-cours.php">
                <i class='bx bxs-bar-chart-alt-2'></i>
                <span class="text">Add Course</span>
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
            <span class="num">6</span>
        </a>
        <a href="#" class="profile">
            <img src="ena">
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

    <!-- Bouton d'ouverture du modal -->
<button id="openModalBtn">Add Course</button>

<!-- Modal -->
<div id="myModal" class="modal">
    <!-- Contenu du modal -->
    <div class="modal-content">
        <span class="close">&times;</span>
        
        <!-- Formulaire pour ajouter un cours -->
        <form onsubmit="return validateForm()" method="post" class="formulaire_cours" name="addCourseForm" >
            <label for="matiere">Course:</label>
            <select id="matiere" name="matiere">
            <option value="Subject">Subject</option>
            <option value="Spanish">Saipnish</option>
    <option value="French">French</option>
    <option value="English">English</option>
    <option value="Portuguese">Potuguese</option>
    <option value="Italian">Italian</option>
</select>
            <span class="errormsg" id="matiereError"></span><br>
            
            <label for="niveau">Level:</label>
            <select id="niveau" name="niveau">
            <option value="Level">Level</option>
            <option value="A1">A1</option>
    <option value="A2">A2</option>
    <option value="B1">B1</option>
    <option value="B2">B2</option>
    <option value="C1">C1</option>
    <option value="C2">C2</option>
</select>
            <span class="errormsg" id="niveauError"></span><br>
            
            <label for="nbheure">Nb Hours:</label>
            <input type="text" id="nbheure" name="nbheure" placeholder="Numbre of Hours">
            <span class="errormsg" id="nbheureError"></span><br>
            
            <label for="idt">ID Teacher:</label>
            <input type="text" id="idt" name="idt" placeholder="Teacher ID">
            <span class="errormsg" id="idtError"></span><br>
            
            <input type="submit" name="submit_Add" value="Add Course">
        </form>

    </div>
    
</div>
<!-- Affichage du message -->
<?php if(isset($_GET['message'])): ?>
            <?php if ($_GET['message'] != 1): ?>
                <div class="error-message"><?php echo $_GET['message']; ?></div>
            <?php else: ?>
                <div class="success-message">The course has been added succesfully.</div>
            <?php endif; ?>
        <?php endif; ?>



    </main>
</section>

    <!-- Liens vers les fichiers JavaScript -->
    <script src="assets/js/cours.js"></script>
    <!-- Footer -->
    

</body>
</html>
