<?php
include '../Controller/User.php';
include '../model/User.php';
$error = "";

// create User
$user = null;
// create an instance of the controller
$userController = new User;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (
    
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["mdp"])&&
    isset($_POST["occupation"])

) {
    if (
        
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["mdp"])&&
        !empty($_POST["occupation"])

        
    ) {

        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $user = new UserC(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['mdp'],
            $_POST['occupation']

        );
        var_dump($user);
        $userController->updateUserC($user, $_POST['id']);

        header('Location:listUser.php');
    } else
        $error = "Missing information";

    }
}

// Affichage du reste du code HTML (le formulaire)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add User</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
   

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

</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow sticky-top p-0">
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
                <a href="../contact.html" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <div class="container">
        <h1>User Form</h1>
        <?php
        // Affichage du formulaire avec les données de l'utilisateur à mettre à jour
        if (isset($_POST['id'])) {
            $user = $userController->showUserC($_POST['id']);
        ?>
            <form id="UserForm" method="POST"> <!-- Ensure you specify the method as POST -->
                <div class="mb-3 row">
                    <label for="userId" class="col-sm-2 col-form-label">Id</label>
                  
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $_POST['id'] ?>" >
                        <span id="erreurNom" style="color: red"></span>
                </div>
                <div class="mb-3 row">
                    <label for="userNom" class="col-sm-2 col-form-label">Nom</label>
                    
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $user['nom'] ?>">
                        <span id="erreurnom" style="color: red"></span>
                  
                </div>
                <div class="mb-3 row">
                    <label for="userPrenom" class="col-sm-2 col-form-label">Prenom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $user['prenom'] ?>">
                        <span id="erreurPrenom" style="color: red"></span>
                   
                </div>
                <div class="mb-3 row">
                    <label for="userEmail" class="col-sm-2 col-form-label">Email</label>
                    
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'] ?>">
                        <span id="erreurEmail" style="color: red"></span>
                   
                </div>
                <div class="mb-3 row">
                    <label for="userMdp" class="col-sm-2 col-form-label">Mdp</label>
                    
                        <input type="password" class="form-control" id="mdp" name="mdp" value="<?php echo $user['mdp'] ?>">
                        <span id="erreurMdp" style="color: red"></span>
                    
                </div>
                <div class="mb-3 row">
                    <label for="userOccupation" class="col-sm-2 col-form-label">Occupation</label>
                    
                        <input type="occupation" class="form-control" id="occupation" name="occupation" value="<?php echo $user['occupation'] ?>">
                        <span id="erreurOccupation" style="color: red"></span>
                    
                </div>
                <button type="submit" class="btn btn-primary">Save</button> 
            <a href="listUser.php" class="btn btn-primary">Back to list</a>
            </form>

        <?php
        } ?>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
