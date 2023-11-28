<?php
$title="Résultats de la recherche";
include('../Pompier/header.php');
?>

<div class="container">

  <h1 style="text-align: center; margin-top: 50px; color: white">Résultats de la recherche</h1>

  <?php
  // Vérification si la variable de recherche existe
  include('config_pompier.php');
  if (isset($_GET['code_barre'])) {
    // Recherche du matériel correspondant au code barre
    $pdo = new PDO("mysql:host=".config_pompier::SERVEUR.";dbname=".config_pompier::BDD
    ,config_pompier::UTILISATEUR,config_pompier::MOTDEPASSE);
    $requete = $pdo->prepare("SELECT * FROM materiel WHERE code_barre = ?");
    $requete->execute([$_GET['code_barre']]);
    $resultat = $requete->fetch();
    // Vérification si un résultat a été trouvé
    if ($resultat) {
      ?>
      <table class="table table-striped table-dark" style="margin-top: 50px">
        <tr>
          <th>Code barre</th>
          <th>Dénomination</th>
          <th>Catégorie</th>
          <th>Nombre utilisation</th>
          <th>Nombre utilisation limite</th>
          <th>Date Péremption</th>
          <th>Date Maintenance</th>
          <th>État</th>
          <th>ID véhicule</th>
          <th>Modifier</th>
          <th>Supprimer</th>
        </tr>
        <tr>
          <td><?php echo $resultat['code_barre'] ?></td>
          <td><?php echo $resultat['denomination'] ?></td>
          <td><?php echo $resultat['categorie'] ?></td>
          <td><?php echo $resultat['nb_utilisation'] ?></td>
          <td><?php echo $resultat['nb_utilisation_limite'] ?></td>
          <td><?php echo $resultat['date_peremption'] ?></td>
          <td><?php echo $resultat['date_maintenance'] ?></td>
          <td><?php echo $resultat['etat'] ?></td>
          <td><?php echo $resultat['id_vehicule'] ?></td>
          <td><a class="btn btn-primary"
                 href="modifier/modifier_materiel.php?code_barre=<?php echo $resultat['code_barre'] ?>">Modifier</a></td>
          <td><a class="btn btn-danger"
                 href="supprimer/supprimer_materiel.php?code_barre=<?php echo $resultat['code_barre'] ?>">Supprimer</a></td>
        </tr>
      </table>
      <?php
    }
  }
  else {
// Si la requête n'a pas retourné de résultats, on affiche un message d'erreur
        echo '<p style="color: white">Aucun résultat trouvé pour le code barre ' . 'jaja'. '</p>';
    }
  ?>

</div>
<?php
// On inclut le footer sur la page
include('../Pompier/footer.php');
?>