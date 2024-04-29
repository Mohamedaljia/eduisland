<?php
// Enable error reporting to display PHP errors or warnings
include '../Controller/CertifC.php';
include '../model/CertifC.php';
include '../Controller/ExamCertif.php';
include '../model/examCerif.php';

include_once '../model/examCerif.php';


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
    <title>Exams</title>
      <!-- Favicon -->
      <link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->

<!-- Icon Font Stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="css/style.css" rel="stylesheet">
    <style>
        /* CSS for Form Styling */
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
           justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /*.container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        .container h2 {
            color: #27abb4e5;
           /* text-align: center;
            margin-bottom: 20px;
        }*/

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"],
        .form-group input[type="reset"] {
            width: 49%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group input[type="submit"] {
            background-color: #27abb4e5;
            color: #fff;
        }

        .form-group input[type="submit"]:hover {
            background-color: #27abb4e5;
        }

        .form-group input[type="reset"] {
            background-color: #27abb4e5;
            color: #fff;
        }

        .form-group input[type="reset"]:hover {
            background-color: #27abb4e5;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    

<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <div class="">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>EDUISLAND</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="courses.html" class="nav-item nav-link">Courses</a>
                <a href="gestion.html" class="nav-item nav-link active">Exams</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Join Now<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </div>
 </nav>

    <div class="container">
        <h2>formule de certeficat</h2>
        <form action="" method="POST" id="examsForm">
            <div class="form-group">
                <label for="id_certif">Id_certif:</label>
                <input type="text" id="id_certif" name="id_certif" />
            </div>
            <div class="form-group">
                <label for="id_exam">Id_exam:</label>
                <select name="id_exam" id="id_exam">
                    <?php foreach ($c as $exams) { ?>
                        <option value="<?php echo $exams['id']; ?>"><?php echo $exams['id']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="specialite">Specialite:</label>
                <input type="text" id="specialite" name="specialite" />
            </div>
            <div class="form-group">
                <label for="id_etudiant">Id_etudiant:</label>
                <input type="text" id="id_etudiant" name="id_etudiant" />
            </div>
            <div class="form-group">
                <label for="datee">Date:</label>
                <input type="text" id="datee" name="datee" />
            </div>
            <div class="form-group">
                <input type="submit" value="Save">
                <input type="reset" value="Reset">
            </div>
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

</html>
