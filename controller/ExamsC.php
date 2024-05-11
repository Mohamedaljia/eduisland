<?php

require '../config.php';




class ExamsC
{ public function findExamById($id)
    {
        $sql = "SELECT * FROM exams WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            $exam = $query->fetch(PDO::FETCH_ASSOC);
            
            if ($exam) {
                echo "Exam found with ID: $id <br>";
                echo "ID: " . $exam['id'] . "<br>";
                echo "Type: " . $exam['typee'] . "<br>";
                echo "Langue: " . $exam['langue'] . "<br>";
                echo "Nom: " . $exam['nom'] . "<br>";
                echo "Niveau: " . $exam['niveau'] . "<br>";
                // You can display more attributes here if needed
            } else {
                echo "Exam not found with ID: $id";
            }
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    /*public function statistiqueParNiveau()
    { 
        try {
            $db = config::getConnexion();
            $sql = "SELECT niveau, COUNT(*) as nombre_certificats FROM exams GROUP BY niveau";
            $req = $db->prepare($sql);
            $req->execute();
            $statistiques = $req->fetchAll(PDO::FETCH_ASSOC);
            return $statistiques;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }*/
    public function countReclamationsByType() {
        $sql = "SELECT niveau, COUNT(*) AS count FROM exams GROUP BY niveau";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $reclamationsByType = $query->fetchAll(PDO::FETCH_ASSOC);
            return $reclamationsByType;
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function listExams()
    {
        $sql = "SELECT * FROM exams";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function deleteExams($ide)
{
    $sql = "SELECT file FROM exams WHERE id = :id";
    $db = config::getConnexion();
    try {
        // Retrieve the file name associated with the exam
        $query = $db->prepare($sql);
        $query->bindParam(':id', $ide);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $fileToDelete = $result['file'];

        // Delete the exam from the database
        $sqlDelete = "DELETE FROM exams WHERE id = :id";
        $req = $db->prepare($sqlDelete);
        $req->bindValue(':id', $ide);
        $req->execute();

        // Delete the associated image file
        $filePath = '../uploads/' . $fileToDelete; // Adjust the path based on your file structure
        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                echo "File deleted successfully";
            } else {
                echo "Failed to delete file";
            }
        } else {
            echo "File does not exist";
        }

        // Redirect or handle further actions
        header('Location:listExams.php');
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}


    

    /*public function addExams($, $description, $date_debut, $date_fin, $type, $contrat) {
        $sql = "INSERT INTO collaboration (titre, description, date_debut, date_fin, type, contrat) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
    $stmt->bind_param('ssssss', $titre, $description, $date_debut, $date_fin, $type, $contrat);
        
        return $stmt->execute();
    }*/
    function addExams($exams)
{
    // Get the database connection
    $db = config::getConnexion();
    
    try {
        // Prepare the SQL query
        $sql = "INSERT INTO exams (id,typee, langue, nom, niveau,file) VALUES (:id,:typee, :langue, :nom, :niveau,:file)";
        $query = $db->prepare($sql);
        
        // Bind parameters
        $query->bindParam(':id', $id);

        $query->bindParam(':typee', $typee);
        $query->bindParam(':langue', $langue);
        $query->bindParam(':nom', $nom);
        $query->bindParam(':niveau', $niveau);
        $query->bindParam(':file', $file);
        
        // Set parameters from the object
        $id = $exams->getId();

        $typee = $exams->getType();
        $langue = $exams->getLangue();
        $nom = $exams->getNom();
        $niveau = $exams->getNiveau();
        $file= $exams->getfile();
        
        
        // Execute the query
        $query->execute();
        
        // Optionally, you can check the number of affected rows
        if ($query->rowCount() > 0) {
            echo 'Exam added successfully';
        } else {
            echo 'Failed to add exam';
        }
    } catch (PDOException $e) {
        // Handle any exceptions
        echo 'Error: ' . $e->getMessage();
    }
}

    /*function addExams($exams)
    {
        $sql = "INSERT INTO exams  
        VALUES (NULL, :typee,:langue, :nom,:niveau)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'typee' => $exams->getType(),
                'langue' => $exams->getLangue(),
                'nom' => $exams->getNom(),
                'niveau' => $exams->getNiveau(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }*/
    /*
     function addExams()
     {
    try {
        $id = "1";
       

        $db = config::getConnexion();
       
        $requette = $db->prepare("INSERT INTO exams(id,typee,langue,nom,niveau) VALUES (:id,:nom,:typpe,:nom,:niveau)");

        
        $typee = "a";
        $langue = "arabe";
        $nom = "a";
        $niveau = "1";
        $requette->execute();
        $requette->bindParam(':typee', $typee);
        $requette->bindParam(':langue',$langue );
        $requette->bindParam(':nom', $nom);
        $requette->bindParam(':niveau', $niveau);

       

        echo 'added with success';
    } catch (PDOException $e) {
        echo 'echec de connexion:' . $e->getMessage();
    }}*/


    function showExams($id)
    {
        $sql = "SELECT * from exams where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $exams = $query->fetch();
            return $exams;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    /*function updateExams($exams, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE exams SET 
                    typee = :typee, 
                    langue = :langue, 
                    nom = :nom, 
                    niveau = :niveau,
                   
                WHERE id= :id'
            );
            
            $query->execute([
                'id' => $id,
                'typee' => $exams->getType(),
                'langue' => $exams->getLangue(),
                'nom' => $exams->getNom(),
                'niveau' => $exams->getNiveau(),
              
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }*/
    public function updateExams($exams, $id)
{   
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE exams SET 
                typee = :typee, 
                langue = :langue, 
                nom = :nom, 
                niveau = :niveau
            WHERE id = :id' // Removed the extra comma before WHERE clause
        );
        
        $query->execute([
            'id' => $id,
            'typee' => $exams->getType(),
            'langue' => $exams->getLangue(),
            'nom' => $exams->getNom(),
            'niveau' => $exams->getNiveau(),
        ]);
        
        // Check if any row was affected by the update
        if ($query->rowCount() > 0) {
            echo $query->rowCount() . " record updated successfully.<br>";
        } else {
            echo "No records updated.<br>";
        }
    } catch (PDOException $e) {
        // Echo or log the error message for debugging
        echo "Error updating record: " . $e->getMessage();
    }
}

}