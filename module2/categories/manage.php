<?php

function getNumSousCategory($db, $id_category){
  $query = $db->prepare('SELECT COUNT(*) FROM souscategory WHERE id_category = :id_category');
  $query->execute(array(
    ':id_category' => $id_category
  ));
  $num = $query->fetch(PDO::FETCH_NUM);
  return $num[0];
}

$query = $db->prepare('SELECT * FROM categories');

$query->execute();

$categories = $query->fetchAll(PDO::FETCH_OBJ);

if(isset($_GET['id'])){

  $id = $_GET['id'];

  $query2 = $db->prepare('SELECT title FROM categories WHERE id = :id');
  $query2->execute(array(
    ':id' => $id
  ));
  $cat = $query2->fetch(PDO::FETCH_OBJ)->title;

}


if(isset($_POST['submit'])){

  $cond1 = $_POST['title'] != "";

  if($cond1){

    $query = $db->prepare('INSERT INTO categories (title) VALUES (:title)');

    $result = $query->execute(array(
      ':title'    => $_POST['title']
    ));

    if($result) {

      header('location:?route=category/manage');
    }
    else{
      echo "<p style='color:green'>L'ajout a échoué</p>";
    }

  }
  else {
    echo "<p style='color:red'>Une des conditions de validation n'est pas rempli</p>";
  }

}
if(isset($_POST['update'])){

  $query = $db->prepare('UPDATE categories SET title = :title WHERE id = :id');
  $result = $query->execute(array(
    ':title' => $_POST['title'],
    ':id' => intval($_POST['id'])
  ));

  ($result) ? header('location:?route=category/manage')
  : print("<p>L\'enregistrement de la réponse a échoué</p>");

}
?>
<div class="container">

  <div class="row">

    <div class="col-md-8">

      <h2>liste des Catégories</h2>
      <?php if(sizeof($categories) == 0): ?>
          <p class="alert alert-warning">Aucune catégorie enregistrer</p>
      <?php else: ?>
      <table class="table table-bordered table-striped">
        <tr>
          <th>N°</th>
          <th>Intitulé</th>
          <th>Actions</th>
        </tr>
          <?php $i = 1; ?>
          <?php foreach($categories as $category): ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $category->title ?></td>
              <td>
                <a href="?route=souscategory/manage&id_category=<?= $category->id ?>" class="btn btn-success btn-xs"><?= getNumSousCategory($db, $category->id)?> sous catégorie(s) </a>
                <a href="?route=category/manage&id=<?= $category->id ?>&edit=true" class="btn btn-primary btn-xs">Modifier</a>
                <a href="?route=category/delete&id=<?= $category->id ?>" class="btn btn-danger btn-xs">Supprimer</a>
              </td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </table>

    </div>
    <div class="col-md-4">

      <?php if(!isset($_GET['edit'])): ?>

      <h2>Ajout d'une catégorie</h2>

        <form class="well" method="post" style="width:80%">

          <div class="form-group">
            <label>Intitulé de la catégorie</label>
            <input type="text" class="form-control" name="title">
          </div>
          <input type="submit" class="btn btn-primary" value="Valider" name="submit">
        </form>
      <?php else: ?>
        <h2>Modification d'une catégorie</h2>
          <form class="well" method="post" style="width:80%">
            <div class="form-group">
              <label>Intitulé de la catégorie</label>
              <input type="text" class="form-control" name="title" value="<?= $cat ?>">
            </div>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="submit" class="btn btn-primary" value="Enregistrer" name="update">
          </form>
      <?php endif ?>
    </div>
  </div>

</div>
