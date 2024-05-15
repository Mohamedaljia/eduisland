<?php
include '../Controller/CertifC.php';
include '../model/CertifC.php';

$error = "";
$certifC = new CertifC();

if (
    isset($_POST["id_certif"]) &&
    isset($_POST["id_exam"]) &&
    isset($_POST["datee"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["prenom"])
) {
    if (
        !empty($_POST['id_certif']) &&
        !empty($_POST['id_exam']) &&
        !empty($_POST['datee']) &&
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"])
    ) {
        $id_certif = $_POST['id_certif'];
        $id_exam = $_POST['id_exam'];
        $datee = $_POST['datee'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        try {
            $certif = new Certif($id_certif, $id_exam, $datee, $nom, $prenom);
            $certifC->updatecertif($certif, $id_certif);
            header('Location:listCertif.php');
            exit();
        } catch (Exception $e) {
            $error = "Error updating certif: " . $e->getMessage();
        }
    } else {
        $error = "Missing information";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
     <!-- Boxicons -->
     <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="asset/css/add.css">
   
	<title>AdminHub</title>
   
</head>
<body>
<div id="overlay"></div>

<!-- SIDEBAR -->
<section id="sidebar">
<<a href="../index.html" class="brand">
      <!-- <img src="asset/img/icon.png" alt="AzulTunes Logo" class="logo">-->
      <span class="text"><i class="fa fa-book me-3"></i>EDUISLAND</span>
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
            <li class="active">
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
                <h1>Certif</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">update certif</a>
                    </li>
                    <li><i class='bx bx-chevron-right' ></i></li>
                    <li>
                        <a class="active" href="#">Home</a>
                    </li>
                </ul>
            </div>
    </div>
        <div class="table-data"  style="margin: auto; width: 50%; text-align: left;">    
            <div class="order">
                <div class="head">
                    <h3> certeficat update</h3>
                    <i class='bx bx-search' ></i>
                    <i class='bx bx-filter' ></i>
                </div>
    
    <div class="container">

        <?php
        if (isset($_POST['id_certif'])) {
            $certif = $certifC->showcertif($_POST['id_certif']);
        ?>
        <form action="" method="POST">

             <div class="mb-3">

                   <label for="id_certif">Id :</label>
                    
                        <input type="text" id="id_certif" name="id_certif" value="<?php echo $certif['id_certif']; ?>" style="margin-left: auto; margin-right: auto; display: block;">
                    
                 </div>
                <div class="mb-3">

                    <label for="id_exam">Id_exam :</label>
                   
                        <input type="text" id="id_exam" name="id_exam" value="<?php echo $certif['id_exam']; ?>" style="margin-left: auto; margin-right: auto; display: block;">
                    
                 </div>
                <div class="mb-3">

                   <label for="datee">date :</label>
                   
                        <input type="text" id="datee" name="datee" value="<?php echo $certif['datee']; ?>" style="margin-left: auto; margin-right: auto; display: block;">
                    
                 </div>
                <div class="mb-3">

                    <label for="specialite">specialite :</label>
                  
                        <input type="text" id="nom" name="nom" value="<?php echo $certif['specialite']; ?>" style="margin-left: auto; margin-right: auto; display: block;">
                    
                </div>
                <div class="mb-3">

                   <label for="id_etudiant">id_etudiant :</label>
                    
                        <input type="text" id="prenom" name="prenom" value="<?php echo $certif['id_etudiant']; ?>" style="margin-left: auto; margin-right: auto; display: block;">
                    
                 </div>
                <div class="mb-3">
                    <input type="submit" value="Save" style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">                  
                 </div>
         
        </form>
    <?php
    }
    ?>
    </div>
    </div>
    </div>
</body>
</html>
