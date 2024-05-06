<?php

//include 'C:\XAMPP\htdocs\projetWEB\controller/reclamC.php';
//include 'C:\XAMPP\htdocs\projetWEB\model/reclamC.php';
include '../controller/reclamC.php';
include '../model/reclamC.php';
require_once __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

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
   // echo "Form submitted!"; // Debugging message

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
             // Add reclam to the database
             $reclamC->addreclam($reclams);

             // Create a new PHPMailer instance
             $mail = new PHPMailer(true);
 
             // SMTP configuration for Gmail
             $mail->isSMTP();
             $mail->Host = 'smtp.gmail.com';
             $mail->SMTPAuth = true;
             $mail->Username = 'linatekaya00@gmail.com';  // Replace with your Gmail address
             $mail->Password = 'hddg gjyu lljj voll';          // Replace with your Gmail password
             $mail->SMTPSecure = 'tls';
             $mail->Port = 587;
 
             // Sender and recipient settings
             $mail->setFrom('linatekaya00@gmail.com', 'lina');
             $mail->addAddress('innaask1608@gmail.com', 'INNA');
 
             // Create email body with form data
             $emailBody = '<h3>New Reclamation</h3>' .
                          '<p><strong>Reclamation ID:</strong> ' . $_POST['idR'] . '</p>' .
                          '<p><strong>User ID:</strong> ' . $_POST['idU'] . '</p>' .
                          '<p><strong>Subject:</strong> ' . $_POST['subjectt'] . '</p>' .
                          '<p><strong>Description:</strong> ' . $_POST['descriptionn'] . '</p>' .
                          '<p><strong>Feedback:</strong> ' . $_POST['feedback'] . '</p>';
 
             // Set email content type to HTML
             $mail->isHTML(true);
 
             // Set email subject
             $mail->Subject = 'New Reclamation';
 
             // Set email body
             $mail->Body = $emailBody;
 
             // Send email
             $mail->send();
             echo 'Email has been sent successfully';
 
             // Redirect to listreclam.php after successful addition
             header('Location: forum.php');
             exit();
        } catch (Exception $e) {
            $error = "Error adding reclam: " . $e->getMessage();
            echo $error; // Display error message for debugging
        }
    } else {
        $error = "Missing information";
        //echo "Missing information!<br>"; // Debugging message
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

    .error {
        color: red;
    }
</style>

</head>

<body>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <div class="container">
            <!-- Navbar Content -->
            <a href="../index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
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
                    <a href="forum.php" class="nav-item nav-link active">Reclamation</a>

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
                <a href="#" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block"  onclick="showMessageBox('list')">Join Now<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container">
        <h1>Reclamation Form</h1>
        <form id="reclamationForm" method="POST">
            <div class="mb-3">
                <label for="reclamationId" class="form-label">Reclamation ID</label>
                <input type="text" class="form-control" id="idR" name="idR">
                <div id="erreurid" class="error"></div> <!-- This is where error message will be displayed -->
            </div>
            <div class="mb-3">
                <label for="userId" class="form-label">User ID</label>
                <input type="text" class="form-control" id="idU" name="idU">
                <div id="erreuridu" class="error"></div> <!-- This is where error message will be displayed -->
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select class="form-select" id="subjectt" name="subjectt">
                    <option value="Cours">Cours</option>
                    <option value="Prof">Prof</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="desc" name="descriptionn" rows="3"></textarea>
                <div id="erreurTypee" class="error"></div> <!-- This is where error message will be displayed -->
            </div>
            <div class="mb-3">
                <label for="feedback" class="form-label">Feedback</label>
                <textarea class="form-control" id="fed" name="feedback" rows="3"></textarea>
                <div id="erreurNom" class="error"></div> <!-- This is where error message will be displayed -->
            </div>
            <input type="submit" value="Save">
        </form>
    </div>

    <!-- Back to list and Search the responses section -->
    <div class="container footer-links">
        <!--<a href="#" class="btn btn-primary" onclick="showMessageBox('list')">Back to list</a>-->
       <!-- <a href="#" class="btn btn-primary" onclick="showMessageBox('search')">Search the responses</a>-->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        document.getElementById('reclamationForm').addEventListener('submit', function(event) {
            var idR = document.getElementById('idR').value.trim();
            var idU = document.getElementById('idU').value.trim();
            var description = document.getElementById('desc').value.trim();
            var feedback = document.getElementById('fed').value.trim();

            // Clear previous error messages
            document.getElementById("erreurid").innerHTML = '';
            document.getElementById("erreuridu").innerHTML = '';
            document.getElementById("erreurTypee").innerHTML = '';
            document.getElementById("erreurNom").innerHTML = '';

            // Regular expressions for validation
            var idRegex = /^\d+$/;
            var descriptionRegex = /^.{1,500}$/;
            var feedbackRegex = /^.{1,100}$/;

            // Validation for idR
            if (!/^\d+$/.test(idR)) {
                event.preventDefault();
                document.getElementById("erreurid").innerHTML = "ID must be a number.";
            }

            // Validation for idU
            if (!/^\d+$/.test(idU)) {
                event.preventDefault();
                document.getElementById("erreuridu").innerHTML = "ID USER must be a number.";
            }
           
            // Validation for description length
            if (!descriptionRegex.test(desc)) {
                event.preventDefault();
                document.getElementById("erreurTypee").innerHTML = "Description must have fewer than 500 characters";
            }

            // Validation for feedback length
            if (!feedbackRegex.test(fed)) {
                event.preventDefault();
                document.getElementById("erreurNom").innerHTML = "Feedback must have fewer than 100 characters";
            }
        });
    </script>
   
<!-- JavaScript to show message box -->
<script>
    function showMessageBox(action) {
    var code = prompt("Enter the code to access the link:");
    if (code === '123') {
        // Redirect based on action
        if (action === 'list') {
            window.location.href = 'listreclam.php';
        } else if (action === 'search') {
            window.location.href = 'reponseF.php';
        }
    } else {
        // Show an alert if the code is incorrect
        alert("Incorrect code. Please try again.");
    }
}


</script>

</body>

</html>
