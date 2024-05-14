<?php
require_once("dompdf/autoload.inc.php"); 
include '../../config.php';

use Dompdf\Dompdf;
extract($_POST);

if(isset($pdf)){
    $sql="SELECT * FROM profile ORDER BY idprofile DESC"; // Fetch data from the profile table
    $stmt = $conn->query($sql);
    $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html ='';
    $html .='
        <h2 align="center"> List of Profiles </h2>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> serial no </th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> CV </th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> Date of Creation </th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> Availability </th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> Mail </th>

            </tr>
    ';

    if(count($profiles) > 0) {
        $count = 1;
        foreach($profiles as $data) {
            $availability = ($data["disponibilite"] == 1) ? 'Available' : 'Not Available';
            $html .= '
            <tr>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$count.'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$data["cv"].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$data["date_creation"].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$availability.'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$data["mail"].'</td>

            </tr>
            ';
            $count++;
        }
    } else {
        $html .= '
        <tr>
            <td colspan="4" style="border:1px solid #ddd; padding:8px; text-align:left;"> NO data </td>
        </tr>
        ';
    }  
    $html .= '</table>'; 
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper("A4" , "portrait");
    $dompdf->render();
    $dompdf->stream("list_of_profiles.pdf");
}
?>
