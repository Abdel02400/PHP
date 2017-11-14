<?php
include_once('./class/AUTHOR.php');
$authors = new Author($db,NULL,NULL,NULL, NULL);
$listauthors = $authors->listAuthor();
if(isset($_POST['submit'])){
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $birth_year = $_POST['birth_year'];
  $country = $_POST['country'];
  $addauthor = new Author($db, $firstname, $lastname, $birth_year, $country);
  $addauthor->addAuthor();
}
if(isset($_GET['edit'])){
  $id_author = $_GET['id_author'];
  $edit_author = new Author($db,NULL,NULL,NULL, NULL);
  $author_info = $edit_author->authorInfo($id_author);
  if(isset($_POST['update'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birth_year = $_POST['birth_year'];
    $country = $_POST['country'];
    $edit_author = new Author($db, $firstname, $lastname, $birth_year, $country);
    $edit_author->editAuthor($id_author);
  }
}
?>
<div class="row">

  <div class="col-md-8">
    <h2>Liste des auteurs</h2>
    <table class="table table-bordered table-striped">
        <tr>
          <th>#</th>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Année de naissance</th>
          <th>Pays d'origine</th>
          <th>Actions</th>
        </tr>
        <?php $i = 0 ?>
        <?php  if($listauthors == false): ?>
          <p class="alert alert-warning">Aucun auteur enregistrée</p>
        <?php else: ?>
        <?php foreach($listauthors as $author): ?>
          <tr>
            <td><?= ++$i ?></td>
            <td><?= $author->firstname ?></td>
            <td><?= $author->lastname ?></td>
            <td><?= $author->birth_year ?></td>
            <td><?= $author->country ?></td>
            <td>
              <?php
                $urlDel = '?route=author/delete&id_author=' . $author->id;

                $urlEdit = '?route=author/manage&id_author=' . $author->id;
                $urlEdit .= '&edit=true';
              ?>
              <a
                href="?route=author/book&id_author=<?= $author->id ?>"
                class="btn btn-primary btn-xs">
                <?php
                $id = $author->id;
                $nblivre = $authors->getNbBook($id);
                ?><?= $nblivre ?> livre(s)</a>
              <?php if($role == 'Administrateur'): ?>
              <a
                href="<?= $urlEdit ?>"
                class="btn btn-default btn-xs">Modifier</a>
              <a
                href="<?= $urlDel ?>"
                class="btn btn-danger btn-xs">Supprimer</a>
              <?php endif ?>
            </td>
          </tr>
        <?php endforeach ?>
        <?php endif ?>
      </table>
  </div>
  <?php if($role == 'Administrateur'): ?>
  <div class="col-md-4">
    <?php if(!isset($_GET['edit'])): ?>
      <h3>Ajouter un auteur</h3>
      <form class="well" method="POST">

        <div class="form-group">
          <label for="firstname">Prénom : </label>
          <input type="text" name="firstname" placeholder="Prénom" required>
        </div>

        <div class="form-group">
          <label for="lastname">Nom : </label>
          <input type="text" name="lastname" placeholder="Nom" required>
        </div>

        <div class="form-group">
          <label for="birth_year">Année de naissance : </label>
          <input type="text" name="birth_year" placeholder="Année de naissance" required>
        </div>

        <div class="form-group">
          <label for="country">Pays d'origine : </label>
          <input type="text" name="country" placeholder="Pays d'origine" required>
        </div>

        <input type="submit" name="submit" value="Enregistrer">
      </form>
    <?php else: ?>

      <h3>Modifier un auteur</h3>
      <form class="well" method="POST">

        <div class="form-group">
          <label for="firstname">Prénom : </label>
          <input type="text" name="firstname" placeholder="Prénom" value = "<?= $author_info->firstname ?>" required>
        </div>

        <div class="form-group">
          <label for="lastname">Nom : </label>
          <input type="text" name="lastname" placeholder="Nom" value = "<?= $author_info->lastname ?>" required>
        </div>

        <div class="form-group">
          <label for="birth_year">Année de naissance : </label>
          <input type="text" name="birth_year" placeholder="Année de naissance" value = "<?= $author_info->birth_year ?>" required>
        </div>

        <div class="form-group">
          <label for="country">Pays d'origine : </label>
          <input type="text" name="country" placeholder="Pays d'origine" value = "<?= $author_info->country ?>" required>
        </div>

        <input type="submit" name="update" value="Enregistrer">
      </form>

    <?php endif ?>
  </div>
  <?php endif ?>
</div>
