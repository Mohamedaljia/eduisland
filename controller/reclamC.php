

<?php

require '../config.php';

class reclamsC
{

    public function listreclam()
    {
        $sql = "SELECT * FROM reclam";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletereclam($id)
    {
        $sql = "DELETE FROM reclam WHERE idR = :idR";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idR', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function addreclam($reclams)
    {
        // Get the database connection
        $db = config::getConnexion();
        
        try {
            // Prepare the SQL query
            $sql = "INSERT INTO reclam (idR,idU, subjectt, descriptionn, feedback) VALUES (:idR,:idU,:subjectt, :descriptionn,:feedback)";
            $query = $db->prepare($sql);
            
            // Bind parameters
            $query->bindParam(':idR', $idR);
            $query->bindParam(':idU', $idU);
            $query->bindParam(':subjectt', $subjectt);
            $query->bindParam(':descriptionn', $descriptionn);
            $query->bindParam(':feedback', $feedback);
            
            // Set parameters from the object
            $idR = $reclams->getIdR();
            $idU = $reclams->getIdU();
            $subjectt = $reclams->getSubject();
            $descriptionn = $reclams->getDescriptionn();
            $feedback = $reclams->getFeedback();
            
            
            // Execute the query
            $query->execute();
            
            // Optionally, you can check the number of affected rows
            if ($query->rowCount() > 0) {
                echo 'reclam added successfully';
            } else {
                echo 'Failed to add reclam';
            }
        } catch (PDOException $e) {
            // Handle any exceptions
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showreclam($idR)
    {
        $sql = "SELECT * from reclam where idR = $idR";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $reclams = $query->fetch();
            return $reclams;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

function updatereclam($reclams, $idR, $idU)
{   
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE reclam SET 
                idU = :idU, 
                subjectt = :subjectt, 
                descriptionn = :descriptionn, 
                feedback = :feedback
            WHERE idR= :idR'
        );
        
        $query->execute([
            'idR' => $idR,
            'idU' => $idU,
            'subjectt' => $reclams->getSubject(),
            'descriptionn' => $reclams->getDescriptionn(),
            'feedback' => $reclams->getFeedback(),
        ]);
        
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        // Handle exceptions properly, for example:
        echo "Error updating record: " . $e->getMessage();
    }
}
public function countReclamationsByType() {
    $sql = "SELECT subjectt, COUNT(*) AS count FROM reclam GROUP BY subjectt";
    $db = config::getConnexion();
    try {
        $query = $db->query($sql);
        $reclamationsByType = $query->fetchAll(PDO::FETCH_ASSOC);
        return $reclamationsByType;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}


}