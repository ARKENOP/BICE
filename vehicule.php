<?php
$title="Gestion des véhicules";
include('header.php');
?>
<button onclick="window.location.href = 'index.php'" style="margin-top: 50px"><img src="images/back.png" style="height: 50px"></button>
<h1 style="text-align: center; margin-top: -50px;color: white">Gestion des Véhicules</h1>

<?php
//pour se connecter à la BDD on va utiliser PDO
//PHP Data Object
//je crée un objet PDO
include('config_pompier.php');
$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);
//je prépare une requete SQL
$requete = $pdo->prepare("select * from vehicule");
//executer ma requête
$requete->execute();
//récupération des lignes
$lignes = $requete->fetchAll();

//affichage en debug du contenu d'une variable
//jamais en PROD dans une appli !
//var_dump($lignes);
?>
<?php
foreach ($lignes as $l){
    ?>
<div class="card-container" style="margin-bottom: 30px;margin-top: 50px">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo $l["nom"] ?></h5>
            <p class="card-text">Immatriculation: <?php echo $l["immatriculation"] ?></p>
            <p class="card-text">Liste du matériel :</p>
            <table class="table table-sm">
                <tr>
                    <th>Code barre</th>
                    <th>Denomination</th>
                    <th>Catégorie</th>
                    <th>Nombre utilisation</th>
                    <th>Nombre utilisation limite</th>
                    <th>Date Peremption</th>
                    <th>Date Maintenance</th>
                </tr>
                <?php
                $requete2 = $pdo->prepare("select * from materiel where id_vehicule = :id");
                $requete2->execute(array(':id' => $l["id"]));
                $materiels = $requete2->fetchAll();
                foreach ($materiels as $m){
                    ?>
                    <tr>
                        <td><?php echo $m["code_barre"] ?></td>
                        <td><?php echo $m["denomination"] ?></td>
                        <td><?php echo $m["categorie"] ?></td>
                        <td><?php echo $m["nb_utilisation"] ?></td>
                        <td><?php echo $m["nb_utilisation_limite"] ?></td>
                        <td><?php echo $m["date_peremption"] ?></td>
                        <td><?php echo $m["date_maintenance"] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <a class="btn btn-primary"
               href="modifier/modifier_vehicule.php?id=<?php echo $l["id"] ?>">Modifier</a>
            <a class="btn btn-danger"
               href="supprimer/delete_vehicule.php?id=<?php echo $l["id"] ?>">Supprimer</a>
        </div>
    </div>
</div>
    <?php
}
?>
<br>
</table>
<a href="ajouter/ajouter_vehicule.php" class="mt5 btn btn-success">Ajouter un véhicule</a>
<?php
include('footer.php');
?>
