<?php

function getAnswerById($answers, $id){
  //recherche une reponse identifié dans un tableau de réponse
  $answer = NULL;
  foreach($answers as $a){
    if($a->id == $id){
      $answer = $a;
      break; // réponse trouvé sorti de boucle
    }
  }
  return $answer;
}

if(isset($_GET['id_question'])){

  $id_question = $_GET['id_question'];

  $query = $db->prepare('SELECT title FROM question WHERE id = :id');
  $query->execute(array(

    ':id' => $id_question

  ));
  $title = $query->fetch(PDO::FETCH_OBJ)->title;

  $query2 = $db->prepare('SELECT id,body,correct FROM answer WHERE id_question = :id_question');
  $query2->execute(array(
    ':id_question' => $id_question
  ));
  $answers = $query2->fetchAll(PDO::FETCH_OBJ);

  if(isset($_GET['edit']) && isset($_GET['id_answer'])){
    $answerEdit = getAnswerById($answers, intval($_GET['id_answer']));
  }

}
if(isset($_POST['submit'])){
  // formulaire d'ajout d'une réponse envoyé
  //Enregistrement en DB
  $correct = 0;
  if(isset($_POST['correct'])) $correct = 1;

  $query = $db->prepare('INSERT INTO answer (body, correct, id_question) VALUES (:body, :correct, :id_question)');
  $result = $query->execute(array(
    ':body' => $_POST['body'],
    ':correct' => $correct,
    ':id_question' => intval($_POST['id_question'])
  ));
  ($result) ? header('location:?route=answer/manage&id_question='.$_POST['id_question'])
  : print("<p>L\'enregistrement de la réponse a échoué</p>");

}
if(isset($_POST['update'])){
  $correct = 0;
  if(isset($_POST['correct'])) $correct = 1;
  $query = $db->prepare('UPDATE answer SET body = :body, correct = :correct WHERE id = :id');
  $result = $query->execute(array(
    ':body' => $_POST['body'],
    ':correct' => intval($correct),
    ':id' => intval($_POST['id_answer'])
  ));

  $url = '?route=answer/manage&id_question=' . $_POST['id_question'];

  $url = '?route=answer/manage&id_question=' . $id_question;
  ($result) ? header('location:'. $url)
  : print("<p>L\'enregistrement de la réponse a échoué</p>");

}
?>




<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2>Question : <?= $title ?></h2>
      <?php if(sizeof($answers) == 0): ?>
          <p class="alert alert-warning">Aucune réponse enregistrer</p>
      <?php else: ?>
      <h3>Liste des réponses</h3>
      <table class="table table-bordered table-striped">
        <?php $i = 1; ?>
        <?php foreach ($answers as $answer): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $answer->body ?></td>
            <td>
              <?php
                echo ($answer->correct == 1) ? 'Bonne' : 'Mauvaise';
              ?>
              &nbsp;réponse
            </td>
            <td>
              <?php $urlDel = '?route=answer/delete&id_answer=' . $answer->id;
                    $urlDel .= '&id_question=' . $id_question;
                    $urlEdit = '?route=answer/manage&id_question=' . $id_question;
                    $urlEdit .= '&edit=true&id_answer=' . $answer->id;
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
        <h3>Ajouter une réponse</h3>
        <form class="well" method="POST">
          <div class="form-group">
            <label for="body">Texte de la réponse</label>
            <textarea name="body" required></textarea>
          </div>
          <div class="form-group">
            <label for="correct">Bonne réponse</label>
            <input type="checkbox" name="correct"></textarea>
          </div>
          <input type="hidden" name="id_question" value="<?= $id_question ?>">
          <input type="submit" name="submit" value="Enregistrer">
        </form>
      <?php else: ?>

        <h3>Modifier la réponse</h3>
        <form class="well" method="POST">
          <div class="form-group">
            <label for="body">Texte de la réponse</label>
            <textarea name="body" required><?= $answerEdit->body?></textarea>
          </div>
          <div class="form-group">
            <label for="correct">Bonne réponse</label>
            <?php if($answerEdit->correct ==1): ?>
              <input type="checkbox" name="correct" checked></textarea>
            <?php else: ?>
              <input type="checkbox" name="correct"></textarea>
            <?php endif ?>
          </div>
          <input type="hidden" name="id_answer" value="<?= $answerEdit->id ?>">
          <input type="hidden" name="id_question" value="<?= $id_question ?>">
          <input class="btn btn-primary" type="submit" name="update" value="Modifier">
          <?php $url = '?route=answer/manage&id_question=' . $id_question; ?>
          <a href="<?= $url ?>">Annuler</a>
        </form>

      <?php endif ?>
    </div>
  </div>
</div>
