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
        <form action="insert_intervention.php" method="post">
            <input type="hidden" name="token" value="<?php echo $token ?>">
            <div class="form-group">
                <label for="date_debut">Date de début</label>
                <input class="form-control" type="date" name="date_debut">
            </div>
            <div class="form-group">
                <label for="date_fin">Date de fin</label>
                <input class="form-control" type="date" name="date_fin">
            </div>
            <div class="form-group">
                <label for="lieu">Lieu</label>
                <input class="form-control" type="text" required maxlength="50" name="lieu">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input class="form-control" type="text" required maxlength="50" name="description">
            </div>
            <a href="../intervention.php" class="mt-5 btn btn-light">Annuler</a>
            <input type="submit" class="mt-5 btn btn-success" value="Enregistrer">
        </form>
    </div>
<?php
include("../footer.php");
?>