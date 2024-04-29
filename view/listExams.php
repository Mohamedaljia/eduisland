<?php
include "../controller/ExamsC.php";

$c = new ExamsC();
$tab = $c->listExams();

?>

<center>
    <h1>List of Exams</h1>
    <h2>
        <a href="addExams.php">Add Exam</a>
    </h2>
</center>
<table border="1" align="center" width="70%" style="border-collapse: collapse; margin-top: 30px;">
    <tr style="background-color: #f2f2f2;">
        <th style="padding: 10px;">Id</th>
        <th style="padding: 10px;">nom</th>
        <th style="padding: 10px;">typee</th>
        <th style="padding: 10px;">langue</th>
        <th style="padding: 10px;">niveau</th>
        <th style="padding: 10px;">Image</th>
        <th style="padding: 10px;"></th>

    </tr>

    <?php
    foreach ($tab as $exams) {
    ?>

        <tr style="background-color: #ffffff;">
            <td style="padding: 10px;"><?= $exams['id']; ?></td>
            <td style="padding: 10px;"><?= $exams['nom']; ?></td>
            <td style="padding: 10px;"><?= $exams['typee']; ?></td>
            <td style="padding: 10px;"><?= $exams['langue']; ?></td>
            <td style="padding: 10px;"><?= $exams['niveau']; ?></td>
            <td style="padding: 10px;"><img src="<?= isset($exams['image_path']) ? $exams['image_path'] : '' ?>" alt="Exam Image" style="max-width: 100px; max-height: 100px;"></td>


            <td style="padding: 10px; text-align: center;">
                <form method="POST" action="updateExams.php">
                    <input type="submit" name="update" value="Update" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">
                    <input type="hidden" value="<?php echo $exams['id']; ?>" name="id">
                </form>
                <a href="deleteExams.php?id=<?php echo $exams['id']; ?>" style="color: #dc3545; text-decoration: none; margin-left: 5px;">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
