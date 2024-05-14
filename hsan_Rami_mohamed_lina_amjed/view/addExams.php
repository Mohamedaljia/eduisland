<?php
// Enable error reporting to display PHP errors or warnings

include '../Controller/ExamsC.php';
include '../model/ExamsC.php';

$error = "";

// create Exams
$exams = null;

// create an instance of the controller
$examsC = new ExamsC();

if (
    isset($_POST["id"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["typee"]) &&
    isset($_POST["langue"]) &&
    isset($_POST["niveau"]) &&
    isset($_FILES["file"])  // Check if file is set in $_FILES
) {
    echo "Form submitted!<br>"; // Debugging message

    // Check if form data is set and not empty
    if (
        !empty($_POST['id']) &&
        !empty($_POST['nom']) &&
        !empty($_POST["typee"]) &&
        !empty($_POST["langue"]) &&
        !empty($_POST["niveau"]) &&
        !empty($_FILES["file"]["name"]) // Check if file name is not empty
    ) {
        echo "All fields filled!<br>"; // Debugging message
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }

        // Directory where uploaded files will be saved
        $uploadDirectory = "uploads/";

        // Create directory if it does not exist
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // Generate a unique name for the file
        $fileName = uniqid() . '_' . $_FILES["file"]["name"];

        // Move the file to the upload directory
        $targetFilePath = $uploadDirectory . $fileName;
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            echo "The file " . $fileName . " has been uploaded successfully.<br>";

            // Create Exams object with the file path
            $exams = new Exams(
                $_POST['id'],
                $_POST['nom'],
                $_POST['typee'],
                $_POST['langue'],
                $_POST['niveau'],
                $targetFilePath
            );

            try {
                // Add Exams to database
                $examsC->addExams($exams);

                // Redirect to listExams.php after successful addition
                header('Location: listExams.php');
                exit(); // Ensure no further code execution after redirection
            } catch (Exception $e) {
                $error = "Error adding exam: " . $e->getMessage();
                echo $error; // Display error message for debugging
            }
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    } else {
        $error = "Missing information";
        echo "Missing information!<br>"; // Debugging message
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exams</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="asset/css/add.css">
    <style>
        /* Background styling */
        .dashboard-container {
           
            padding: 20px;
            border-right: 1px solid #dee2e6;
        }
        .dashboard-container h2 {
            color: #27abb4e5; 
        }
        .dashboard-btn {
            width: 100%;
            margin-bottom: 10px;
        }
        .dashboard-btn a {
            display: block;
            padding: 10px 20px;
            background-color: #ffffff; /* Changed button color to match EDUISLAND */
            color: #27abb4e5;
            border-radius: 5px;
            text-align: left;
            transition: background-color 0.3s ease;
        }
        .dashboard-btn a:hover {
            background-color: #0056b3;
        }
       /* body {
           
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }*/
        #content form {
    background-color: #fff; /* White background */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}
/* Style du bouton Search */
#content form button[type="submit"] {
    background-color: #0056b3; /* Couleur bleue */
    color: #fff; /* Couleur du texte blanc */
    border: none; /* Pas de bordure */
    border-radius: 5px; /* Coins arrondis */
    padding: 10px 20px; /* Espacement à l'intérieur du bouton */
    cursor: pointer; /* Curseur de la souris en forme de main */
    transition: background-color 0.3s ease; /* Transition fluide pour la couleur de fond */
}
        /* Form container */
       /* .form-container {
            background-color: #ffffff; /* White background 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Shadow effect 
            text-align: center;
        }*/

        /* Form styling */
        form {
            max-width: 400px;
            margin: 0 auto;
        }

        form table {
            width: 100%;
        }

        form table tr {
            margin-bottom: 10px;
        }

        form table td {
            padding: 5px;
        }

        form table td input[type="text"],
        form table td select,
        form table td input[type="file"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
        }

        form table td input[type="submit"],
        form table td input[type="reset"] {
            padding: 10px 20px;
            background-color: #0056b3; /* Blue button color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        form table td input[type="submit"]:hover,
        form table td input[type="reset"]:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

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
    </style>
</head>
<body>

   
    <div class="">
    

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
							<a href="http://localhost/inegration(amjed,lina)/projetWEB/view/updateExams.php">update</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="http://localhost/inegration(amjed,lina)/projetWEB/view/listExams.php">List of Exams</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>
            <div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Add New Collab</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
				


        <div class="name">EDUISLAND</div>
        <form action="" method="POST" id="examsForm" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="id">Id:</label></td>
                    <td>
                        <input type="text" id="id" name="id" />
                        <span id="erreurid" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">Subject:</label></td>
                    <td>
                        <input type="text" id="nom" name="nom" />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="typee">Type:</label></td>
                    <td>
                        <input type="text" id="typee" name="typee" />
                        <span id="erreurTypee" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="langue">Langue:</label></td>
                    <td>
                        <select id="langue" name="langue">
                            <option value="anglais">anglais</option>
                            <option value="francais">francais</option>
                            <option value="arabe">arabe</option>
                        </select>
                        <span id="erreurLangue" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="niveau">Niveau:</label></td>
                    <td>
                        <input type="text" id="niveau" name="niveau" />
                        <span id="erreurNiveau" style="color: red"></span>
                    </td>
                </tr>
               
                <tr>
                    <td><label for="file">Image:</label></td>
                    <td>
                        <input type="file" id="file" name="file" accept="image/*" />
                    </td>
                    <td><?php echo isset($exams['image_path']) ? $exams['image_path'] : 'No image path provided'; ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </form>
        <div id="error"></div>
    </div>
    <h2></h2>
    <form action="" method="get">
    <h3>Search Exam by ID</h3>
        <label for="exam_id">Enter Exam ID:</label>
        <input type="text" id="exam_id" name="id" required>
        <button type="submit" name="search">Search</button>

        
        <?php
    // Check if the form is submitted and the search button is clicked
    if (isset($_GET['search'])) {
       

        // Check if the ID parameter is set in the URL
        if (isset($_GET['id'])) {
            // Get the exam ID from the URL parameter
            $examId = $_GET['id'];

            // Create an instance of the ExamsC class
            $examsC = new ExamsC();

            // Call the findExamById method to search for the exam
            $exam = $examsC->findExamById($examId);

            // Display the exam attributes if found
            if ($exam) {
                echo "<h3>Exam Details</h3>";
                echo "ID: " . $exam['id'] . "<br>";
                echo "Type: " . $exam['typee'] . "<br>";
                echo "Langue: " . $exam['langue'] . "<br>";
                echo "Nom: " . $exam['nom'] . "<br>";
                echo "Niveau: " . $exam['niveau'] . "<br>";
                // You can display more attributes here if needed
            } else {
                echo "Exam not found with ID: $examId";
            }
        } else {
            // If the ID parameter is not set, display an error message
            echo "Error: Exam ID not provided.";
        }
    }
    ?>
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
        var idRegex = /^\d+$/; // Only digits
        var nomRegex = /^[a-zA-Z\s]{1,50}$/; // Letters and spaces, up to 50 characters
        var typeeRegex = /^[a-zA-Z\s]{1,10}$/; // Letters and spaces, up to 10 characters
        var niveauRegex = /^[1-3]$/; // Only 1, 2, or 3

        // ID validation
        if (!idRegex.test(id)) {
            event.preventDefault();
            errorDiv.innerHTML = "ID must contain only numbers.";
            return;
        }

        // Nom validation
        if (!nomRegex.test(nom)) {
            event.preventDefault();
            errorDiv.innerHTML = "Subject must contain letters only and be at most 50 characters long.";
            return;
        }

        // Typee validation
        if (!typeeRegex.test(typee)) {
            event.preventDefault();
            errorDiv.innerHTML = "Type must contain letters only and be at most 10 characters long.";
            return;
        }

        // Niveau validation
        if (!niveauRegex.test(niveau)) {
            event.preventDefault();
            errorDiv.innerHTML = "Level must be 1, 2, or 3.";
            return;
        }

        // File validation
        var fileInput = document.getElementById('file');
        var file = fileInput.files[0];
        if (!file) {
            event.preventDefault();
            errorDiv.innerHTML = "Please select an image file.";
            return;
        }
    });
</script>
</body>
</main>
</html>
