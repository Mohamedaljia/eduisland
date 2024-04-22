<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "devops";

// Établir une connexion à la base de données
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Afficher un message de réussite
//echo "Connected successfully";
?>