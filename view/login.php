<?php
include '../controller/User.php'; // Include the User class file

$message = ''; // Initialize an empty message

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  // Validate login credentials
  $userController = new User();
  $loginResult = $userController->loginUser($email,$password);
  if ($loginResult==1) 
    {
      header("Location: ../index.html");
    }
  else
    {
      // Login failed, set error message
      $message = "You don't have permission to access this page.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet">
  
  <style>
    .cascading-right {
      margin-right: -50px;
    }

    @media (max-width: 991.98px) {
      .cascading-right {
        margin-right: 0;
      }
    }

    /* Adjusted form size */
    .custom-form {
      max-width: 500px;
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
  <!-- Section: Design Block -->
  <a href="../index.html" class="brand">
    <img src="4.png" alt=" Logo" class="logo">
      <span class="text"><i class=""></i>EDUISLAND</span>
    </a>
  <section class="text-center text-lg-start">
    <!-- Jumbotron -->
    <div class="container py-4">
      <div class="row g-0 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <img src="../2.jpeg" class="w-100 rounded-4 shadow-4" alt="Home Learning" />
        </div>
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card cascading-right bg-body-tertiary custom-form" style="backdrop-filter: blur(30px);">
            <div class="card-body p-5 shadow-5 text-center">
              <h2 class="fw-bold mb-5">Login</h2>
              <form id="loginForm" method="POST">
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="email" id="email" class="form-control" name="email" />
                  <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" id="password" class="form-control" name="password" />
                  <label class="form-label" for="password">Password</label>
                </div>

                <!-- Message container for displaying errors -->
                <div id="message" class="small text-danger mb-3"><?php echo $message; ?></div>

                <!-- Submit button -->
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-custom btn-block mb-4">Login</button>
              </form>
              <div>
                <p class="mb-0">Don't have an account? <a href="signup.php">Sign Up</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Jumbotron -->
  </section>
  <!-- Section: Design Block -->

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- MDB -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#loginForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        var email = $('#email').val();
        var password = $('#password').val();

        // Check if email and password are not empty
        if (email.trim() != '' && password.trim() != '') {
          // Submit the form
          $(this).unbind('submit').submit();
        } else {
          // If email or password is empty, display an error message
          $('#message').text('Please enter email and password');
        }
      });
    });
  </script>
</body>

</html>
