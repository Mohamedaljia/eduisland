<?php

//include 'C:\XAMPP\htdocs\projetWEB\controller/reclamC.php';
//include 'C:\XAMPP\htdocs\projetWEB\model/reclamC.php';
include '../controller/reclamC.php';
include '../model/reclamC.php';



$error = "";

// create client
$reclams = null;

// create an instance of the controller
$reclamC = new reclamsC();
if (
    isset($_POST["idR"]) &&
    isset($_POST["idU"]) &&
    isset($_POST["subjectt"]) &&
    isset($_POST["descriptionn"]) &&
    isset($_POST["feedback"])
) {
    echo "Form submitted!"; // Debugging message

    if (
        !empty($_POST['idR']) &&
        !empty($_POST["idU"]) &&
        !empty($_POST["subjectt"]) &&
        !empty($_POST["descriptionn"]) &&
        !empty($_POST["feedback"])
    ) {
        echo "All fields filled!"; // Debugging message
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }

        $reclams = new reclamC(
            
            $_POST['idR'],
            $_POST['idU'],
            $_POST['subjectt'],
            $_POST['descriptionn'],
            $_POST['feedback']
        );
        try {
            // Add Exams to database
            $reclamC->addreclam($reclams);
            // Redirect to listExams.php after successful addition
            header('Location: listreclam.php');
            exit(); // Ensure no further code execution after redirection
        } catch (Exception $e) {
            $error = "Error adding reclam: " . $e->getMessage();
            echo $error; // Display error message for debugging
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
    <meta charset="utf-8">
    <title>Reclamation Form</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        .footer-links {
            margin-top: 50px;
        }

        .footer-links a {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>

<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <div class="container">
            <!-- Navbar Content -->
            <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
                <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>EDUISLAND</h2>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="../index.html" class="nav-item nav-link active">Home</a>
                    <a href="../about.html" class="nav-item nav-link">About</a>
                    <a href="../courses.html" class="nav-item nav-link">Courses</a>
                    <a href="../gestion.html" class="nav-item nav-link active">Exams</a>
                    <a href="../reclamation.html" class="nav-item nav-link active">Reclamation</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu fade-down m-0">
                            <a href="../team.html" class="dropdown-item">Our Team</a>
                            <a href="../testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="../404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div>
                    <a href="../contact.html" class="nav-item nav-link">Contact</a>
                </div>
                <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Join Now<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container">
        <h1>Reclamation Form</h1>
        <form id="reclamationForm" method="POST">
            <div class="mb-3">
                <label for="reclamationId" class="form-label">Reclamation ID</label>
                <input type="text" class="form-control" id="reclamationId" name="idR">
            </div>
            <div class="mb-3">
                <label for="userId" class="form-label">User ID</label>
                <input type="text" class="form-control" id="userId" name="idU">
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select class="form-select" id="subjectt" name="subjectt">
                    <option value="description">Description</option>
                    <option value="feedback">Feedback</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="descriptionn" name="descriptionn" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="feedback" class="form-label">Feedback</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
            </div>
            <input type="submit" value="Save">
        </form>
    </div>

    <!-- Back to list and Search the responses section -->
    <div class="container footer-links">
        <a href="listreclam.php" class="btn btn-primary">Back to list</a>
        <a href="reponseF.php" class="btn btn-primary">Search the responses</a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
