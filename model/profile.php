<?php
class Profile {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /************insertion******************* */
    public function createProfile($cv, $date_creation, $disponibilite, $mail) {
        $sql = "INSERT INTO profile (cv, date_creation, disponibilite, mail) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $cv);
        $stmt->bindParam(2, $date_creation);
        $stmt->bindParam(3, $disponibilite);
        $stmt->bindParam(4, $mail);
        
        return $stmt->execute();
    }

    /**********update*************** */
    public function updateProfile($idprofile, $cv, $date_creation, $disponibilite, $mail) {
        // Vérifier d'abord si le profil avec cet identifiant existe dans la base de données
        $check_sql = "SELECT idprofile FROM profile WHERE idprofile = ?";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->bindParam(1, $idprofile);
        $check_stmt->execute();

        // Si le profil existe, procéder à la mise à jour
        if ($check_stmt->rowCount() > 0) {
            // Effectuer la mise à jour des données
            $update_sql = "UPDATE profile SET cv=?, date_creation=?, disponibilite=?, mail=? WHERE idprofile=?";
            $update_stmt = $this->conn->prepare($update_sql);
            $update_stmt->bindParam(1, $cv);
            $update_stmt->bindParam(2, $date_creation);
            $update_stmt->bindParam(3, $disponibilite);
            $update_stmt->bindParam(4, $mail);
            $update_stmt->bindParam(5, $idprofile);
            $success = $update_stmt->execute();
            
            if ($success) {
                // Mise à jour réussie
            } else {
                return "Error updating profile: " . $update_stmt->errorInfo()[2];
            }
        } else {
            // Profil non trouvé
            return "Profile with ID $idprofile not found.";
        }
    }

    /***************delete************** */
    public function deleteProfile($idprofile) {
        // Vérifier d'abord si le profil avec cet identifiant existe dans la base de données
        $check_sql = "SELECT idprofile FROM profile WHERE idprofile = ?";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->bindParam(1, $idprofile);
        $check_stmt->execute();

        // Si le profil existe, procéder à la suppression
        if ($check_stmt->rowCount() > 0) {
            // Supprimer le profil de la base de données
            $delete_sql = "DELETE FROM profile WHERE idprofile = ?";
            $delete_stmt = $this->conn->prepare($delete_sql);
            $delete_stmt->bindParam(1, $idprofile);
            $success = $delete_stmt->execute();
            
            if ($success) {
                return "Profile deleted successfully!";
            } else {
                return "Error deleting profile: " . $delete_stmt->errorInfo()[2];
            }
        } else {
            // Profil non trouvé dans la base de données
            return "Profile with ID $idprofile not found.";
        }
    }

    /*************affichage*************** */
    public function getAllProfiles() {
        $profiles = array();

        $sql = "SELECT idprofile, cv, date_creation, disponibilite, mail FROM profile";
        $result = $this->conn->query($sql);

        if($result->rowCount() > 0) {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $profiles[] = $row;
            }
        }

        return $profiles;
    }
}
?>
