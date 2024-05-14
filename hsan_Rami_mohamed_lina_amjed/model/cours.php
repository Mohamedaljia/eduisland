<?php
class Cours {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
/************insertion******************* */
public function createcours($matiere, $niveau, $nbheure, $idt) {
    try {
        // Préparer la requête SQL
        $sql = "INSERT INTO lessons (matiere, niveau, nbheure, idt) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        
        // Exécuter la requête avec les valeurs passées en paramètres
        $stmt->execute([$matiere, $niveau, $nbheure, $idt]);
        
        // Retourner true si l'insertion a réussi
        return true;
    } catch(PDOException $e) {
        // En cas d'erreur, afficher un message d'erreur et retourner false
        echo "Erreur lors de la création du cours : " . $e->getMessage();
        return false;
    }
}



    
    
/**********update*************** */
public function updatecours($idlesson, $matiere, $nbheure, $niveau, $idt) {
    try {
        // Vérifier d'abord si le cours avec cet identifiant existe dans la base de données
        $check_sql = "SELECT idlesson FROM lessons WHERE idlesson = ?";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->execute([$idlesson]);
        $check_result = $check_stmt->fetch(PDO::FETCH_ASSOC);

        // Si la leçon existe, procéder à la mise à jour
        if ($check_result) {
            // Effectuer la mise à jour des données
            $update_sql = "UPDATE lessons SET matiere=?, nbheure=?, niveau=?, idt=? WHERE idlesson=?";
            $update_stmt = $this->conn->prepare($update_sql);
            $success = $update_stmt->execute([$matiere, $nbheure, $niveau, $idt, $idlesson]);

            if ($success) {
                return "Updating course succefully!";
            } else {
                return "Error updating the course";
            }
        } else {
            // Le cours n'existe pas dans la base de données
            return "Cours avec l'ID $idlesson non trouvé.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur, afficher un message d'erreur
        return "Erreur lors de la mise à jour du cours : " . $e->getMessage();
    }
}

    
    /***************delete************** */
    public function deleteCours($idlesson) {
        try {
            // Vérifier d'abord si le cours avec cet identifiant existe dans la base de données
            $check_sql = "SELECT idlesson FROM lessons WHERE idlesson = ?";
            $check_stmt = $this->conn->prepare($check_sql);
            $check_stmt->execute([$idlesson]);
            $check_result = $check_stmt->fetch(PDO::FETCH_ASSOC);
    
            // Si le cours existe, procéder à la suppression
            if ($check_result) {
                // Supprimer le cours de la base de données
                $delete_sql = "DELETE FROM lessons WHERE idlesson = ?";
                $delete_stmt = $this->conn->prepare($delete_sql);
                $success = $delete_stmt->execute([$idlesson]);
    
                if ($success) {
                    return "Course deleted succesfully!";
                } else {
                    return "Error deleting the course.";
                }
            } else {
                // Le cours n'existe pas dans la base de données
                return "Cours avec l'ID $idlesson non trouvé.";
            }
        } catch (PDOException $e) {
            // En cas d'erreur, afficher un message d'erreur
            return "Error deleting the course : " . $e->getMessage();
        }
    }
    

    /*************affichage*************** */

    public function getAllcours() {
        $cours = array();
    
        try {
            // Préparez la requête SQL
            $sql = "SELECT idlesson, matiere, nbheure, niveau, idt FROM lessons";
            $stmt = $this->conn->prepare($sql);
            
            // Exécutez la requête
            $stmt->execute();
            
            // Récupérez les résultats sous forme de tableau associatif
            $cours = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e) {
            // En cas d'erreur, affichez un message d'erreur
            echo "Erreur lors de la récupération des cours : " . $e->getMessage();
        }
    
        return $cours;
    }
    
    
    
}


?>