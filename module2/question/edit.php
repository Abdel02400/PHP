<?php
include('levels.php'); // accès à la variable $levels;

//suppresion de la question dont l'id est passé en paramètre d'url
if(isset($_GET['id'])){

  $id = $_GET['id'];

  $query = $db->prepare('SELECT * FROM question WHERE id= :id');

  $result = $query->execute(array(
    ':id'    => intval($id)
  ));

  $question = $query->fetch(PDO::FETCH_OBJ);

  $query2 = $db->prepare('SELECT * FROM categories');

  $query2->execute();

  $categories = $query2->fetchAll(PDO::FETCH_OBJ);

  $query3 = $db->prepare('SELECT * FROM souscategory');

  $query3->execute();

  $souscategory = $query3->fetchAll(PDO::FETCH_ASSOC);

  // if($result) {
  //   header('location:?route=question/list');
  // }
  // else{
  //   echo "la suppresion a échoué";
  // }
}
if(isset($_POST['submit'])){
    //var_dump($_POST);

    //1 validation des données

    $cond1 = $_POST['title'] != "";
    $cond2 = $_POST['category'] != "0";
    $cond3 = $_POST['level'] != "0";

    if($cond1 && $cond2 && $cond3){
      $query = $db->prepare('UPDATE question SET title = :title, category = :category, level = :level WHERE id = :id');
      $result = $query->execute(array(

        ':title'    => $_POST['title'],
        ':category' => $_POST['category'],
        ':level'    => intval($_POST['level']),
        ':id'       => intval($_POST['id'])

      ));
      if($result) {
        //retour vers la liste des questions
        header('location:?route=question/list');
      }
      else{
        echo "<p style='color:green'>L'ajout a été reussi</p>";
      }

    }
    else {
      echo "<p style='color:red'>Une des conditions de validation n'est pas rempli</p>";
    }
}


?>

<div class="container">
<h2>Modifier des questions</h2>

  <form class="" method="post" style="width:30%">

    <div class="form-group">
      <label>Intitulé</label>
      <input type="text" class="form-control" name="title" value="<?= $question->title ?>">
    </div>

    <div class="form-group">
      <select name="category">
        <option value="0">Choisir une catégorie</option>
        <?php foreach($souscategory as $c): ?>
          <?php if($question->category == $c['title']): ?>
            <option selected><?= $c['title'] ?></option>
          <?php endif ?>
        <?php endforeach ?>
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
        <?php foreach($levels as $k => $level): ?>
            <?php if($question->level == $k): ?>
              <option value="<?= $k ?>" selected><?= $level ?></option>
            <?php else: ?>
            <option value="<?= $k ?>"><?= $level ?></option>
            <?php endif ?>
        <?php endforeach ?>
      </select>
    </div>

    <!-- le champ hidden permet d'ajouter dans la super global $_POST des information
    des informations que l'ont souhaite conservé (l'id de la question ici)-->

    <input type="hidden" value="<?= $id ?>" name="id">
    <input type="submit" class="btn btn-primary" value="Valider" name="submit">

  </form>
</div>
