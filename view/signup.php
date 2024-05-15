<?php
// Enable error reporting to display PHP errors or warnings
include '../controller/User.php';
include '../model/User.php';
use PHPMailer\PHPMailer\PHPMailer;
$error = "";

// create client
$userr = null;

// create an instance of the controller
$UserC = new User();
if (
    isset($_POST["id"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["mdp"])&&
    isset($_POST["occupation"])

) {
    echo "Form submitted!"; // Debugging message

    if (
        !empty($_POST['id']) &&
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["mdp"])&&
        !empty($_POST["occupation"])
    ) {
        echo "All fields filled!"; // Debugging message
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }

        $userr = new UserC(
            
            $_POST['id'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['mdp'],
            $_POST['occupation']

        );
        try {
            $UserC->addUserC($userr);

            // Create a new PHPMailer instance
            $sender_name = 'EduIsland';
            $sender_email = 'amjedchemchik1@gmail.com';
            $recipient_email = $_POST["email"];
            $subject = 'Confirmation Code';
            $confirmation_code = 'Your generated confirmation code'; // Generate your confirmation code here
            $message = 'Your confirmation code is: ' ;

            // Send email
            if (mail($recipient_email, $subject, $message , "From: $sender_name <$sender_email>")) {
                echo "Confirmation code sent successfully to $recipient_email";
            } else {
                echo "Failed to send confirmation code";
            }

            // Create email body with form data
            
            // Redirect to listExams.php after successful addition
            header('Location: signup.php');
            exit(); // Ensure no further code execution after redirection
        } catch (Exception $e) {
            $error = "Error adding user: " . $e->getMessage();
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet">
  <style>
    /* Adjusted form size */
    .custom-form {
      max-width: 400px;
      margin: 0 auto;
    }

    /* Custom button color */
    .btn-custom {
      background-color: rgb(5, 198, 216);
      border-color: #06BBCC;
    }

    .btn-custom:hover {
      background-color: #05a8b5;
      border-color: #05a8b5;
    }

    /* CSS style for error message */
    #message {
      font-size: smaller;
      color: red;
    }
    .brand .logo {
    width: 100px;
    /* Réglez la largeur de l'image selon vos préférences */
    height: 70px;
    /* Réglez la hauteur de l'image selon vos préférences */
}
  </style>
</head>

<body>
<a href="../index.html" class="brand">
    <img src="4.png" alt=" Logo" class="logo">
      <span class="text"><i class=""></i>EDUISLAND</span>
    </a>
  <section class="text-center text-lg-start">
    <div class="container py-4">
      <div class="row">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <img src="../2.jpeg" class="w-100 rounded-4 shadow-4" alt="Home Learning" />
        </div>
        <div class="col-lg-6 ">
<div class="container py-4 mt-5 mt-lg-5 mt-xl-5">

        <div class="card custom-form mx-auto" style="max-width: 500px;">    
            <div class="card-body p-5">
              <h2 class="fw-bold mb-4">Sign Up</h2>
              <form id="signUpForm" method="POST">
                <!-- ID input -->
                <div class="form-outline mb-4">
                  <input type="text" id="id" class="form-control" name="id">
                  <label class="form-label" for="id">ID</label>
                </div>

                <!-- Nom input -->
                <div class="form-outline mb-4">
                  <input type="text" id="nom" class="form-control" name="nom">
                  <label class="form-label" for="nom">Name</label>
                </div>

                <!-- Prenom input -->
                <div class="form-outline mb-4">
                  <input type="text" id="prenom" class="form-control" name="prenom">
                  <label class="form-label" for="prenom">Forname</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="email" class="form-control" name="email">
                  <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="mdp" class="form-control" name="mdp">
                  <label class="form-label" for="password">Password</label>
                </div>

                <!-- Occupation input -->
                <div class="form-outline mb-4">
                  <!--<input type="text" id="occupation" class="form-control" name="occupation" required>
                  <label class="form-label" for="occupation">Occupation</label>-->
                  <label class="form-label" for="occupation">Occupation</label>
                  <select class="form-select" id="occupation" name="occupation">
                    <option value="1">Professor</option>
                    <option value="2">Student</option>
                    <option value="3">Intern</option>
                </select>
                </div>

                <!-- Message container for displaying errors -->

                <!-- Submit button -->
                <button type="submit" class="btn btn-custom btn-block mb-4">Sign Up</button>
                
              </form>
              <div>
                <p class="mb-0">Already have an account? <a href="login.php">Sign In</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>

</html>
