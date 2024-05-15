<?php
require_once("dompdf/autoload.inc.php"); 
require_once("config.php");

use Dompdf\Dompdf;

$servername = "localhost";
$username = "root";
$password = ""; // Replace with your database password
$dbname = "dev";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if(isset($_POST['pdf'])) {
    $sql = "SELECT * FROM chat ";
    $query = $conn->query($sql);
    
    $html = '
        <h2 align="center">Liste des chat</h2>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;">Serial No</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;">Message</th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;">Date</th>
            </tr>
    ';
    
    if($query->rowCount() > 0) {
        $count = 1;
        while($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= '
                <tr>
                    <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$count.'</td>
                    <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$data["message"].'</td>
                    <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$data["date"].'</td>
                </tr>
            ';
            $count++;
        }
    } else {
        $html .= '
            <tr>
                <td colspan="3" style="border:1px solid #ddd; padding:8px; text-align:left;">NO data</td>
            </tr>
        ';
    }  
    
    $html .= '</table>'; 
    
    $dompdf = new DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper("A4", "portrait");
    $dompdf->render();
    $dompdf->stream("liste_de_chat.pdf");
}
?>
