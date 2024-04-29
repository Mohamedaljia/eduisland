<?php
require_once '../config.php';

class ExamCertif
{
    private ?int $id = null;
    private ?int $id_examCertif = null;
    private ?int $id_certifExam = null;

    public function __construct($id, $id_examCertif, $id_certifExam)
    {
        $this->id = $id;
        $this->id_examCertif = $id_examCertif;
        $this->id_certifExam = $id_certifExam;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdExamCertif()
    {
        return $this->id_examCertif;
    }

    public function setIdExamCertif($id_examCertif)
    {
        $this->id_examCertif = $id_examCertif;
        return $this;
    }

    public function getIdCertifExam()
    {
        return $this->id_certifExam;
    }

    public function setIdCertifExam($id_certifExam)
    {
        $this->id_certifExam = $id_certifExam;
        return $this;
    }
}

class DatabaseConfig {
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    private function generateId()
    {
        return mt_rand(10000000, 99999999); // Generates a random 8-digit number
    }

    public function insertJoinedRecords()
    {
        // Step 1: Write the SQL Query
        $sql = "SELECT exams.id AS exam_id, certif.id_certif AS certif_id
                FROM exams
                INNER JOIN certif ON exams.id = certif.id_exam";

        // Step 2: Prepare and Execute the Query
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        // Step 3: Fetch the Results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Step 4: Insert Data into exam_certif Table
        $insertSql = "INSERT INTO exam_certif (id, id_examCertif, id_certifExam) VALUES (:id, :id_examCertif, :id_certifExam)";
        $insertStmt = $this->connection->prepare($insertSql);

        foreach ($results as $row) {
            $id = $this->generateId(); // Generate a random ID
            $insertStmt->bindParam(':id', $id);
            $insertStmt->bindParam(':id_examCertif', $row['exam_id']);
            $insertStmt->bindParam(':id_certifExam', $row['certif_id']);
            $insertStmt->execute();
        }

        echo "Records inserted successfully.";
    }
}

// Usage
$database = new DatabaseConfig(config::getConnexion());
$database->insertJoinedRecords();
?>
