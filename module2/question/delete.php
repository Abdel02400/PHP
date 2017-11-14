<?php
//suppresion de la question dont l'id est passé en paramètre d'url
if(isset($_GET['id'])){

  $id = $_GET['id'];

  $query = $db->prepare('DELETE FROM question WHERE id= :id');

  $result = $query->execute(array(
    ':id'    => intval($id)
  ));

  if($result) {

    $query2 = $db->prepare('DELETE FROM answer WHERE id_question = :id_question');
    $result2 = $query2->execute(array(
      ':id_question' => intval($id)
    ));
    ($result2) ? header('location:?route=question/list')
    : print('La suppresion des réponses associé a échoué');

  }
  else{
    echo "la suppresion a échoué";
  }

}


?>
