<?php
include_once('./class/AUTHOR.php');
include_once('./class/BOOK.php');
include_once('./class/RESERVATION.php');
$result = NULL;
$books = new Book($db,NULL,NULL,NULL, NULL, NULL);
$listbooks = $books->listBook();
$authors = new Author($db,NULL,NULL,NULL, NULL);
$listauthors = $authors->listAuthor();
if(isset($_POST['submit'])){
  $title = $_POST['title'];
  $isbn = $_POST['isbn'];
  $nb_pages = $_POST['nb_pages'];
  $id_author = $_POST['id_author'];
  $etat = $_POST['etat'];
  $addbook = new Book($db, $title, $isbn, $nb_pages, $id_author, $etat);
  $cond1 = $_POST['id_author']   != "0";
  $cond2 = $_POST['etat']   != "0";
  if($cond1 && $cond2){
    $addbook->addBook();
  }
  else {
    $result = "Veuillez remplir les champs manquant";
  }
}
if(isset($_GET['edit'])){
  $id_book = $_GET['id_book'];
  $edit_book = new Book($db,NULL,NULL,NULL, NULL, NULL);
  $book_info = $edit_book->bookInfo($id_book);
  $authors = new Author($db,NULL,NULL,NULL, NULL);
  $listauthors = $authors->listAuthor();
  if(isset($_POST['update'])){
    $title = $_POST['title'];
    $isbn = $_POST['isbn'];
    $nb_pages = $_POST['nb_pages'];
    $id_author = $_POST['id_author'];
    $etat = $_POST['etat'];
    $edit_book = new Book($db, $title, $isbn, $nb_pages, $id_author, $etat);
    $cond1 = $_POST['id_author']   != "0";
    $cond2 = $_POST['etat']   != "0";
    if($cond1 && $cond2){
      $edit_book->editBook($id_book);
    }
    else {
      $result = "Veuillez remplir les champs manquant";
    }
  }
}
if(isset($_GET['reservation'])){
  $id_book = $_GET['id_book'];
  $reservate_book = new Book($db,NULL,NULL,NULL, NULL, NULL);
  $book_info = $reservate_book->bookInfo($id_book);
  if(isset($_POST['reservate'])){
    $retour = $_POST['retour'];
    $reservation = new Reservation($db, $id_book, $id_userreservation, $retour);
    $reservation->addReservation();
  }
}
?>
<div class="row">

  <div class="col-md-8">
    <h2>Liste des livres</h2>
    <table class="table table-bordered table-striped">
        <tr>
          <th>#</th>
          <th>Titre</th>
          <th>ISBN</th>
          <th>Nombre de pages</th>
          <th>Auteur du livre</th>
          <?php if($role == 'Administrateur'): ?>
          <th>Actions</th>
          <?php endif ?>
          <th>Etat</th>
        </tr>
        <?php $i = 0 ?>
        <?php  if($listbooks == false): ?>
          <p class="alert alert-warning">Aucun livre enregistrée</p>
        <?php else: ?>
        <?php foreach($listbooks as $book): ?>
          <tr>
            <td><?= ++$i ?></td>
            <td><?= $book->title ?></td>
            <td><?= $book->isbn ?></td>
            <td><?= $book->nb_pages ?></td>
            <?php
             $id = $book->id_author;
             $authorbyid = $authors->getAuthorById($id);
            ?>
            <td><?= $authorbyid->firstname ?> <?= $authorbyid->lastname ?></td>
            <?php if($role == 'Administrateur'): ?>
            <td>
              <?php
                $urlDel = '?route=book/delete&id_book=' . $book->id;

                $urlEdit = '?route=book/manage&id_book=' . $book->id;
                $urlEdit .= '&edit=true';
              ?>
              <a
                href="<?= $urlEdit ?>"
                class="btn btn-default btn-xs">Modifier</a>
              <a
                href="<?= $urlDel ?>"
                class="btn btn-danger btn-xs">Supprimer</a>
            </td>
            <?php endif ?>
            <?php
              $urlRes = '?route=book/manage&id_book=' . $book->id;
              $urlRes .= '&reservation=true';
            ?>
            <td>
              <?= $book->etat ?>
              <?php if($book->etat == 'Disponible'):?>
                <?php if($role == "Client"): ?>
                <a
                  href="<?= $urlRes ?>"
                  class="btn btn-primary btn-xs">Réserver</a>
                <?php endif ?>
              <?php else: ?>
              <?php
              $id_retour = $book->id;
              $reservationretour = $books->getRetourById($id_retour);
              ?>
              Jusqu'au <?= $reservationretour->retour ?>
            <?php endif ?>
            </td>
          </tr>
        <?php endforeach ?>
        <?php endif ?>
      </table>
  </div>

  <div class="col-md-4">
    <?php if($role == "Administrateur"): ?>
    <?php if(!isset($_GET['edit']) && !isset($_GET['reservation'])): ?>
      <h3>Ajouter un livre</h3>
      <form class="well" method="POST">

        <div class="form-group">
          <label for="title">Titre : </label>
          <input type="text" name="title" placeholder="Titre" required>
        </div>

        <div class="form-group">
          <label for="isbn">ISBN : </label>
          <input type="text" name="isbn" placeholder="ISBN" required>
        </div>

        <div class="form-group">
          <label for="nb_pages">Nombre de pages : </label>
          <input type="text" name="nb_pages" placeholder="Nombre de pages" required>
        </div>

        <div class="form-group">
          <label for="id_author">Choix de l'auteur : </label>
          <select name="id_author">
            <option value="0">Choisir un auteur</option>
            <?php foreach($listauthors as $author): ?>
              <option value="<?=$author->id ?>"><?= $author->firstname ?> <?= $author->lastname ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="etat">etat : </label>
          <select name="etat">
            <option value="0">Choisir la disponibilité</option>
            <option value="1">Disponible</option>
            <option value="2">Indisponible</option>
          </select>
        </div>
        <?php echo "<p style='color:red' >" . $result . '</p>'; ?>

        <input type="submit" name="submit" value="Enregistrer">
      </form>
    <?php elseif(isset($_GET['edit'])): ?>

      <h3>Modifier un livre</h3>
      <form class="well" method="POST">

        <div class="form-group">
          <label for="title">Titre : </label>
          <input type="text" name="title" placeholder="Titre" value="<?= $book_info->title ?>" required>
        </div>

        <div class="form-group">
          <label for="isbn">ISBN : </label>
          <input type="text" name="isbn" placeholder="ISBN" value="<?= $book_info->isbn ?>" required>
        </div>

        <div class="form-group">
          <label for="nb_pages">Nombre de pages : </label>
          <input type="text" name="nb_pages" placeholder="Nombre de pages" value="<?= $book_info->nb_pages ?>" required>
        </div>

        <div class="form-group">
          <label for="id_author">Choix de l'auteur : </label>
          <select name="id_author">
            <option value="0">Choisir un auteur</option>
            <?php foreach($listauthors as $author): ?>
              <?php if($book_info->id_author == $author->id): ?>
                <option value="<?=$author->id ?>" selected><?= $author->firstname ?> <?= $author->lastname ?></option>
              <?php else: ?>
                <option value="<?=$author->id ?>"><?= $author->firstname ?> <?= $author->lastname ?></option>
              <?php endif ?>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="etat">Etat : </label>
          <select name="etat">
            <option value="0">Choisir la disponibilité</option>
              <?php if($book_info->etat == "Disponible"): ?>
                <option selected value="1">Disponible</option>
                <option value="2">Indisponible</option>
              <?php else: ?>
                <option selected value="2">Indisponible</option>
                <option value="1">Disponible</option>
              <?php endif ?>
          </select>
        </div>
        <?php echo "<p style='color:red' >" . $result . '</p>'; ?>

        <input type="submit" name="update" value="Enregistrer">
      </form>
    <?php endif ?>
    <?php elseif(isset($_GET['reservation'])): ?>
      <h3>Réserver un livre</h3>
      <form class="well" method="POST">

        <div class="form-group">
          <label for="book">Titre : </label>
          <input type="text" name="book" placeholder="<?= $book_info->title ?>" readonly>
        </div>

        <div class="form-group">
          <label for="retour">Date de retour prévu le : </label>
          <input type="text" name="retour" placeholder="Date de retour prévu le : " required>
        </div>

        <input type="hidden" name="id_book" value="<?= $book_info->id ?>">
        <input type="submit" name="reservate" value="Enregistrer">
      </form>
    <?php endif ?>
  </div>
</div>
