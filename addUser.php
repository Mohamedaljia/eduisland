<?php

include '../Controller/User.php';

include '../model/User.php';


$error = "";

// create client
$User = null;

// create an instance of the controller
$User = new User();
if (
    isset($_POST["id"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["mdp"])
) {
    echo "Form submitted!"; // Debugging message

    if (
        !empty($_POST['id']) &&
        !empty($_POST["nom"]) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["mdp"])
    ) {
        echo "All fields filled!"; // Debugging message

        $User = new User(
            
            $_POST['id'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['mdp']
        );
        $User->addUserC($User);
        header('Location: listUser.php');
    } else {
        $error = "Missing information";
        echo "Missing information!"; // Debugging message
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserC </title>
</head>
<body>
    <a href="listUserC.php">Back to list</a>
    <hr>

    <div id="error"></div>
    <?php
    if (isset($_POST['id'])) {
        $UserC = $User->showUserC($_POST['id']);
        
    ?>

    <form action="" method="POST" id="UserForm">
        <table>
            <tr>
                <td><label for="id">Id:</label></td>
                <td>
                    <input type="text" id="id" name="id" />
                    <span id="erreurid" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="nom">Name:</label></td>
                <td>
                    <input type="text" id="nom" name="nom" />
                    <span id="erreurNom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="prenom">Prenom:</label></td>
                <td>
                    <input type="text" id="prenom" name="prenom" />
                    <span id="erreurPrenom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td>
                    <input type="text" id="email" name="email" />
                    <span id="erreurEmail" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="mdp">Mdp:</label></td>
                <td>
                    <input type="text" id="mdp" name="mdp" />
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

    <script>
        document.getElementById("UserForm").addEventListener("submit", function(event) {
            var id = document.getElementById("id").value.trim();
            var nom = document.getElementById("nom").value.trim();
            var prenom = document.getElementById("prenom").value.trim();
            var email = document.getElementById("email").value.trim();
            var mdp = document.getElementById("mdp").value.trim();

            var errorDiv = document.getElementById("error");
            errorDiv.innerHTML = "";

            // Validation rules
            if (!/^\d+$/.test(id)) {
                event.preventDefault();
                document.getElementById("erreurid").innerHTML = "ID must be a number.";
            }

            if (nom.length > 10) {
                event.preventDefault();
                document.getElementById("erreurNom").innerHTML = "Name must be less than or equal to 10 characters.";
            }

            if (typee.length > 5) {
                event.preventDefault();
                document.getElementById("erreurPrenom").innerHTML = "Prenom must be less than or equal to 5 characters.";
            }

            if (email !== "anglais" && email !== "francais" && email !== "arabe") {
                event.preventDefault();
                document.getElementById("erreurEmail").innerHTML = "Language must be 'anglais', 'francais', or 'arabe'.";
            }

            if (!/^[1-3]$/.test(mdp)) {
                event.preventDefault();
                document.getElementById("erreurMdp").innerHTML = "Mdp must be a number between 1 and 3.";
            }
        });
    </script>
</body>
</html>