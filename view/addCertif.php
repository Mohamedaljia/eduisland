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
   
</head>
<body>
<div id="overlay"></div>

	<!-- SIDEBAR -->
	<section id="sidebar">
    <a href="../index.html" class="brand">
      <<img src="4.png" alt=" Logo" class="logo">
      <span class="text"><i class=""></i>EDUISLAND</span>
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
                <a href="#">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                    <span class="text">Partenaire</span>
                </a>
            </li>
            <li>
                <a href="index.php">
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
					<h1>certif</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">add new certif</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="listCertif.php">List of certif</a>
						</li>
					</ul>
                </div>
            <div class="table-data">    
			<div class="order">
					<div class="head">
						<h3>Add New certeficat</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>   
                <form action="" method="POST" id="examsForm">
                        <div class="mb-3">
                           <label for="id_certif">Id_certif:</label>
                            <input type="text" id="id_certif" name="id_certif" style="margin-left: auto; margin-right: auto; display: block;">
                                
                        </div>
            
                        <div class="mb-3">      
                            <td> <label for="id_exam">Id_exam:</label>
                            <select name="id_exam" id="id_exam" style="margin-left: auto; margin-right: auto; display: block;">
                            <?php foreach ($c as $exams) { ?>
                                <option value="<?php echo $exams['id']; ?>"><?php echo $exams['id']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">  
                            <label for="specialite">Specialite:</label>
                            <input type="text" id="specialite" name="specialite" style="margin-left: auto; margin-right: auto; display: block;">
                        </div>
                        <div class="mb-3">
                            <label for="id_etudiant">Id_etudiant:</label>
                            <input type="text" id="id_etudiant" name="id_etudiant" style="margin-left: auto; margin-right: auto; display: block;">
                        </div>
                        <div class="mb-3">
                            <label for="datee">Date:</label>
                            <input type="text" id="datee" name="datee" style="margin-left: auto; margin-right: auto; display: block;">
                        </div>                                                
                            <input type="submit" value="Save"  style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">
                            <input type="reset" value="Reset"  style="display: block; margin: 20px auto 0; background-color: #007bff; color: #fff; padding: 10px 20px; font-size: 1.2rem; border: none; border-radius: 5px;">
                            
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
