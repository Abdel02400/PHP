<?php
include_once('./class/BOOK.php');
include_once('./class/USER.php');
include_once('./class/RESERVATION.php');
if($role == 'Administrateur'){
  $reservation = new Reservation($db,NULL,NULL,NULL);
  $listreservation = $reservation->listReservation();
  $book = new Book($db,NULL,NULL,NULL,NULL, NULL);
  $user = new User($db,NULL,NULL,NULL);
}
if($role == 'Client') {
  $reservation = new Reservation($db,NULL,NULL,NULL);
  $listreservation = $reservation->listReservationById($id_userreservation);
  $book = new Book($db,NULL,NULL,NULL,NULL, NULL);
  $user = new User($db,NULL,NULL,NULL);
}
?>
<div class="row">

  <div class="col-md-8">
    <?php if($role == 'Administrateur'): ?>
    <h2>Liste des reservation</h2>
    <?php endif ?>
    <table class="table table-bordered table-striped">
        <tr>
          <th>#</th>
          <th>Livre réservé</th>
          <th>Personne qui la reserve</th>
          <th>Retour le</th>
          <th>Actions</th>
        </tr>
        <?php $i = 0 ?>
        <?php  if($listreservation == false): ?>
          <p class="alert alert-warning">Aucun reservation enregistrée</p>
        <?php else: ?>
        <?php foreach($listreservation as $reservation): ?>
          <tr>
            <td><?= ++$i ?></td>
            <td>
              <?php
                $id = $reservation->id_book;
                $namebook = $book->bookInfo($id);
              ?>
              <?= $namebook->title ?>
            </td>
            <td>
              <?php
                $id = $reservation->id_user;
                $nameuser = $user->userInfo($id);
              ?>
              <?= $nameuser->username ?>
            </td>
            <td><?= $reservation->retour ?></td>
            <td>
              <?php
                $urlDel = '?route=reservation/delete&id_reservation=' . $reservation->id;
                $urlDel .= '&id_book=' . $reservation->id_book;
              ?>
              <a
                href="<?= $urlDel ?>"
                class="btn btn-danger btn-xs">Supprimer</a>
            </td>
          </tr>
        <?php endforeach ?>
        <?php endif ?>
      </table>
  </div>
</div>
