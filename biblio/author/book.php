<?php
include_once('./class/AUTHOR.php');
if(isset($_GET['id_author'])){
$id = $_GET['id_author'];
$authorbook = new Author($db, NULL, NULL, NULL, NULL);
$list = $authorbook->getBook($id);
$author_info = $authorbook->authorInfo($id);
}
?>
<div class="row">

  <div class="col-md-8">
    <h2>Livre écrit par l'auteur : <?= $author_info->firstname ?> <?= $author_info->lastname ?></h2>
    <table class="table table-bordered table-striped">
        <tr>
          <th>#</th>
          <th>titre</th>
        </tr>
        <?php $i = 0 ?>
        <?php  if($list == false): ?>
          <p class="alert alert-warning">Aucun livre enregistrée</p>
        <?php else: ?>
        <?php foreach($list as $l): ?>
          <tr>
            <td><?= ++$i ?></td>
            <td><?= $l->title ?></td>
          </tr>
        <?php endforeach ?>
        <?php endif ?>
      </table>
  </div>
