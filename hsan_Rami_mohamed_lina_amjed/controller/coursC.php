<?php

include  '../config.php';
include  '../model/cours.php';
    
$cours = new Cours($conn);

if (isset($_POST["submit_Add"])) {
  // Variables provenant du formulaire
    $matiere = $_POST["matiere"];
    $niveau = $_POST["niveau"];
    $nbheure = $_POST["nbheure"];
    $idt = $_POST["idt"];

    // Vérification si le cours existe déjà
    $sql_check = "SELECT * FROM lessons WHERE matiere = ? AND niveau = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->execute([$matiere, $niveau]);
    $result_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($result_check) {
        $message = "Error : The course is already existing";
    } else {
        // Ajout du cours dans la base de données
        $sql_insert = "INSERT INTO lessons (matiere, niveau, nbheure, idt) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $success = $stmt_insert->execute([$matiere, $niveau, $nbheure, $idt]);
        
        if ($success) {
            $message = "1";
        } else {
            $message = "-1";
        }
    }

    // Rediriger vers une autre page après l'ajout
    header("Location: add-cours.php?message=" . urlencode($message));
    exit;
}

    




/******************Update*************** */


    if(isset($_POST['submit_update'])) {
        if(isset($_POST["idlesson"])) {
            // Récupérer les données du formulaire
            $idlesson = $_POST["idlesson"];
            $matiere = $_POST["matiere"];
            $niveau = $_POST["niveau"];
            $nbheure = $_POST["nbheure"];
            $idt = $_POST["idt"];

            $message = $cours->updatecours($idlesson, $matiere, $nbheure, $niveau,  $idt);
            header("Location: index.php");
            }
    }




/************delete************ */

if(isset($_POST['submit_delete'])) {
    if(isset($_POST["idlesson"])) {
        $idlesson = $_POST["idlesson"];
        $message = $cours->deletecours($idlesson);
        echo $message;
        header("Location: index.php");
    } else {
        // Si l'identifiant de  cours n'est pas défini dans $_POST
        echo "cours ID is missing in the form submission.";
    }
}


/*************Affichage********************** */


$cours = $cours->getAllcours();

?>
