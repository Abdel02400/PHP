<?php

$query = $db->prepare('SELECT * FROM categories');

$query->execute();

$categories = $query->fetchAll(PDO::FETCH_OBJ);

$query2 = $db->prepare('SELECT * FROM souscategory');

$query2->execute();

$souscategory = $query2->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['submit'])){
  //var_dump($_POST);

  //1 validation des données


  $cond1 = $_POST['title'] != "";
  $cond2 = $_POST['category'] != "0";
  $cond3 = $_POST['level'] != "0";

  if($cond1 && $cond2 && $cond3){
    //toute les conditions sont remplies
    //2 enregistrement des données

    //1. preparation de la requete
    $query = $db->prepare('INSERT INTO question (title,category,level) VALUES (:title, :category, :level)');

    //2 . exécution
    $result = $query->execute(array(

      ':title'    => $_POST['title'],
      ':category' => $_POST['category'],
      ':level'    => intval($_POST['level'])

    ));

    if($result) {
      //retour vers la liste des questions
      header('location:?route=question/list');
    }
    else{
      echo "<p style='color:green'>L'ajout a échoué</p>";
    }

  }
  else {
    echo "<p style='color:red'>Une des conditions de validation n'est pas rempli</p>";
  }

}

?>

<div class="container">
<h2>Ajout d'une question</h2>

  <form class="well" method="post" style="width:30%">

    <div class="form-group">
      <label>Intitulé</label>
      <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
      <select name="category">
        <option value="0">Choisir une catégorie</option>
        <?php foreach($categories as $category): ?>
          <optgroup label="<?= $category->title ?>">
              <option><?= $category->title ?></option>
              <?php foreach($souscategory as $c): ?>
                <?php if($category->id == $c['id_category']): ?>
                  <option><?= $c['title'] ?></option>
                <?php endif ?>
              <?php endforeach ?>
          </optgroup>
          <?php endforeach ?>
      </select>
    </div>


    <div class="form-group">
      <select name="level">
        <option value="0">Choisir un niveau de difficulté</option>
        <option value="1">Facile</option>
        <option value="2">Moyen</option>
        <option value="3">Difficile</option>
      </select>
    </div>

    <input type="submit" class="btn btn-primary" value="Valider" name="submit">

  </form>
</div>
