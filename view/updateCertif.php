<?php
include '../Controller/CertifC.php';
include '../model/CertifC.php';

$error = "";
$certifC = new CertifC();

if (
    isset($_POST["id_certif"]) &&
    isset($_POST["id_exam"]) &&
    isset($_POST["datee"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["prenom"])
) {
    if (
        !empty($_POST['id_certif']) &&
        !empty($_POST['id_exam']) &&
        !empty($_POST['datee']) &&
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"])
    ) {
        $id_certif = $_POST['id_certif'];
        $id_exam = $_POST['id_exam'];
        $datee = $_POST['datee'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        try {
            $certif = new Certif($id_certif, $id_exam, $datee, $nom, $prenom);
            $certifC->updatecertif($certif, $id_certif);
            header('Location:listCertif.php');
            exit();
        } catch (Exception $e) {
            $error = "Error updating certif: " . $e->getMessage();
        }
    } else {
        $error = "Missing information";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>
<body>
    <button><a href="listCertif.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id_certif'])) {
        $certif = $certifC->showcertif($_POST['id_certif']);
    ?>
        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="id_certif">Id :</label></td>
                    <td>
                        <input type="text" id="id_certif" name="id_certif" value="<?php echo $certif['id_certif']; ?>" readonly />
                    </td>
                </tr>
                <tr>
                    <td><label for="id_exam">Id_exam :</label></td>
                    <td>
                        <input type="text" id="id_exam" name="id_exam" value="<?php echo $certif['id_exam']; ?>" readonly />
                    </td>
                </tr>
                <tr>
                    <td><label for="datee">date :</label></td>
                    <td>
                        <input type="text" id="datee" name="datee" value="<?php echo $certif['datee']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">nom :</label></td>
                    <td>
                        <input type="text" id="nom" name="nom" value="<?php echo $certif['specialite']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td><label for="prenom">prenom :</label></td>
                    <td>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $certif['id_etudiant']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save">
                    </td>
                </tr>
            </table>
        </form>
    <?php
    }
    ?>
</body>
</html>
