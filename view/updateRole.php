<?php
include '../Controller/Role.php';
include '../model/Role.php';
$error = "";

// Création d'une instance du contrôleur
$RoleC = new Role();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["id_role"]) &&
        isset($_POST["type"])
    ) {
        if (
            !empty($_POST['id_role'])&&
            !empty($_POST["type"])
        ) {

           
            $role = new Role(
                $_POST['id_role'],
                $_POST['type']
            );
            $rols= new RoleC($id_role,$type);

            $RoleC->updateRoleC($rols,$id_role); // Utilisez id_user pour l'ID à mettre à jour

            header('Location: listRole.php');
            //exit(); // Assurez-vous de quitter le script après la redirection
        }  else 
            $error = "Missing information";
        
    }
}

// Affichage du reste du code HTML (le formulaire)
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Update</title>
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

  

    <div id="error">
        <?php echo $error; ?>
    </div>
    <div class="container">
        <h1>Role Form</h1>
        <?php
        // Affichage du formulaire avec les données du rôle à mettre à jour
        
        ?>

<form id="RoleForm" method="POST"> <!-- Ensure you specify the method as POST -->
                <div class="mb-3 row">
                    <label for="id_role" class="col-sm-2 col-form-label">Id role</label>
                  
                        <input type="text" class="form-control" id="id_role" name="id_role" value="<?php echo $_POST['id_role'] ?>" >
                        <span id="erreurNom" style="color: red"></span>
                </div>
                <div class="mb-3 row">
                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                    
                        <input type="text" class="form-control" id="type" name="type">
                        <span id="erreurnom" style="color: red"></span>
                  
                </div>
               
                <button type="submit" class="btn btn-primary">Save</button> 
            <a href="listRole.php" class="btn btn-primary">Back to list</a>
            </form>
        <?php
        ?>
    </div>
    
</body>

</html>
