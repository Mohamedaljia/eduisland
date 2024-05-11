<?php
include '../Controller/ExamsC.php';
$examsC = new ExamsC();
$examsC->deleteExams($_GET["id"]);
header('Location:listExams.php');