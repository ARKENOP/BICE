<?php
session_start();

//Ce fichier ne va rien afficher
//il va faire l'insert dans la table et retourner à l'index


//vérifier le token de sécurité
$tokenRecu=filter_input(INPUT_POST,"token");
if($_SESSION["token"]!=$tokenRecu)
    die("Vilain pirate");

//récupérer les données du POST
$nom=filter_input(INPUT_POST, "nom");
$immatriculation=filter_input(INPUT_POST, "immatriculation");
$etat=filter_input(INPUT_POST, "etat");

//je crée un objet PDO
include "../config_pompier.php";
$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);

$requete = $pdo->prepare("insert into vehicule (nom,immatriculation,etat)"."values(:nom,:immatriculation,:etat)");

$requete->bindParam(":nom",$nom);
$requete->bindParam(":immatriculation",$immatriculation);
$requete->bindParam(":etat",$etat);

$requete->execute();

//retourner à l'accueil
header("location:../vehicule.php");
?>







