<?php
session_start();

//Ce fichier ne va rien afficher
//il va faire l'insert dans la table et retourner à l'index


//vérifier le token de sécurité
$tokenRecu=filter_input(INPUT_POST,"token");
if($_SESSION["token"]!=$tokenRecu)
    die("Vilain pirate");

//récupérer les données du POST
$id=filter_input(INPUT_POST, "id");
$denomination=filter_input(INPUT_POST, "denomination");
$categorie=filter_input(INPUT_POST, "categorie");
$etat=filter_input(INPUT_POST, "etat");
$nb_utilisation=filter_input(INPUT_POST, "nb_utilisation");
$date_peremption=filter_input(INPUT_POST, "date_peremption");
$date_maintenance=filter_input(INPUT_POST, "date_maintenance");
$id_vehicule=filter_input(INPUT_POST, "id_vehicule");

//je crée un objet PDO
include "../config_pompier.php";
$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);

$requete = $pdo->prepare("insert into client(denomination,categorie,etat,nb_utilisation,date_peremption,date_maintenance,id_vehicule)"."values(:denomination,:categorie,:etat,:nb_utilisation,:date_peremption,:date_maintenance,:id_vehicule)");

$requete->bindParam(":id",$id);
$requete->bindParam(":denomination",$denomination);
$requete->bindParam(":categorie",$categorie);
$requete->bindParam(":etat",$etat);
$requete->bindParam(":nb_utilisation",$nb_utilisation);
$requete->bindParam(":date_peremption",$date_peremption);
$requete->bindParam(":date_maintenance",$date_maintenance);
$requete->bindParam(":id_vehicule",$id_vehicule);

$requete->execute();

//retourner à l'accueil
header("location:../Projet/materiel.php");
?>







