<?php
require_once("dompdf/autoload.inc.php"); 

include '../../config.php';
use Dompdf\Dompdf;
extract($_POST);

if(isset($pdf)){
    $sql="SELECT * FROM partenaire ORDER BY idpartenaire DESC"; // Fetch data from the partenaires table
    $stmt = $conn->query($sql);
    $partenaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html ='';
    $html .='
        <h2 align="center"> List of Partners </h2>
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> serial no </th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> Nom </th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> Contact </th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> Date de recrutement </th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> Adresse </th>
                <th style="border:1px solid #ddd; padding:8px; text-align:left;"> Offre </th>
            </tr>
    ';

    if(count($partenaires) > 0) {
        $count = 1;
        foreach($partenaires as $data) {
            $html .= '
            <tr>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$count.'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$data["nom"].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$data["contact"].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$data["date_recru"].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$data["adresse"].'</td>
                <td style="border:1px solid #ddd; padding:8px; text-align:left;">'.$data["offre"].'</td>
            </tr>
            ';
            $count++;
        }
    } else {
        $html .= '
        <tr>
            <td colspan="6" style="border:1px solid #ddd; padding:8px; text-align:left;"> NO data </td>
        </tr>
        ';
    }  
    $html .= '</table>'; 
    $dompdf = new DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper("A4" , "portrait");
    $dompdf->render();
    $dompdf->stream("list_of_partners.pdf");
}
?>
