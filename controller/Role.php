<?php

include '../config1.php';

class Role
{
    

    public function afficheRole($occupation)
    {
        try {
            $pdo = config::getConnexion();

            $query = $pdo->prepare("SELECT * FROM user WHERE occupation = :id");
            $query->execute(['id' => $occupation]);
            $reclams = $query->fetchAll(PDO::FETCH_ASSOC);
            return $reclams;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
    }
    


    public function listRoleC()
    {
        $sql = "SELECT * FROM role";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteRoleC($id_role)
    {
        $sql = "DELETE FROM role WHERE id_role = :id_role";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_role', $id_role);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addRoleC($Role)
    {
        $db = config::getConnexion();

        try {
            $sql = "INSERT INTO role (id_role,type) VALUES (:id_role,:type)";
            $query = $db->prepare($sql);
            $query->bindParam(':id_role', $id_role);
            $query->bindParam(':type', $type);
          


            $id_role = $Role->getIdRole();
            $type =$Role->getType();
          


            $query->execute();     
            if ($query->rowCount() > 0) {
                echo 'Role added successfully';
            } else {
                echo 'Failed to add Role';
            }


        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showRoleC($id_role)
    {
        $sql = "SELECT * FROM role WHERE id_role = :id_role";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_role', $id_role);
            $query->execute();
            $Role = $query->fetch();
            return $Role;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    



    public function updateRoleC($role,$id_role)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE role SET 
                type = :type
                WHERE id_role = :id_role'
            );

            $query->execute([
                'id_role' => $id_role,
                'type' => $role->getType()
             
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error updating role: " . $e->getMessage();
        }
    }
    // Method to fetch all distinct idRP values from the reponse table
    
    public function getAllIdRoles()
    {
        try {
            $pdo = config::getConnexion();

            $query = $pdo->query("SELECT id_role FROM role");
            $idRoles = $query->fetchAll(PDO::FETCH_COLUMN);
            return $idRoles;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
   
    // Method to fetch reclams based on idRP
    public function getReclamsByRP($id_role)
    {
        try {
            $pdo = config::getConnexion();

            $query = $pdo->prepare("SELECT * FROM user WHERE role = :id_role");
            $query->execute(['id_role' => $id_role]);
            $rols = $query->fetchAll(PDO::FETCH_ASSOC);
            return $rols;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
