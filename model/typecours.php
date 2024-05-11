<?php
class Typecours {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
/************insertion******************* */
public function createtypecours($idlesson, $emailuser, $type) {
    try {
        // Préparer la requête SQL
        $sql = "INSERT INTO typecours (idlesson, emailuser, type) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        
        // Exécuter la requête avec les valeurs liées
        $stmt->execute([$idlesson, $emailuser, $type]);
        
        // Retourner true si l'insertion a réussi
        return true;
    } catch(PDOException $e) {
        // En cas d'erreur, afficher un message d'erreur et retourner false
        echo "Erreur lors de la création du type de cours : " . $e->getMessage();
        return false;
    }
}

    

    
    
/**********update*************** */

public function updatetypecours($idtypecours, $emailuser, $type) {
    try {
        // Vérifier d'abord si le type de cours avec cet identifiant existe dans la base de données
        $check_sql = "SELECT idtypecours FROM typecours WHERE idtypecours = ?";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->execute([$idtypecours]);
        $check_result = $check_stmt->fetch(PDO::FETCH_ASSOC);

        // Si le type de cours existe, procéder à la mise à jour
        if ($check_result) {
            // Effectuer la mise à jour des données
            $update_sql = "UPDATE typecours SET emailuser=?, type=? WHERE idtypecours=?";
            $update_stmt = $this->conn->prepare($update_sql);
            $success = $update_stmt->execute([$emailuser, $type, $idtypecours]);

            if ($success) {
                return "Type de cours mis à jour avec succès!";
            } else {
                return "Erreur lors de la mise à jour du type de cours.";
            }
        } else {
            // Le type de cours n'existe pas dans la base de données
            return "Type de cours avec l'ID $idtypecours non trouvé.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur, afficher un message d'erreur
        return "Erreur lors de la mise à jour du type de cours : " . $e->getMessage();
    }
}

    
    /***************delete************** */
    public function deletetypecours($idtypecours) {
        try {
            // Vérifier d'abord si le type de cours avec cet identifiant existe dans la base de données
            $check_sql = "SELECT idtypecours FROM typecours WHERE idtypecours = ?";
            $check_stmt = $this->conn->prepare($check_sql);
            $check_stmt->execute([$idtypecours]);
            $check_result = $check_stmt->fetch(PDO::FETCH_ASSOC);
    
            // Si le type de cours existe, procéder à la suppression
            if ($check_result) {
                // Supprimer le type de cours de la base de données
                $delete_sql = "DELETE FROM typecours WHERE idtypecours = ?";
                $delete_stmt = $this->conn->prepare($delete_sql);
                $success = $delete_stmt->execute([$idtypecours]);
    
                if ($success) {
                    return "Type de cours supprimé avec succès!";
                } else {
                    return "Erreur lors de la suppression du type de cours.";
                }
            } else {
                // Le type de cours n'existe pas dans la base de données
                return "Type de cours avec l'ID $idtypecours non trouvé.";
            }
        } catch (PDOException $e) {
            // En cas d'erreur, afficher un message d'erreur
            return "Erreur lors de la suppression du type de cours : " . $e->getMessage();
        }
    }
    

    /*************affichage*************** */

    public function getAlltypecours() {
        $typecours = array();
        try {
            // Préparez la requête SQL
            $sql = "SELECT idtypecours, idlesson, emailuser, type FROM typecours";
            $stmt = $this->conn->prepare($sql);
            
            // Exécutez la requête
            $stmt->execute();
            
            // Récupérez les résultats sous forme de tableau associatif
            $typecours = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e) {
            // En cas d'erreur, affichez un message d'erreur
            echo "Erreur lors de la récupération des types de cours : " . $e->getMessage();
        }
    
        return $typecours;
    }
}


?>