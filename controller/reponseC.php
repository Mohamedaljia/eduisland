<?php

require '../config.php';

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
