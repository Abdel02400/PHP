<?php
include('./categories.php');
include('./levels.php');
include('QCM.php');

if(isset($_POST['submit'])){

  $qcm = new QCM(
    $db,
    $_POST['category'],
    $_POST['level'],
    $_POST['nb_questions']
  );
  var_dump($qcm->generate());




}


?>

<div class="container">

  <h3>Génération d'un QCM</h3>

  <form  method="post">

    <div class="form-group">
      <select name="category">
        <option value="0">Choisir une catégorie</option>
        <?php foreach($categories as $category): ?>
          <option value="<?= $category->id?>"><?= $category->title ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="form-group">
      <select name="level">
        <option value="0">Choisir une niveau de difficulté</option>
        <?php foreach($levels as $key => $level): ?>
          <option value="<?= $key ?>"><?= $level ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="form-group">
      <label for="nb_questions">Nombre maximum de questions</label>
        <input type="number" name="nb_questions" >
    </div>

    <input type="submit" name="submit" value="Générer">

  </form>

</div>
