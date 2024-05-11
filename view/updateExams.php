<<?php

include '../Controller/ExamsC.php';
include '../model/ExamsC.php';
$error = "";

// create exams
$exams = null;
// create an instance of the controller
$examsC = new ExamsC();


if (
    isset($_POST["nom"]) &&
    isset($_POST["typee"]) &&
    isset($_POST["langue"]) &&
    isset($_POST["niveau"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["typee"]) &&
        !empty($_POST["langue"]) &&
        !empty($_POST["niveau"]) 
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $exams = new Exams(
           
            null, // Si vous n'avez pas de valeur d'ID à fournir, vous pouvez utiliser null
            $_POST['nom'],
            $_POST['typee'],
            $_POST['langue'],
            $_POST['niveau'],
            ''    // Vous devez fournir une valeur pour $file, même si elle est vide ('')
        );
        var_dump($exams);
        
        $examsC->updateExams($exams, $_POST['id']);

        header('Location:listExams.php');
    } else
        $error = "Missing information";
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
                <a href="backoff/index.php">
                    <i class='indexcours'></i>
                    <span class="text">Course</span>
                </a>
            </li>
            <li>
                <a href="backoff/add-cours.php">
                    <i class='addcourse'></i>
                    <span class="text">Add Course</span>
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
    <button><a href="listExams.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id'])) {
        $exams = $examsC->showExams($_POST['id']);
        
    ?>

        <form action="" method="POST">
            <table>
            <tr>
                    <td><label for="nom">Id :</label></td>
                    <td>
                        <input type="text" id="id" name="id" value="<?php echo $_POST['id'] ?>" readonly />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">Typee :</label></td>
                    <td>
                        <input type="text" id="typee" name="typee" value="<?php echo $exams['typee'] ?>" />
                        <span id="erreurTypee" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                <td> <label for="langue">langue:</label></td>
                <td>
                <select id="langue" name="langue">
            <option value="anglai">anglai</option>
            <option value="francai">francai</option>
            <option value="arabe">arabe</option>
        </select><br>
                </td>
            </tr>
                <tr>
                    <td><label for="nom">nom :</label></td>
                    <td>
                        <input type="text" id="nom" name="nom" value="<?php echo $exams['nom'] ?>" />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="niveau">niveau :</label></td>
                    <td>
                        <input type="text" id="niveau" name="niveau" value="<?php echo $exams['niveau'] ?>" />
                        <span id="erreurNiveau" style="color: red"></span>
                    </td>
                </tr>


                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>
            

        </form>
        <script>
            document.getElementById("examsForm").addEventListener("submit", function(event) {
                var id = document.getElementById("id").value.trim();
                var nom = document.getElementById("nom").value.trim();
                var typee = document.getElementById("typee").value.trim();
                var langue = document.getElementById("langue").value.trim();
                var niveau = document.getElementById("niveau").value.trim();

                var errorDiv = document.getElementById("error");
                errorDiv.innerHTML = "";

                // Validation rules
                if (!/^\d+$/.test(id)) {
                    event.preventDefault();
                    document.getElementById("erreurid").innerHTML = "ID must be a number.";
                }

                if (nom.length > 10) {
                    event.preventDefault();
                    document.getElementById("erreurNom").innerHTML = "Name must be less than or equal to 10 characters.";
                }

                if (typee.length > 5) {
                    event.preventDefault();
                    document.getElementById("erreurTypee").innerHTML = "Type must be less than or equal to 5 characters.";
                }

                if (langue !== "anglais" && langue !== "francais" && langue !== "arabe") {
                    event.preventDefault();
                    document.getElementById("erreurLangue").innerHTML = "Language must be 'anglais', 'francais', or 'arabe'.";
                }

                if (!/^[1-3]$/.test(niveau)) {
                    event.preventDefault();
                    document.getElementById("erreurNiveau").innerHTML = "Niveau must be a number between 1 and 3.";
                }
            });
        </script>
    <?php
    }    ?>
</body>

</html>