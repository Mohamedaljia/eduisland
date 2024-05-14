<?php

require '../config1.php';

class ReponsesC
{


    public function afficheReclam($idU)
    {
        try {
            $pdo = config::getConnexion();
    
            $query = $pdo->prepare("SELECT * FROM reclam WHERE idU = :id ");
            $query->execute(['id' => $idU]);
            $reclams = $query->fetchAll(PDO::FETCH_ASSOC);
            return $reclams; // Return fetched reclams
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    
    public function afficheRep()
    {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM reponse");
            $query->execute();
            $reponses = $query->fetchAll(PDO::FETCH_ASSOC); // Fetch all reponses
            return $reponses;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    

    function addreponse($reponses)
    {
        // Get the database connection
        $db = config::getConnexion();
        
        try {
            // Prepare the SQL query
            $sql = "INSERT INTO reponse (idRP,descP) VALUES (:idRP,:descP)";
            $query = $db->prepare($sql);
            
            // Bind parameters
            $query->bindParam(':idRP', $idRP);
            $query->bindParam(':descP', $descP);
        
            
            // Set parameters from the object
            $idRP = $reponses->getIdRP();
            $descP = $reponses-> getDescP();
            
            
            // Execute the query
            $query->execute();
            
            // Optionally, you can check the number of affected rows
            if ($query->rowCount() > 0) {
                echo 'reponse added successfully';
            } else {
                echo 'Failed to add reponse';
            }
        } catch (PDOException $e) {
            // Handle any exceptions
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    function deletereponse($id)
    {
        $sql = "DELETE FROM reponse WHERE idRP = :idRP";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idRP', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function updaterep($reponses, $idRP)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE reponse SET 
                    descP = :descP
                WHERE idRP= :idRP'
            );
            
            $query->execute([
                'idRP' => $idRP,
                'descP' => $reponses->getDescP(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            // Handle exceptions properly, for example:
            echo "Error updating record: " . $e->getMessage();
        }
    }

     // Method to fetch all distinct idRP values from the reponse table
    
     public function getAllIdRPs()
     {
         try {
             $pdo = config::getConnexion();
 
             $query = $pdo->query("SELECT idRP FROM reponse");
             $idRPs = $query->fetchAll(PDO::FETCH_COLUMN);
             return $idRPs;
         } catch (PDOException $e) {
             echo "Error: " . $e->getMessage();
         }
     }
 
     // Method to fetch reclams based on idRP
     public function getReclamsByRP($idRP)
     {
         try {
             $pdo = config::getConnexion();
 
             $query = $pdo->prepare("SELECT * FROM reclam WHERE reponse = :idRP");
             $query->execute(['idRP' => $idRP]);
             $reclams = $query->fetchAll(PDO::FETCH_ASSOC);
             return $reclams;
         } catch (PDOException $e) {
             echo "Error: " . $e->getMessage();
         }
     }
}
?>
