<?php
//Cette page doit recevoir un paramètre id
// Exemple : http://...../modifier_categorier.php?id=8

$title="Modifier un client";
include("../header.php");

//Je vais aller chercher la catégorie à modifier en BDD
//1 : je récupère l'id donné en paramètre GET
$id=filter_input(INPUT_GET, "id");
//2 : Je vais lire dans la BDD
include "../config_pompier.php";
$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);
$requete=$pdo->prepare("select * from vehicule where id=:id");
$requete->bindParam("id",$id);
$requete->execute();
$lignes=$requete->fetchAll();
//Si je n'ai pas récupéré 1 ligne (ni plus ni moins)
//C'est un problème
if(count($lignes)!=1){
    http_response_code(404);//je lève une erreur 404
    echo "Catégorie inexistante";
    die(); //J'arrête là.
}
//Si j'arrive là c'est que tout va bien
$categorie=$lignes[0]; //La catégorie est ma première et unique ligne

?>
<h1>Modifier une catégorie</h1>
    <form action="update_vehicule.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="form-group">
            <label for="denomination">Nom</label>
            <input value="<?php echo htmlspecialchars($categorie["nom"]) ?>" class="form-control" type="text" required maxlength="50" name="nom">
        </div>
        <div class="form-group">
            <label for="immatriculation">Immatriculation</label>
            <input value="<?php echo htmlspecialchars($categorie["immatriculation"]) ?>" class="form-control" type="text" required maxlength="50" name="immatriculation">
        </div>
        <div class="form-group">
            <label for="etat">État</label>
            <input value="<?php echo htmlspecialchars($categorie["etat"]) ?>" class="form-control" type="text" required maxlength="50" name="etat">
        </div>
        <a href="../vehicule.php" class="mt-5 btn btn-light">Annuler</a>
        <input type="submit" class="mt-5 btn btn-success" value="Enregistrer">
    </form>
<?php

include("../footer.php");
?>