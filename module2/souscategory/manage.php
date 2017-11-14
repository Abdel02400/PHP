<?php
function getNumSousCategoryById($souscategories, $id){
  //recherche une reponse identifié dans un tableau de réponse
  $souscategory = NULL;
  foreach($souscategories as $s){
    if($s->id == $id){
      $souscategory = $s;
      break; // réponse trouvé sorti de boucle
    }
  }
  return $souscategory;
}


if(isset($_GET['id_category'])){

  $id_category = $_GET['id_category'];

  $query = $db->prepare('SELECT title FROM categories WHERE id = :id');
  $query->execute(array(

    ':id' => $id_category

  ));
  $title = $query->fetch(PDO::FETCH_OBJ)->title;

  $query2 = $db->prepare('SELECT id,title FROM souscategory WHERE id_category = :id_category');
  $query2->execute(array(
    ':id_category' => $id_category
  ));
  $souscategories = $query2->fetchAll(PDO::FETCH_OBJ);

  if(isset($_GET['edit']) && isset($_GET['id_souscategory'])){
    $souscategoryEdit = getNumSousCategoryById($souscategories, intval($_GET['id_souscategory']));
  }

}
if(isset($_POST['submit'])){
  // formulaire d'ajout d'une réponse envoyé
  //Enregistrement en DB

  $query = $db->prepare('INSERT INTO souscategory (title, id_category) VALUES (:title, :id_category)');
  $result = $query->execute(array(
    ':title' => $_POST['title'],
    ':id_category' => intval($_POST['id_category'])
  ));
  ($result) ? header('location:?route=souscategory/manage&id_category='.$_POST['id_category'])
  : print("<p>L\'enregistrement de la réponse a échoué</p>");

}
if(isset($_POST['update'])){
  var_dump($_POST);
  $query = $db->prepare('UPDATE souscategory SET title = :title WHERE id = :id');
  $result = $query->execute(array(
    ':title' => $_POST['title'],
    ':id' => intval($_POST['id_souscategory'])
  ));

   $url = '?route=souscategory/manage&id_category=' . $id_category;
   ($result) ? header('location:'. $url)
  : print("<p>L\'enregistrement de la réponse a échoué</p>");

}
?>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2>Catégorie : <?= $title ?></h2>
      <?php if(sizeof($souscategories) == 0): ?>
          <p class="alert alert-warning">Aucune sous catégorie enregistrer</p>
      <?php else: ?>
      <h3>Liste des sous catégories</h3>
      <table class="table table-bordered table-striped">
        <?php $i = 1; ?>
        <?php foreach ($souscategories as $souscategory): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $souscategory->title ?></td>
            <td>
              <?php $urlDel = '?route=souscategory/delete&id_souscategory=' . $souscategory->id;
                    $urlDel .= '&id_category=' . $id_category;
                    $urlEdit = '?route=souscategory/manage&id_category=' . $id_category;
                    $urlEdit .= '&edit=true&id_souscategory=' . $souscategory->id;
              ?>
              <a href="<?= $urlEdit ?>" class="btn btn-primary btn-xs">Modifier</a>
              <a href="<?= $urlDel ?>" class="btn btn-danger btn-xs">Supprimer</a>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
      </table>
    </div>
    <div class="col-md-4">
      <?php if(!isset($_GET['edit'])): ?>
        <!--
        Si le paramètre edit n'est pas l'url on affiche le formulaire d'insertion
        -->
        <h3>Ajouter une sous catégorie</h3>
        <form class="well" method="post" style="width:80%">

          <div class="form-group">
            <label>Intitulé de la sous catégorie</label>
            <input type="text" class="form-control" name="title">
          </div>
          <input type="hidden" name="id_category" value="<?= $id_category ?>">
          <input type="submit" class="btn btn-primary" value="Valider" name="submit">

        </form>

      <?php else: ?>

        <h3>Modifier une sous catégorie</h3>
        <form class="well" method="post" style="width:80%">

          <div class="form-group">
            <label>Intitulé de la sous catégorie</label>
            <input type="text" class="form-control" name="title" value="<?= $souscategoryEdit->title ?>">
          </div>

          <input type="hidden" name="id_souscategory" value="<?= $souscategoryEdit->id ?>">
          <input type="hidden" name="id_category" value="<?= $id_category ?>">
          <input type="submit" class="btn btn-primary" value="Valider" name="update">

        </form>

      <?php endif ?>
    </div>
  </div>
</div>
