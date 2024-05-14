<?php

require '../config.php';

class User
{

    public function listUserC()
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteUserC($ide)
    {
        $sql = "DELETE FROM user  WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addUserC ($User)
    {
        $db = config::getConnexion();

        try {
             $sql = "INSERT INTO user (id, nom,prenom,email, mdp,occupation) VALUES (:id, :nom,:prenom,:email, :mdp,:occupation)";
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->bindParam(':nom', $nom);
            $query->bindParam(':prenom', $prenom);
            $query->bindParam(':email', $email);
            $query->bindParam(':mdp', $mdp);
            $query->bindParam(':occupation',$occupation);

            $id = $User->getId();
            $nom = $User->getNom();
            $prenom =$User->getPrenom();
            $email=$User->getEmail();
            $mdp= $User ->getMdp();
            $occupation= $User ->getOccupation();


            $query->execute();     
            if ($query->rowCount() > 0) {
                echo 'user added successfully';
            } else {
                echo 'Failed to add user';
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showUserC ($id)
    {
        $sql = "SELECT * from user  where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $User = $query->fetch();
            return $User ;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // In User.php controller

public function updateUserC($user, $id)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE user SET 
                prenom = :prenom, 
                email = :email, 
                nom = :nom, 
                mdp = :mdp ,
                occupation = :occupation 
            WHERE id = :id'
        );

        // Utilize the ID from the function argument
        $query->execute([
            'id' => $id,
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'mdp' => $user->getMdp(),
            'occupation' => $user->getOccupation()
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error updating user: " . $e->getMessage();
    }
}

/*public function loginUser($email, $mdp)
{
    try {
        $db = config::getConnexion();
        $sql = "SELECT email, mdp FROM user WHERE email = :email AND mdp = :mdp";
        $query = $db->prepare($sql);
        $query->bindParam(':email', $email);
        $query->bindParam(':mdp', $mdp);
        $query->execute();
        $user = $query->fetch();

        if ($user) {
            // User exists with provided email and password
            header("Location: test.php");
            exit(); // Ensure no further code is executed after redirection
        } else {
            // User does not exist or credentials are incorrect
            echo "Invalid email or password";
        }
    } catch (PDOException $e) {
        echo "Error checking login: " . $e->getMessage();
    }
}

*/
 public function loginUser($email, $mdp)
{
    try {
        $db = config::getConnexion();
        $sql = "SELECT email, mdp, occupation FROM user WHERE email = :email AND mdp = :mdp";
        $query = $db->prepare($sql);
        $query->bindParam(':email', $email);
        $query->bindParam(':mdp', $mdp);
        $query->execute();
        $user = $query->fetch();

        if ($user)
            {
                // Check user's occupation
                if ($user['occupation'] == 4) 
                    {
                        // User has occupation 4, allow access to test.php
                        header("Location: test.php");
                        exit(); // Ensure no further code is executed after redirection
                    } 
                else
                    {
                        $aa=1;
                        //echo "You don't have permission to access this page.";
                    }
            }
        else
            {
                $aa=2;
                // User does not exist or credentials are incorrect
                //echo "Invalid email or password";
            }
    } catch (PDOException $e) {
        echo "Error checking login: " . $e->getMessage();
    }
    return $aa;
}

public function countOccupationByType() {
    $sql = "SELECT occupation, COUNT(*) AS count FROM user GROUP BY occupation";
    $db = config::getConnexion();
    try {
        $query = $db->query($sql);
        $occupationByType = $query->fetchAll(PDO::FETCH_ASSOC);
        return $occupationByType;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}


}