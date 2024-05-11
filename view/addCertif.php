<?php
// Enable error reporting to display PHP errors or warnings
include '../Controller/CertifC.php';
include '../model/CertifC.php';
/*include '../Controller/ExamCertif.php';
include '../model/examCerif.php';*/

//include_once '../model/examCerif.php';


$error = "";

// create Exams
$certif = null;

// create an instance of the controller
$certifC = new CertifC();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_exam']) && isset($_POST['search'])) {
        $id_exam = $_POST['id_exam'];
        $list = $certifC->afficherCertif($id_exam);
    }
}

$genres = $certifC->afficherExam();

if (
    isset($_POST["id_certif"]) &&
    isset($_POST["id_exam"]) &&
    isset($_POST["datee"]) &&
    isset($_POST["specialite"]) &&
    isset($_POST["id_etudiant"])
) {
    echo "Form submitted!<br>"; // Debugging message

    // Check if form data is set and not empty
    if (
        !empty($_POST['id_certif']) &&
        !empty($_POST['id_exam']) &&
        !empty($_POST['datee']) &&
        !empty($_POST["specialite"]) &&
        !empty($_POST["id_etudiant"])
    ) {
        echo "All fields filled!<br>"; // Debugging message
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }

        // Create Exams object
        $certif = new Certif(
            $_POST['id_certif'],
            $_POST['id_exam'],
            $_POST['datee'],
            $_POST['specialite'],
            $_POST['id_etudiant']
        );

        try {
            // Add Exams to database
            $certifC->addceertif($certif);

            // Redirect to listExams.php after successful addition
            header('Location: listCertif.php');
            exit(); // Ensure no further code execution after redirection
        } catch (Exception $e) {
            $error = "Error adding certif: " . $e->getMessage();
            echo $error; // Display error message for debugging
        }
    } else {
        $error = "Missing information";
        echo "Missing information!<br>"; // Debugging message
    }
}
$c = $certifC->afficherExam();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        /* Error message styling */
        /* Error message styling */
        #error {
            color: #ff0000; /* Red */
            margin-bottom: 10px;
        }

        /* Logo styling */
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }

        /* Name styling */
        .name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
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
							<a class="active" href="http://localhost/inegration(amjed,lina)/projetWEB/view/listCertif.php">List</a>
						</li>
					</ul>
                    <div class="table-data">    
				<div class="order">
					<div class="head">
						<h3>formule de certeficat</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
      

                    <div class="name">EDUISLAND</div>    
                    <form action="" method="POST" id="examsForm" enctype="multipart/form-data">
                    <table>
                            <tr>
                            <td><label for="id_certif">Id_certif:</label>
                                <input type="text" id="id_certif" name="id_certif" />
                                </td>
                                </tr>
            
                            <tr>        
                            <td> <label for="id_exam">Id_exam:</label>
                            <select name="id_exam" id="id_exam">
                    <?php foreach ($c as $exams) { ?>
                        <option value="<?php echo $exams['id']; ?>"><?php echo $exams['id']; ?></option>
                    <?php } ?>
                </select>
                </td>    </tr>
                        
                <tr>
               <td> <label for="specialite">Specialite:</label>
                <input type="text" id="specialite" name="specialite" />
                </td>
                </tr>
           
                <tr>
               <td>
                <label for="id_etudiant">Id_etudiant:</label>
                <input type="text" id="id_etudiant" name="id_etudiant" />
                </td>
                </tr>
            
                <tr>
               <td>
                <label for="datee">Date:</label>
                <input type="text" id="datee" name="datee" />
                </td>
                </tr>
            
                <tr>
               <td>
                <input type="submit" value="Save">
                <input type="reset" value="Reset">
                </td>
                </tr>
        </form>
   
</div>
    <script>
        document.getElementById("examsForm").addEventListener("submit", function(event) {
            var id = document.getElementById("id_certif").value.trim();
            var specialite = document.getElementById("specialite").value.trim();
            var id_etudiant = document.getElementById("id_etudiant").value.trim();
            var datee = document.getElementById("datee").value.trim();

            var errorDiv = document.getElementById("error");
            errorDiv.innerHTML = "";

            // Validation rules
            var idRegex = /^\d+$/; // Only digits

            // ID validation
            if (!idRegex.test(id)) {
                event.preventDefault();
                errorDiv.innerHTML = "ID must contain only numbers.";
                return;
            }

            // Specialite validation
            if (specialite === "") {
                event.preventDefault();
                errorDiv.innerHTML = "Specialite cannot be empty.";
                return;
            }

            // ID Etudiant validation
            if (!idRegex.test(id_etudiant)) {
                event.preventDefault();
                errorDiv.innerHTML = "ID Etudiant must contain only numbers.";
                return;
            }

            // Date validation
            if (datee === "") {
                event.preventDefault();
                errorDiv.innerHTML = "Date cannot be empty.";
                return;
            }
        });
    </script>

</body>
</main>
</html>
