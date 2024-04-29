<?php
// fetchAttributes.php

// Include database configuration
require '../config.php';

// Check if id_exam parameter is set
if (isset($_GET['id_exam'])) {
    // Get id_exam from request
    $id_exam = $_GET['id_exam'];

    // Initialize response string
    $response = '';

    // Get attributes from the database based on id_exam
    try {
        // Connect to the database
        $db = config::getConnexion();

        // Prepare the SQL query
        $sql = "SELECT * FROM exams WHERE id_exam = :id_exam";

        // Prepare the statement
        $stmt = $db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':id_exam', $id_exam, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch attributes
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if attributes were found
        if ($row) {
            // Append attributes to response string
            foreach ($row as $key => $value) {
                $response .= "<p><strong>$key:</strong> $value</p>";
            }
        } else {
            // No attributes found
            $response = 'No attributes found for id_exam ' . $id_exam;
        }
    } catch (PDOException $e) {
        // Database error
        $response = 'Database error: ' . $e->getMessage();
    }

    // Send response
    echo $response;
} else {
    // id_exam parameter is not set
    echo 'id_exam parameter is missing';
}
?>
