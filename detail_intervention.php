<?php
$title="Gestion des materiel";
include('../Pompier/header_recherche.php');
?>

<button onclick="window.location.href = 'index.php'" style="margin-top: 50px"><img src="images/back.png" style="height: 50px"></button>
<h1 style="text-align: center; margin-top: -50px;color: white">Gestion du Matériel</h1>

<br>
<br>

<form enctype="multipart/form-data" action="import_csv.php" method="post">
    <div class="input-row">
        <h3 style="color: white">Choisir un fichier CSV :</h3>
        <br />
        <input class="form-control" type="file" name="file" id="file" accept=".csv">
        <br />
        <button class="btn btn-primary" type="submit" id="submit" name="import" class="btn-submit">Importer</button>
        <br />
    </div>
</form>
<?php
//pour se connecter à la BDD on va utiliser PDO
//PHP Data Object
//je crée un objet PDO
include('config_pompier.php');
$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);
//je prépare une requete SQL
$requete = $pdo->prepare("select * from materiel");
//executer ma requête
$requete->execute();
//récupération des lignes
$lignes = $requete->fetchAll();

//affichage en debug du contenu d'une variable
//jamais en PROD dans une appli !
//var_dump($lignes);
?>

<table class="table table-striped table-dark" style="margin-top: 50px">
    <tr>
        <th>Code barre</th>
        <th>Denomination</th>
        <th>Catégorie</th>
        <th>Nombre utilisation</th>
        <th>Nombre utilisation limite</th>
        <th>Date Peremption</th>
        <th>Date Maintenance</th>
        <th>État</th>
        <th>ID véhicule</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    <?php
    foreach ($lignes as $l){
        ?>
        <tr>
            <td><?php echo $l["code_barre"] ?></td>
            <td><?php echo $l["denomination"] ?></td>
            <td><?php echo $l["categorie"] ?></td>
            <td><?php echo $l["nb_utilisation"] ?></td>
            <td><?php echo $l["nb_utilisation_limite"] ?></td>
            <td><?php echo $l["date_peremption"] ?></td>
            <td><?php echo $l["date_maintenance"] ?></td>
            <td><?php echo $l["etat"] ?></td>
            <td><?php echo $l["id_vehicule"] ?></td>
            <td><a class="btn btn-primary"
                   href="modifier/modifier_materiel.php?code_barre=<?php echo $l["code_barre"] ?>">Modifier</a></td>
            <td><a class="btn btn-danger"
                   href="supprimer/delete_materiel.php?code_barre=<?php echo $l["code_barre"] ?>">Supprimer</a></td>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<a href="ajouter/ajouter_materiel.php" class="mt5 btn btn-success">Ajouter</a>
<br>
<br>
<div class="input-row">
    <a href="test/export_materiel_maintenance.php"><button class="btn btn-primary">Export maintenance</button></a>
</div>
<br>
<div class="input-row">
    <a href="test/export_materiel_perime.php"><button class="btn btn-primary">Export perime</button></a>
</div>
<br>
<div class="input-row">
    <a href="test/export_materiel_total.php"><button class="btn btn-primary">Export total</button></a>
</div>
<?php
include('../Pompier/footer.php');
?>
