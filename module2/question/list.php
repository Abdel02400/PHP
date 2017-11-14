<?php

function getNumAnswers($db, $id_question){
  $query = $db->prepare('SELECT COUNT(*) FROM answer WHERE id_question = :id_question');
  $query->execute(array(
    ':id_question' => $id_question
  ));
  $num = $query->fetch(PDO::FETCH_NUM);
  return $num[0];
}
function getLevel($in){

  $out = "";
  if($in == 1){
    $out = "Facile";
  }
  if($in == 2){
    $out = "Moyen";
  }
  if($in == 3){
    $out = "Difficile";
  }
  return $out;
}
//1. préparation de la requête
$query = $db->prepare('SELECT * FROM question');


//2. exécution
$query->execute();

//3 récuperation des données (fetch)
$questions = $query->fetchAll(PDO::FETCH_OBJ);




?>
<div class="container">

  <h2>liste des questions</h2>

  <table class="table table-bordered table-striped">
    <tr>
      <th>N°</th>
      <th>Intitulé</th>
      <th>Catégorie</th>
      <th>Niveau</th>
      <th>Actions</th>
    </tr>
  <?php $i = 1; ?>
  <?php foreach($questions as $question): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td><?= $question->title ?></td>
      <td><?= $question->category ?></td>
      <td><?= getLevel($question->level) ?></td>
      <td>
        <a href="?route=answer/manage&id_question=<?= $question->id ?>" class="btn btn-success btn-xs"><?= getNumAnswers($db, $question->id)?> réponse(s)</a>
        <a href="?route=question/edit&id=<?= $question->id ?>" class="btn btn-primary btn-xs">Modifier</a>
        <a href="?route=question/delete&id=<?= $question->id ?>" class="btn btn-danger btn-xs">Supprimer</a>
      </td>
    </tr>
  <?php endforeach ?>
  </table>
</div>
