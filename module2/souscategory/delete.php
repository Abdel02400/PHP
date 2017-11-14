<?php

if(isset($_GET['id_category']) && isset($_GET['id_souscategory'])){
  $id_category = $_GET['id_category'];
  $id_souscategory = $_GET['id_souscategory'];
  $query = $db->prepare('DELETE FROM souscategory WHERE id = :id_souscategory');
  $result = $query->execute(array(
    ':id_souscategory' => intval($id_souscategory)
  ));
  $url = '?route=souscategory/manage&id_category=' . $id_category;
  ($result) ? header('location:'. $url)
  : print("<p>L\'enregistrement de la sous catégorie a échoué</p>");
}

?>
