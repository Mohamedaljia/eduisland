<?php
class profile {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /************insertion******************* */
    public function createProfile($cv, $date_creation, $disponibilite) {
        $sql = "INSERT INTO profile (cv, date_creation, disponibilite) 
                VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sss', $cv, $date_creation, $disponibilite);
        
        return $stmt->execute();
    }

    /**********update*************** */
    public function updateProfile($idprofile, $cv, $date_creation, $disponibilite) {
        // Vérifier d'abord si le profil avec cet identifiant existe dans la base de données
        $check_sql = "SELECT idprofile FROM profile WHERE idprofile = ?";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->bind_param('i', $idprofile);
        $check_stmt->execute();
        $check_stmt->store_result();

        // Si le profil existe, procéder à la mise à jour
        if ($check_stmt->num_rows > 0) {
            // Effectuer la mise à jour des données
            $update_sql = "UPDATE profile SET cv=?, date_creation=?, disponibilite=? WHERE idprofile=?";
            $update_stmt = $this->conn->prepare($update_sql);
            $update_stmt->bind_param('sssi', $cv, $date_creation, $disponibilite, $idprofile);
            $success = $update_stmt->execute();
            
            if ($success) {
                // Mise à jour réussie
            } else {
                return "Error updating profile: " . $update_stmt->error;
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
        $check_stmt->bind_param('i', $idprofile);
        $check_stmt->execute();
        $check_stmt->store_result();

        // Si le profil existe, procéder à la suppression
        if ($check_stmt->num_rows > 0) {
            // Supprimer le profil de la base de données
            $delete_sql = "DELETE FROM profile WHERE idprofile = ?";
            $delete_stmt = $this->conn->prepare($delete_sql);
            $delete_stmt->bind_param('i', $idprofile);
            $success = $delete_stmt->execute();
            
            if ($success) {
                return "Profile deleted successfully!";
            } else {
                return "Error deleting profile: " . $delete_stmt->error;
            }
        } else {
            // Profil non trouvé dans la base de données
            return "Profile with ID $idprofile not found.";
        }
    }

    /*************affichage*************** */
    public function getAllProfiles() {
        $profiles = array();

        $sql = "SELECT idprofile, cv, date_creation, disponibilite FROM profile";
        $result = mysqli_query($this->conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $profiles[] = $row;
            }
        }

        return $profiles;
    }
}
?>
