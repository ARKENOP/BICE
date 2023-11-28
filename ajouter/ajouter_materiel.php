<?php
//initialiser les sessions
session_start();

$title="Créer un materiel";
include('../header.php');

//générer un token de sécurité
$token=uniqid();
//le stocker en session côté serveur
$_SESSION["token"]=$token;

?>
<div style="margin-top: 75px;color: white;font-family: Century">
    <form action="insert_materiel.php" method="post">
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <div class="form-group">
            <label for="denomination">Dénomination</label>
            <input class="form-control" type="text" required maxlength="50" name="denomination">
        </div>
        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <input class="form-control" type="text" required maxlength="50" name="categorie">
        </div>
        <div class="form-group">
            <label for="etat">État</label>
            <input class="form-control" type="text" required maxlength="50" name="etat">
        </div>
        <div class="form-group">
            <label for="nb_utilisation">Nombre d'utilisation</label>
            <input class="form-control" type="number" min="0" step="1" name="nb_utilisation">
        </div>
        <div class="form-group">
            <label for="date_peremption">Date de péremption</label>
            <input class="form-control" type="date" name="date_peremption">
        </div>
        <div class="form-group">
            <label for="date_maintenance">Date de maintenance</label>
            <input class="form-control" type="date" name="date_maintenance">
        </div>
        <div class="form-group">
            <label for="id_vehicule">Véhicule</label>
            <input class="form-control" type="number" min="0" step="1" name="id_vehicule">
        </div>
        <a href="../materiel.php" class="mt-5 btn btn-light">Annuler</a>
        <input type="submit" class="mt-5 btn btn-success" value="Enregistrer">
    </form>
</div>
<?php
include("../footer.php");
?>