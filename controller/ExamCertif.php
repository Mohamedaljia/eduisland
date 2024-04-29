<?php



class examcertiff
{


    public function insertCertif($id_certif) {
        try {
            // Prepare the SQL statement
            $sql ="INSERT INTO exam_certif (id_certifExam) VALUES (:id_certif)";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            // Bind parameters
            $query->bindParam(':id_certif', $id_certif);

            // Execute the statement
            $query->execute();

            // Close the statement
            $query->closeCursor();

            return true; // Return true if insertion is successful
        } catch(PDOException $e) {
            // Handle exceptions, such as database errors
            return false; // Return false if insertion fails
        }
    }

    public function insertExam($id_exam) {
        try {
            // Prepare the SQL statement
            $sql ="INSERT INTO exam_certif (id_examCertif) VALUES (:id_exam)";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            // Bind parameters
            $query->bindParam(':id_exam', $id_exam);

            // Execute the statement
            $query->execute();

            // Close the statement
            $query->closeCursor();

            return true; // Return true if insertion is successful
        } catch(PDOException $e) {
            // Handle exceptions, such as database errors
            return false; // Return false if insertion fails
        }
    }


}