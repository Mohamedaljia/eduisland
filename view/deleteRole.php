<?php
include '../Controller/Role.php';
$role = new Role ();
$role->deleteRoleC($_GET["id_role"]);
header('Location: listRole.php');
exit();
