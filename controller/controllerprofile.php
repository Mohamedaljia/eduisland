<?php
include '../../config.php';
include '../../model/profile.php';

$profiles = new profile($conn);

// Ajout d'un nouveau profil
if (isset($_POST["submit_Add"])) {
    // Récupérer les données envoyées par AJAX
    $cv = $_POST["cv"];
    $date_creation = $_POST["date_creation"];
    $disponibilite = $_POST["disponibilite"];
    $mail = $_POST["mail"];
    $message = $profiles->createProfile($cv, $date_creation, $disponibilite, $mail);
   
    header("Location: add-profile.php");
}

// Mise à jour d'un profil
if (isset($_POST['submit_update'])) {
    if (isset($_POST["idprofile"])) {
        // Récupérer les données du formulaire
        $idprofile = $_POST["idprofile"];
        $cv = $_POST["cv"];
        $date_creation = $_POST["date_creation"];
        $disponibilite = $_POST["disponibilite"];
        $mail = $_POST["mail"];
        $message = $profiles->updateProfile($idprofile, $cv, $date_creation, $disponibilite, $mail);
        header("Location: add-profile.php");
    }
}

// Suppression d'un profil
if (isset($_POST['submit_delete'])) {
    if (isset($_POST["idprofile"])) {
        // Récupérer l'identifiant du profil à supprimer
        $idprofile = $_POST["idprofile"];

        // Appeler la fonction deleteProfile de la classe appropriée pour effectuer la suppression
        $message = $profiles->deleteProfile($idprofile);

        // Afficher le message de succès ou d'erreur
        echo $message;
        header("Location: add-profile.php");
    } else {
        // Si l'identifiant du profil n'est pas défini dans $_POST
        echo "Profile ID is missing in the form submission.";
    }
}

// Récupération de tous les profils
$profiles = $profiles->getAllProfiles();

?>
