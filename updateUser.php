<?php
include '../Controller/User.php';
include '../model/User.php';
$error = "";

// create User
$user = null;
// create an instance of the controller
$userController = new User;

if (
    isset($_POST["id"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["mdp"])
) {
    if (
        !empty($_POST['id']) &&
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["mdp"])
    ) {
        // Construction de l'objet User avec les données du formulaire
        $user = new User($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp']);

        // Appel de la méthode updateUserC pour mettre à jour l'utilisateur
        $userController->updateUserC($user);

        // Redirection vers une page de confirmation ou autre
        header('Location: listUser.php');
        exit(); // Arrête l'exécution du script après la redirection
    } else {
        $error = "Missing information";
    }
}

// Affichage du reste du code HTML (le formulaire)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update</title>
</head>

<body>
    <button><a href="listUser.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    // Affichage du formulaire avec les données de l'utilisateur à mettre à jour
    if (isset($_POST['id'])) {
        $user = $userController->showUserC($_POST['id']);
    ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="id">Id :</label></td>
                    <td>
                        <input type="text" id="id" name="id" value="<?php echo $_POST['id'] ?>" readonly />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="prenom">Prenom :</label></td>
                    <td>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom'] ?>" />
                        <span id="erreurPrenom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td>
                        <input type="text" id="email" name="email" value="<?php echo $user['email'] ?>" />
                        <span id="erreurEmail" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="mdp">Mdp :</label></td>
                    <td>
                        <input type="text" id="mdp" name="mdp" value="<?php echo $user['mdp'] ?>" />
                        <span id="erreurMdp" style="color: red"></span>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </form>
    <?php
    } ?>
</body>

</html>
