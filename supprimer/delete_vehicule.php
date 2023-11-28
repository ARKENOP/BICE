<?php
//Ce fichier ne va rien afficher
//il va faire delete dans la table et retourner à l'index

//récupérer les données du POST
$id=filter_input(INPUT_GET,"id");


//je crée un objet PDO
include "../config_pompier.php";

$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);

$delete=$pdo->prepare("DELETE FROM vehicule"." where id=:id");

$delete->bindParam(":id", $id);
$delete->execute();

//renourner à l'accueil
header("location:../vehicule.php");



?>







