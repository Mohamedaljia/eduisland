<?php
include '../config.php';
include '../model/partenaire.php';

// Création d'une instance de la classe Partenaire
$partenaire = new Partenaire($conn);

if(isset($_POST["ajouter"])) {
    // Récupérer les données du formulaire
    $idprofile = $_GET['id'];
    $nom = $_POST["nom"];
    $contact = $_POST["contact"];
    $date_recru = $_POST["date_recru"];
    $adresse = $_POST["adresse"];
    $offre = $_POST["offre"];
    // Appeler la méthode createPartenaire pour insérer le partenaire dans la base de données
    $message = $partenaire->createPartenaire($idprofile, $nom, $contact, $date_recru, $adresse, $offre);
    
    // Rediriger vers forum.php avec un message de succès ou d'erreur
    header("Location: forum.php?id= ".$idprofile."& message=" . urlencode($message));
   
}

/************delete************ */

if(isset($_POST['delete'])) {
    if(isset($_POST["idpartenaire"])) {
        $idpartenaire = $_POST["idpartenaire"];
        $message = $partenaire->deletePartenaire($idpartenaire);
        echo $message;
        header("Location: index.php");
    } else {
        // Si l'identifiant du partenaire n'est pas défini dans $_POST
        echo "Partenaire ID is missing in the form submission.";
    }
}
/******************Update*************** */


if(isset($_POST['update'])) {
    if(isset($_POST["idpartenaire"])) {
        // Récupérer les données du formulaire
        $idpartenaire = $_POST["idpartenaire"];
        $idprofile = $_POST["idprofile"];
        $nom = $_POST["nom"];
        $contact = $_POST["contact"];
        $date_recru = $_POST["date_recru"];
        $adresse = $_POST["adresse"];
        $offre = $_POST["offre"];
        $message = $partenaire->updatePartenaire($idpartenaire, $idprofile, $nom, $contact, $date_recru, $adresse, $offre);
        header("Location: index.php");
    }
}

/*************Affichage********************** */

// Récupérer tous les partenaires à afficher
$partenaires = $partenaire->getAllPartenaires();

?>
