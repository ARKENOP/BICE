<?php

include('../config_pompier.php');

$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);

$query = $pdo->query("SELECT * FROM materiel;");

if($query->rowCount() > 0){
    $delimiter = ";";
    $filename = "members-data_" . date('Y-m-d') . ".csv";

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers
    $fields = array('CODE BARRE', 'DENOMINATION', 'CATEGORIE', 'NOMBRE UTILISATION', 'NOMBRE UTILISATION LIMITE', 'DATE PEREMPTION', 'DATE MAINTENANCE');
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch()){
        $lineData = array($row['code_barre'],$row["denomination"], $row['categorie'], $row['nb_utilisation'], $row['nb_utilisation_limite'], $row['date_peremption'], $row['date_maintenance']);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file
    fseek($f, 0);

    // Set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>