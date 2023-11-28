<?php
//Ce fichier ne va rien afficher
//il va faire l'update dans la table et retourner à l'index

//récupérer les données du POST
$code_barre=filter_input(INPUT_POST, "code_barre");
$denomination=filter_input(INPUT_POST, "denomination");
$categorie=filter_input(INPUT_POST, "categorie");
$etat=filter_input(INPUT_POST, "etat");
$nb_utilisation=filter_input(INPUT_POST, "nb_utilisation");
$date_peremption=filter_input(INPUT_POST, "date_peremption");
$date_maintenance=filter_input(INPUT_POST, "date_maintenance");
$id_vehicule=filter_input(INPUT_POST, "id");
$id_intervention=filter_input(INPUT_POST, "id");

echo $id_vehicule;
echo $id_intervention;

//je crée un objet PDO
include "../config_pompier.php";
$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);

$requete = $pdo->prepare("update materiel set denomination=:denomination,categorie=:categorie,etat=:etat,nb_utilisation=:nb_utilisation,date_peremption=:date_peremption,date_maintenance=:date_maintenance,id_vehicule=:id_vehicule,id_intervention=:id_intervention"." where code_barre=:code_barre");

$requete->bindParam(":code_barre",$code_barre);
$requete->bindParam(":denomination",$denomination);
$requete->bindParam(":categorie",$categorie);
$requete->bindParam(":etat",$etat);
$requete->bindParam(":nb_utilisation",$nb_utilisation);
$requete->bindParam(":date_peremption",$date_peremption);
$requete->bindParam(":date_maintenance",$date_maintenance);
$requete->bindParam(":id_vehicule",$id_vehicule);
$requete->bindParam(":id_intervention",$id_intervention);

$requete->execute();

//retourner à l'accueil
header("location:../materiel.php");
?>







