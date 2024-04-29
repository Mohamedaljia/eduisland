<?php
include "../controller/CertifC.php";

$c = new CertifC();
$tab = $c->listcertif();

?>


<center>
    <h1>List of Certificates</h1>
    <h2>
        <a href="addCertif.php">Add Certificate</a>
    </h2>
</center>
<table border="1" align="center" width="70%" style="border-collapse: collapse; margin-top: 30px;">
    <tr style="background-color: #f2f2f2;">
        <th style="padding: 10px;">Id_certif</th>
        <th style="padding: 10px;">Id_exam</th>
        <th style="padding: 10px;">Date</th>
        <th style="padding: 10px;">Speciality</th>
        <th style="padding: 10px;">Id_etudiant</th>
        <th style="padding: 10px;"></th>

    </tr>

    <?php
    foreach ($tab as $certif) {
    ?>

        <tr style="background-color: #ffffff;">
            <td style="padding: 10px;"><?= $certif['id_certif']; ?></td>
            <td style="padding: 10px;"><?= $certif['id_exam']; ?></td>
            <td style="padding: 10px;"><?= $certif['datee']; ?></td>
            <td style="padding: 10px;"><?= $certif['specialite']; ?></td>
            <td style="padding: 10px;"><?= $certif['id_etudiant']; ?></td>
            <td style="padding: 10px; text-align: center;">
                <form method="POST" action="updateCertif.php">
                    <input type="submit" name="update" value="Update" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">
                    <input type="hidden" value="<?php echo $certif['id_certif']; ?>" name="id_certif">
                </form>
                <a href="deleteCertif.php?id=<?php echo $certif['id_certif']; ?>" style="color: #dc3545; text-decoration: none; margin-left: 5px;">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
