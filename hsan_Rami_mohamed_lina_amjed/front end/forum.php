<?php
include '../controller/controllerprofile.php';
include '../config.php';
include '../controller/controllerpartenaire.php';

if(isset($_GET['id'])) {
  // Récupérer et nettoyer l'ID de profil de l'URL
  $idprofile = $_GET['id'];
  $profiles = array();

  // Requête SQL pour récupérer les informations du profil en fonction de l'ID
  $sql = "SELECT cv, date_creation, disponibilite , mail FROM profile WHERE idprofile = :idprofile";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':idprofile', $idprofile, PDO::PARAM_INT);
  $stmt->execute();
  
  // Vérifier si la requête a retourné des résultats
  if($stmt->rowCount() > 0) {
      // Récupérer les informations du profil
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $cv = $row['cv'];
      $date_creation = $row['date_creation'];
      $disponibilite = $row['disponibilite'];
      $mail = $row['mail'];
  } else {
      // Gérer le cas où aucun profil n'est trouvé pour l'ID donné
      $cv = "CV inconnu";
  }
} else {
  // Gérer le cas où l'ID de profil n'est pas présent dans l'URL
  $cv = "ID de profil non spécifié";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Formulaire</title>
  <link rel="stylesheet" href="form.css">
</head>
<body>
<div class="container">
  <!-- Logo -->
  <div class="logo">
    <a href="#"><img src="picture/logobil3orth.png" alt="Logo"></a>
  </div>
  
  <!-- Items -->
  <div class="items">
    <a href="http://www.Home.com">Home</a>
    <a href="http://www.Discover.com">Discover</a>
    <a href="http://www.SpecialDeals.com">Special Deals</a>
    <a href="http://www.contact.com">Contact</a>
    <!-- Autres items -->
  </div>
  
  <!-- Login -->
  <div class="login">
    <button type="submit">Login</button>
    <button type="submit">Sign in</button>
  </div>
</div>

<div class="containeri">

  <form onsubmit="return validateForm()" name="Form" class="join-form"  method="POST">
  <h1 class="main-title">Join <?php echo $cv; ?></h1>
  <div class="recrutement-info">
      <p><strong>CV:</strong> <?php echo $cv; ?></p>
      <p><strong>Date de creation:</strong> <?php echo $date_creation; ?></p>
      <p><strong>Disponibilite:</strong> <?php echo $disponibilite; ?></p>
      <p><strong>Mail:</strong> <?php echo $mail; ?></p>
    </div>
    <div class="form-group">
    <label for="nom_partenaire">Nom:</label>
    <input type="text" id="nom" name="nom">
    
</div>
<div class="form-group">
    <label for="contact">Contact:</label>
    <input type="text" id="contact" name="contact">
   
</div>
<div class="form-group">
    <label for="date_recru">Date de recrutement:</label>
    <input type="date" id="date_recru" name="date_recru">
    
</div>
<div class="form-group">
    <label for="adresse">Adresse:</label>
    <textarea id="adresse" name="adresse"></textarea>
    
</div>
<div class="form-group">
    <label for="offre">offre:</label>
    <input id="offre" name="offre"></input>
    <p id="error-message" style="color:red;"></p>
   
</div>
    <button type="submit" name="ajouter" class="main-button">Submit</button>
  </form>
  </div>
  <script>
function validateForm() {
    var a = document.getElementById('error-message');
    a.textContent = "";

    var nom = document.forms["Form"]["nom"].value;
    var contact = document.forms["Form"]["contact"].value;
    var date_recru = document.forms["Form"]["date_recru"].value;
    var adresse = document.forms["Form"]["adresse"].value;
    var offre = document.forms["Form"]["offre"].value;

    // Validation for name (nom), address (adresse), and offer (offre) fields
    var nameRegex = /^[A-Za-zÀ-ÿ\s]+$/; // Only alphabetical characters and spaces
    if (!nom.match(nameRegex)) {
        a.textContent = "Le champ nom doit contenir uniquement des lettres";
        return false;
    }
    // Validation for the contact field to ensure it's numeric
    var contactRegex = /^\d+$/; // Only numeric characters
    if (!contact.match(contactRegex)) {
        a.textContent = "Le champ contact doit contenir uniquement des chiffres";
        return false;
    }
    // Validation for the date field to ensure it's in the format 'dd/mm/yyyy'
    /*var dateRegex = /^\d{2}\/\d{2}\/\d{4}$/; // Format 'dd/mm/yyyy'
    if (!date_recru.match(dateRegex)) {
        a.textContent = "Le format de la date doit être 'dd/mm/yyyy'";
        return false;
    }*/
    if (!adresse.match(nameRegex)) {
        a.textContent = "Le champ adresse doit contenir uniquement des lettres";
        return false;
    }
    if (!offre.match(nameRegex)) {
        a.textContent = "Le champ offre doit contenir uniquement des lettres";
        return false;
    }


    

    // Validation for the date field to ensure it's not in the past
    var parts = date_recru.split('/');
    var day = parseInt(parts[0], 10);
    var month = parseInt(parts[1], 10) - 1; // Month is zero-based
    var year = parseInt(parts[2], 10);
    var selectedDate = new Date(year, month, day);
    var today = new Date();
    if (selectedDate < today) {
        a.textContent = "La date de recrutement ne peut pas être dans le passé";
        return false;
    }

    // Additional validation for other fields can be added here if needed

    // If all validations pass, return true
    return true;
}
</script>







</body>
</html>
