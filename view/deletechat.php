<?php
include '../Controller/userCchat.php';

$userC = new userC();

if (isset($_GET['deletid'])) {
    $username = $_GET['deletid'];

    $userC->deleteUser($username);

    header('Location: readchat.php');
    exit(); 
} else {
    echo '<pre>';
    var_dump($_GET);
    echo '</pre>';
    
}
?>