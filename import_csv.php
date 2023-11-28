<?php
// Connect to database
include("config_pompier.php");

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");

        // Se connecter à la base de données
        try {
            $pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
                ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("La connexion a échoué : " . $e->getMessage());
        }


        $stmt = $pdo->prepare("INSERT into materiel (code_barre,denomination,categorie,nb_utilisation,nb_utilisation_limite,date_peremption,date_maintenance)
             values (:code_barre,:denomination,:categorie,:nb_utilisation,:nb_utilisation_limite,:date_peremption,:date_maintenance)");

        while (($column = fgetcsv($file, 0, ";")) !== FALSE) {
            var_dump($column);
            // Vérifier que les indices existent dans le tableau $column
            $code_barre = isset($column[0]) ? $column[0] : '';
            $denomination = isset($column[1]) ? $column[1] : '';
            $categorie = isset($column[2]) ? $column[2] : '';
            $nb_utilisation = isset($column[3]) ? $column[3] : '';
            $nb_utilisation_limite = isset($column[4]) ? $column[4] : '';
            $date_peremption = isset($column[5]) ? $column[5] : '';

            // Vérifier que le code-barres est valide
            if (!preg_match('/^\d{8}$/', $code_barre)) {
                echo "<p style='color:red'>Erreur : le code-barres $code_barre n'est pas valide.</p>";
                continue;
            }

            if ($date_peremption != '') {
                $date_peremption = DateTime::createFromFormat('d/m/Y', $date_peremption);
                $date_peremption_formatted = $date_peremption->format('Y-m-d');
                echo $date_peremption_formatted;
            } else {
                $date_peremption_formatted = null;
            }

            $date_maintenance = isset($column[6]) ? $column[6] : '';
            if ($date_maintenance != '') {
                $date_maintenance = DateTime::createFromFormat('d/m/Y', $date_maintenance);
                $date_maintenance_formatted = $date_maintenance->format('Y-m-d');
                echo $date_maintenance_formatted;
            } else {
                $date_maintenance_formatted = null;
            }

            $stmt->execute(array(
                ':code_barre' => $code_barre,
                ':denomination' => $denomination,
                ':categorie' => $categorie,
                ':nb_utilisation' => $nb_utilisation,
                ':nb_utilisation_limite' => $nb_utilisation_limite,
                ':date_peremption' => $date_peremption_formatted,
                ':date_maintenance' => $date_maintenance_formatted
            ));

            $rowCount = $stmt->rowCount();

            if ($rowCount > 0) {
                $type = "success";
                $message = "Les Données sont importées dans la base de données";
            } else {
                $type = "error";
                $message = "Problème lors de l'importation de données CSV";
            }
        }
    }
    // Fermer la connexion à la base de données
    $pdo = null;
}
//Retourner à la page index.php
header('location:../Pompier/index.php');
exit;
?>