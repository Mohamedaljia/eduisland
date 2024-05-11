<?php
$server = "localhost";
$login = "root";
$dbName = "projectdba";
$pwd = "Rubyboubi2020";

try {
    // Établir une connexion à la base de données avec PDO
    $dsn = "mysql:host=$server;dbname=$dbName;charset=utf8";
    $conn = new PDO($dsn, $login, $pwd);
    
    // Configurer PDO pour rapporter les erreurs sous forme d'exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Vous pouvez maintenant utiliser $conn pour exécuter vos requêtes SQL avec PDO
} catch(PDOException $e) {
    // En cas d'erreur de connexion à la base de données, afficher un message d'erreur
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
