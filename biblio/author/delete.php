<?php
include_once('./class/AUTHOR.php');

if (isset($_GET['id_author'])) {
  $id = $_GET['id_author'];
  $delete_author = new Author($db,NULL, NULL, NULL, NULL);
  $delete_author->deleteAuthor($id);
}

?>
