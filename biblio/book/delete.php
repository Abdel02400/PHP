<?php
include_once('./class/BOOK.php');

if (isset($_GET['id_book'])) {
  $id = $_GET['id_book'];
  $delete_book = new Book($db,NULL, NULL, NULL, NULL, NULL);
  $delete_book->deleteBook($id);
}

?>
