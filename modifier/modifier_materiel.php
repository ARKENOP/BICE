<?php
//Cette page doit recevoir un paramètre id
// Exemple : http://...../modifier_categorier.php?id=8

$title="Modifier un client";
include("../header.php");

//Je vais aller chercher la catégorie à modifier en BDD
//1 : je récupère l'id donné en paramètre GET
$code_barre=filter_input(INPUT_GET, "code_barre");
//2 : Je vais lire dans la BDD
include "../config_pompier.php";
$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);
$requete=$pdo->prepare("select * from materiel where code_barre=:code_barre");
$requete->bindParam("code_barre",$code_barre);
$requete->execute();
$lignes=$requete->fetchAll();
$requete2=$pdo->prepare("select id,nom from vehicule");
$requete2->execute();
$requete3=$pdo->prepare("select id,date_debut from intervention");
$requete2->execute();
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
    <form action="update_materiel.php" method="post">
        <input type="hidden" name="code_barre" value="<?php echo $code_barre ?>">
        <div class="form-group">
            <label for="denomination">Dénomination</label>
            <input value="<?php echo htmlspecialchars($categorie["denomination"]) ?>" class="form-control" type="text" required maxlength="50" name="denomination">
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <input value="<?php echo htmlspecialchars($categorie["categorie"]) ?>" class="form-control" type="text" required maxlength="50" name="categorie">
        </div>
        <div class="form-group">
            <label for="etat">État</label>
            <input value="<?php echo htmlspecialchars($categorie["etat"]) ?>" class="form-control" type="text" required maxlength="50" name="etat">
        </div>
        <div class="form-group">
            <label for="nb_utilisation">Nombre d'utilisation</label>
            <input value="<?php echo htmlspecialchars($categorie["nb_utilisation"]) ?>" class="form-control" type="number" min="0" step="1" name="nb_utilisation">
        </div>
        <div class="form-group">
            <label for="Date de péremption">Date de péremption</label>
            <input value="<?php echo htmlspecialchars($categorie["date_peremption"]) ?>" class="form-control" type="date" min="0" step="1" name="date_peremption">
        </div>
        <div class="form-group">
            <label for="date_maintenance">Date de maintenance</label>
            <input value="<?php echo htmlspecialchars($categorie["date_maintenance"]) ?>" class="form-control" type="date" name="date_maintenance">
        </div>
        <div class="from-group">
            <label for="id">Choisir Vehicule:</label>
            <select class="form-control" name="id">
                <?php while ($donnees = $requete2->fetch()){
                    ?>
                    <option value="<?php echo $donnees["id"]?>"><?php echo $donnees["nom"]?></option>
                <?php } ?>
            </select>
        </div>
        <div class="from-group">
            <label for="id">Choisir Intervention:</label>
            <select class="form-control" name="date">
                <?php while ($donnees = $requete3->fetch()){
                    ?>
                    <option value="<?php echo $donnees["id"]?>"><?php echo $donnees["date_debut"]?></option>
                <?php } ?>
            </select>
        </div>
        <a href="../materiel.php" class="mt-5 btn btn-light">Annuler</a>
        <input type="submit" class="mt-5 btn btn-success" value="Enregistrer">
    </form>
<?php

include("../footer.php");
?>