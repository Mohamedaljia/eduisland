<?php

require '../config.php';
require_once '../phpqrcode/qrlib.php';


class CertifC
{ 
    
    public function listcertif()
    {
        $sql = "SELECT * FROM certif";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletecertif($ide)
    {
        $sql = "DELETE FROM certif WHERE id_certif = :id_certif";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_certif', $ide);

        try {
            $req->execute();
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
    /*function addceertif($certif)
{
    // Get the database connection
    $db = config::getConnexion();
    
    try {
        // Prepare the SQL query
        $sql = "INSERT INTO certif (id_certif,id_exam, datee, nom, prenom) VALUES (:id_certif,:id_exam, :date, :nom, :prenom)";
        $query = $db->prepare($sql);
        
        // Bind parameters
        $query->bindParam(':id_certif', $id_certif);
        $query->bindParam(':id_exam', $id_exam);
        $query->bindParam(':datee', $datee);
        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        
        // Set parameters from the object
        $id_certif = $certif->getId_certif();
        $id_exam = $certif->getId_exam();
        $datee = $certif->getdate();
        $nom = $certif->getNom();
        $prenom = $certif->getprenom();
        
        
        // Execute the query
        $query->execute();
        
        // Optionally, you can check the number of affected rows
        if ($query->rowCount() > 0) {
            echo 'certifcat added successfully';
        } else {
            echo 'Failed to add certeficat';
        }
    } catch (PDOException $e) {
        // Handle any exceptions
        echo 'Error: ' . $e->getMessage();
    }
}*/
public function generateQRCode($id_certif,$id_etudiant, $datee, $specialite)
{
    // Data to be encoded in the QR code
    $data = "ID CERTIF:$id_certif\nID Etudiant: $id_etudiant\nDate: $datee\nSpecialite: $specialite";

    // Desktop path where QR code image will be saved
    $desktopPath = "C:\\Users\\Msi\\Desktop\\";

    // Generate a unique file name for the QR code image on the desktop
    $fileName = uniqid() . '.png';
    
    // Full path to the generated QR code image
    $filePath = $desktopPath . $fileName;

    // Generate QR code and save it as a PNG image
    QRcode::png($data, $filePath);

    // Return the path to the generated QR code
    return $filePath;
}
function generate_id() {
    // Generate a unique ID using the current timestamp and a random number
    return time() . mt_rand(1000, 9999);
}
function addceertif($certif) {
    // Get the database connection
    $db = config::getConnexion();
    
    try {
        // Prepare the SQL query
        $sql = "INSERT INTO certif (id_certif, id_exam, datee, specialite, id_etudiant) VALUES (:id_certif, :id_exam, :datee, :specialite, :id_etudiant)";
        $query = $db->prepare($sql);
        
        // Bind parameters
        $query->bindParam(':id_certif', $id_certif);
        $query->bindParam(':id_exam', $id_exam);
        $query->bindParam(':datee', $datee);
        $query->bindParam(':specialite', $specialite);
        $query->bindParam(':id_etudiant', $id_etudiant);
        
        // Set parameters from the object
        $id_certif = $certif->getId_certif();
        $id_exam = $certif->getId_exam();
        $datee = $certif->getdate();
        $specialite = $certif-> getspecialite();
        $id_etudiant = $certif->getid_etudiant();
       
        // Execute the query
        $query->execute();
        $sql_exam_certif = "INSERT INTO exam_certif (id_certifExam ) VALUES (:id_certifExam)";
        $query_exam_certif = $db->prepare($sql_exam_certif);
        $query_exam_certif->bindParam(':id_certifExam', $id_certifExam);
        $id_certifExam=$certif->getId_certif();
        
        
        // Execute the query for exam_certif table
        $query_exam_certif->execute();





        // Optionally, you can check the number of affected rows
        if ($query->rowCount() > 0) {
            echo 'Certificate added successfully';
        } else {
            echo 'Failed to add certificate';
        }
    } catch (PDOException $e) {
        // Handle any exceptions
        echo 'Error: ' . $e->getMessage();
    }
    if ($query->rowCount() > 0) {
        echo 'Certificate added successfully';
        
        // Generate QR code
        $qrCodePath = $this->generateQRCode($id_certif,$id_etudiant, $datee, $specialite);
        echo "<img src='$qrCodePath' alt='QR Code'>";
    } else {
        echo 'Failed to add certificate';
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


    function showcertif($id)
    {
        $sql = "SELECT * from certif where id_certif = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $certif = $query->fetch();
            return $certif;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updatecertif($certif, $id_certif)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE certif SET 
                    id_exam = :id_exam, 
                    datee = :datee, 
                    specialite = :specialite, 
                    id_etudiant= :id_etudiant
                WHERE id_certif= :id_certif'
            );
            
            $query->execute([
                'id_certif' => $id_certif,
                'id_exam' => $certif->getid_exam(),
                'datee' => $certif->getdate(),
                'specialite' => $certif->getspecialite(),
                'id_etudiant' => $certif->getid_etudiant(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function afficherCertif($id_exam)
    {
        try{
            $pdo=config::getConnexion();
            $query=$pdo->prepare("select * from certif where id_exam= :id_");
            $query->execute(['id' =>$id_exam]);
            return $query->fetchAll();      

        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public function afficherExam()
    {
        try{
            $pdo=config::getConnexion();
            $query=$pdo->prepare("select * from exams");
            $query->execute();
            return $query->fetchAll();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    
}
