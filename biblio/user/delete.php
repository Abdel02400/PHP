<?php
include_once('./class/USER.php');

if (isset($_GET['id_user'])) {
  $id = $_GET['id_user'];
  $delete_user = new User($db,NULL, NULL, NULL);
  $delete_user->deleteUser($id);
}

?>
