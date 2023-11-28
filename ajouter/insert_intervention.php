<?php
session_start();

//Ce fichier ne va rien afficher
//il va faire l'insert dans la table et retourner à l'index


//vérifier le token de sécurité
$tokenRecu=filter_input(INPUT_POST,"token");
if($_SESSION["token"]!=$tokenRecu)
    die("Vilain pirate");

//récupérer les données du POST
$date_debut=filter_input(INPUT_POST, "date_debut");
$date_fin=filter_input(INPUT_POST, "date_fin");
$lieu=filter_input(INPUT_POST, "lieu");
$description=filter_input(INPUT_POST, "description");

//je crée un objet PDO
include "../config_pompier.php";
$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);

$requete = $pdo->prepare("insert into intervention (date_debut,date_fin,lieu,description)"."values(:date_debut,:date_fin,:lieu,:description)");

$requete->bindParam(":date_debut",$date_debut);
$requete->bindParam(":date_fin",$date_fin);
$requete->bindParam(":lieu",$lieu);
$requete->bindParam(":description",$description);

$requete->execute();

//retourner à l'accueil
header("location:../intervention.php");
?>








