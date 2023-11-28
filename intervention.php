
<?php
$title="Intervention";
include('header.php');
?>
<button onclick="window.location.href = 'index.php'" style="margin-top: 50px"><img src="images/back.png" style="height: 50px"></button>
<h1 style="text-align: center; margin-top: -50px;color: white">Historique des Interventions</h1>

<?php
//pour se connecter à la BDD on va utiliser PDO
//PHP Data Object
//je crée un objet PDO
include('config_pompier.php');
$pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);
//je prépare une requete SQL
$requete = $pdo->prepare("select * from intervention");
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
        <th>Date de début</th>
        <th>Date de fin</th>
        <th>Lieu</th>
        <th>Description</th>
        <th>Details</th>
        <th>Modifier</th>
        <th>Supprimer</th>

    </tr>
    <?php
    foreach ($lignes as $l){
        ?>
        <tr>
            <td><?php echo $l["date_debut"] ?></td>
            <td><?php echo $l["date_fin"] ?></td>
            <td><?php echo $l["lieu"] ?></td>
            <td><?php echo $l["description"] ?></td>
            <td><a class="btn btn-primary"
                   href="detail_intervention.php?id=<?php echo $l["id"] ?>">Détails</a></td>
            <td><a class="btn btn-primary"
                   href="modifier/modifier_intervention.php?id=<?php echo $l["id"] ?>">Modifier</a></td>
            <td><a class="btn btn-danger"
                   href="supprimer/delete_intervention.php?id=<?php echo $l["id"] ?>">Supprimer</a></td>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<a href="ajouter/ajouter_intervention.php" class="mt5 btn btn-success">Ajouter</a>
<?php
include('footer.php');
?>

