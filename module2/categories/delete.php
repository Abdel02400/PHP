<?php
//suppresion de la question dont l'id est passé en paramètre d'url
if(isset($_GET['id'])){

  $id = $_GET['id'];

  $query = $db->prepare('DELETE FROM categories WHERE id= :id');

  $result = $query->execute(array(
    ':id'    => intval($id)
  ));

  if($result) {

    $query2 = $db->prepare('DELETE FROM souscategory WHERE id_category = :id_category');
    $result2 = $query2->execute(array(
      ':id_category' => intval($id)
    ));
    ($result2) ? header('location:?route=category/manage')
    : print('La suppresion des réponses associé a échoué');

  }
  else{
    echo "la suppresion a échoué";
  }

}


?>
