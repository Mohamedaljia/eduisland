<?php
class Partenaire {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Méthode pour créer un partenaire dans la base de données
    public function createPartenaire($idprofile, $nom, $contact, $date_recru, $adresse, $offre) {
        // Préparation de la requête SQL
        $sql = "INSERT INTO partenaire (idprofile, nom, contact, date_recru, adresse, offre) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $idprofile);
        $stmt->bindParam(2, $nom);
        $stmt->bindParam(3, $contact);
        $stmt->bindParam(4, $date_recru);
        $stmt->bindParam(5, $adresse);
        $stmt->bindParam(6, $offre);
        
        // Exécution de la requête
        if ($stmt->execute()) {
            return "Partenaire ajouté avec succès.";
        } else {
            return "Erreur lors de l'ajout du partenaire: " . $stmt->errorInfo()[2];
        }
    }

    /***************delete************** */
    public function deletePartenaire($idpartenaire) {
        // Vérifier d'abord si le partenaire avec cet identifiant existe dans la base de données
        $check_sql = "SELECT idpartenaire FROM partenaire WHERE idpartenaire = ?";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->bindParam(1, $idpartenaire);
        $check_stmt->execute();
        //$check_stmt->store_result();

        // Si le partenaire existe, procéder à la suppression
        if ($check_stmt->rowCount() > 0) {
            // Supprimer le partenaire de la base de données
            $delete_sql = "DELETE FROM partenaire WHERE idpartenaire = ?";
            $delete_stmt = $this->conn->prepare($delete_sql);
            $delete_stmt->bindParam(1, $idpartenaire);
            $success = $delete_stmt->execute();
            
            if ($success) {
                return "Partenaire supprimé avec succès !";
            } else {
                return "Erreur lors de la suppression du partenaire : " . $delete_stmt->errorInfo()[2];
            }
        } else {
            // Le partenaire n'existe pas dans la base de données
            return "Partenaire avec l'ID $idpartenaire introuvable.";
        }
    }

/**********update*************** */
public function updatePartenaire($idpartenaire, $idprofile, $nom, $contact, $date_recru, $adresse, $offre) {
    // Vérifier d'abord si le partenaire avec cet identifiant existe dans la base de données
    $check_sql = "SELECT idpartenaire FROM partenaire WHERE idpartenaire = ?";
    $check_stmt = $this->conn->prepare($check_sql);
    $check_stmt->bindParam(1, $idpartenaire);
    $check_stmt->execute();
    //$check_stmt->store_result();

    // Si le partenaire existe, procéder à la mise à jour
    if ($check_stmt->rowCount() > 0) {
        // Effectuer la mise à jour des données
        $update_sql = "UPDATE partenaire SET idprofile=?, nom=?, contact=?, date_recru=?, adresse=? , offre=? WHERE idpartenaire=?";
        $update_stmt = $this->conn->prepare($update_sql);
        $update_stmt->bindParam(1, $idprofile);
        $update_stmt->bindParam(2, $nom);
        $update_stmt->bindParam(3, $contact);
        $update_stmt->bindParam(4, $date_recru);
        $update_stmt->bindParam(5, $adresse);
        $update_stmt->bindParam(6, $offre);
        $update_stmt->bindParam(7, $idpartenaire);
        $success = $update_stmt->execute();
        
        if ($success) {
            return "Partenaire mis à jour avec succès !";
        } else {
            return "Erreur lors de la mise à jour du partenaire : " . $update_stmt->errorInfo()[2];
        }
    } else {
        return "Partenaire avec l'ID $idpartenaire introuvable.";
    }
}

 public function getAllPartenaires() {
    $partenaire = array();

    $sql = "SELECT idpartenaire, idprofile, nom, contact, date_recru, adresse , offre FROM partenaire";
    $result = $this->conn->query($sql);

    if($result->rowCount() > 0) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $partenaire[] = $row;
        }
    }

    return $partenaire;
}

}
?>
