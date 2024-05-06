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
    <style>
        /*body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }*/

        /*#content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }*/

        form {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            padding: 10px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        .form-input {
            display: flex;
            align-items: center;
        }

        .form-input input[type="search"] {
            width: 70%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-input button {
            width: 30%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-input button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div id="overlay"></div>

<!-- SIDEBAR -->
<section id="sidebar">
<a href="#" class="brand">
    <img src="" alt="" class="logo">
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
                <div class="table-data">    
            <div class="order">
                <div class="head">
                    <h3>formule de certeficat</h3>
                    <i class='bx bx-search' ></i>
                    <i class='bx bx-filter' ></i>
                </div>
    <button><a href="listCertif.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_certif'])) {
        $certif = $certifC->showcertif($_POST['id_certif']);
    ?>
        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="id_certif">Id :</label></td>
                    <td>
                        <input type="text" id="id_certif" name="id_certif" value="<?php echo $certif['id_certif']; ?>" readonly />
                    </td>
                </tr>
                <tr>
                    <td><label for="id_exam">Id_exam :</label></td>
                    <td>
                        <input type="text" id="id_exam" name="id_exam" value="<?php echo $certif['id_exam']; ?>" readonly />
                    </td>
                </tr>
                <tr>
                    <td><label for="datee">date :</label></td>
                    <td>
                        <input type="text" id="datee" name="datee" value="<?php echo $certif['datee']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><label for="specialite">specialite :</label></td>
                    <td>
                        <input type="text" id="nom" name="nom" value="<?php echo $certif['specialite']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><label for="id_etudiant">id_etudiant :</label></td>
                    <td>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $certif['id_etudiant']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save">
                    </td>
                </tr>
            </table>
        </form>
    <?php
    }
    ?>
</body>
</html>
