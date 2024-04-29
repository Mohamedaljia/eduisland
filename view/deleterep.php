<?php
include '../Controller/reponseC.php';

// Check if ID is set
if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $reponse = new ReponsesC();
    
    // Attempt to delete response
    try {
        $reponse->deletereponse($id);
        header('Location:reponseF.php');
    } catch (PDOException $e) {
        // Handle any errors
        die('Error deleting response: ' . $e->getMessage());
    }
} else {
    echo "No ID specified for deletion.";
}
?>
