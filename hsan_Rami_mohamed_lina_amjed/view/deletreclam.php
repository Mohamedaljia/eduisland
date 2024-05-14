<?php
include '../Controller/reclamC.php';
$reclam = new reclamsC();
$reclam->deletereclam($_GET["id"]);
header('Location:listreclam.php');