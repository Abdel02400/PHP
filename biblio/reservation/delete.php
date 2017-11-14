<?php
include_once('./class/RESERVATION.php');

if (isset($_GET['id_reservation']) && isset($_GET['id_book'])) {
  $id = $_GET['id_reservation'];
  $id_book = $_GET['id_book'];
  $delete_reservation = new Reservation($db,NULL, NULL, NULL);
  $delete_reservation->deleteReservation($id,$id_book);
}

?>
