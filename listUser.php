<?php
include "../controller/User.php";

$c = new User();
$tab = $c->listUserC();

?>

<center>
    <h1>List of UserC</h1>
    <h2>
        <a href="addUser.php">Add User</a>
    </h2>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>Id</th>
        <th>nom</th>
        <th>prenom</th>
        <th>email</th>
        <th>mdp</th>
        <th></th>
       
    </tr>

    <?php
    foreach ($tab as $User) {
    ?>

        <tr>
            <td><?= $User['id']; ?></td>
            <td><?= $User['nom']; ?></td>
            <td><?= $User['prenom']; ?></td>
            <td><?= $User['email']; ?></td>
            <td><?= $User['mdp']; ?></td>
            <td align="center">
                <form method="POST" action="updateUser.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value="<?php echo $User['id']; ?>" name="id">
                </form>
                <a href="deleteUser.php?id=<?php echo $User['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
