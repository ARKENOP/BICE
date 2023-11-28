<?php
//Ce fichier ne va rien afficher
//il va faire l'update dans la table et retourner à l'index

//récupérer les données du POST
$id=filter_input(INPUT_POST, "id");
$nom=filter_input(INPUT_POST, "nom");
$immatriculation=filter_input(INPUT_POST, "immatriculation");
$etat=filter_input(INPUT_POST, "etat");

//je crée un objet PDO
include "../config_pompier.php";
$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);

$requete = $pdo->prepare("update vehicule set id=:id,nom=:nom,immatriculation=:immatriculation,etat=:etat"." where id=:id");

$requete->bindParam(":id",$id);
$requete->bindParam(":nom",$nom);
$requete->bindParam(":immatriculation",$immatriculation);
$requete->bindParam(":etat",$etat);

$requete->execute();

//retourner à l'accueil
header("location:../vehicule.php");
?>







