<?php
//initialiser les sessions
session_start();

$title="Créer un vehicule";
include('../header.php');

//générer un token de sécurité
$token=uniqid();
//le stocker en session côté serveur
$_SESSION["token"]=$token;

?>
<div style="margin-top: 75px;color: white;font-family: Century">
    <form action="insert_vehicule.php" method="post">
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input class="form-control" type="text" required maxlength="50" name="nom">
        </div>
        <div class="form-group">
            <label for="immatriculation">Immatriculation</label>
            <input class="form-control" type="text" required maxlength="50" name="immatriculation">
        </div>
        <div class="form-group">
            <label for="etat">État</label>
            <input class="form-control" type="text" required maxlength="50" name="etat">
        </div>
        <a href="../vehicule.php" class="mt-5 btn btn-light">Annuler</a>
        <input type="submit" class="mt-5 btn btn-success" value="Enregistrer">
    </form>
</div>
<?php
include("../footer.php");
?>