<?php
include '../Controller/User.php';
$Userc = new User();
$Userc->deleteUserC($_GET["id"]);
header('Location:listUser.php');