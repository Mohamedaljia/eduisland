<?php
include "../controller/CertifC.php";
$certifC = new CertifC();
$certifC->deletecertif($_GET["id"]);
header('Location:listCertif.php');