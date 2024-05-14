<?php
include '../controller/controllerprofile.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Partenaires</title>
  <link rel="logo" type="image/png" href="picture/logobil3orth.png">
  <link rel="stylesheet" href="index.css">
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
<h1 class="main-title">WHY JOIN Eduisland?</h1>
<div class="event-section">
  <!-- Ajoutez vos carrés ici -->
  <div class="square">
    <div class="square-content">
      
      <p class="description"><span>REGISTER FOR FREE</span></p>
      <p class="additional-text">No membership or subscription fees on Eduisland.</p>
      <p class="additional-text"> We only make money if you also make money.</p>
      <p class="additional-text"> by confirming your reservations.</p>
    </div>
  </div>
  <!-- More squares... -->
</div>
<!-- Profile Section -->
<div class="collaboration-section">
  <div class="collaboration">
    <h2>Choose a Profile</h2>
    <div class="collaboration-list">
      <!-- PHP loop to display profile items -->
      <?php
      // Assuming $profiles is an array containing profile data
      foreach ($profiles as $profile) {
        ?>
        <div class="collaboration-item">
          <h3><?php echo $profile['mail']; ?></h3>
          <p><?php echo $profile['disponibilite']; ?></p>
          <!-- Button to view profile details -->
          <button class="view-details-btn" onclick="viewProfileDetails(<?php echo $profile['idprofile']; ?>)">View Details</button>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</div>


<script>
  function viewProfileDetails(profileId) {
    // Redirect to partner.php with the profile ID as a parameter
    window.location.href = 'forum.php?id=' + profileId;
  }
</script>
</body>
</html>
