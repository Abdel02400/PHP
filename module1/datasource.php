<?php
include('functions.php');

function listeStagiaires() {

  $stagiaires = array(

    array('id' => 1, 'nom' => 'abecassis', 'prenom' => 'stéphane', 'totem' => '1.jpg', 'note' => [8,0,18], 'mdp' => 'test1', 'role' => 'stagiaire'),
    array('id' => 2, 'nom' => 'chauve', 'prenom' => 'stevens', 'totem' => '2.jpg', 'note' => [18,10,17], 'mdp' => 'test2', 'role' => 'stagiaire'),
    array('id' => 3 ,'nom' => 'grivel', 'prenom' => 'sébastien', 'totem' => '3.jpg', 'note' => [10,], 'mdp' => 'test3', 'role' => 'stagiaire'),
    array('id' => 4 ,'nom' => 'messaoudi', 'prenom' => 'abdel', 'totem' => '1.jpg', 'note' => [20,20,20], 'mdp' => 'test4', 'role' => 'stagiaire'),
    array('id' => 5 ,'nom' => 'rerolle', 'prenom' => 'léa', 'totem' => '2.jpg', 'note' => [2,3,4], 'mdp' => 'test5', 'role' => 'stagiaire'),
    array('id' => 6 ,'nom' => 'pelé', 'prenom' => 'françois', 'totem' => '3.jpg', 'note' => [10,15,18], 'mdp' => 'test6', 'role' => 'stagiaire'),
    array('id' => 7 ,'nom' => 'langlais', 'prenom' => 'rémi', 'totem' => '1.jpg', 'note' => [12,14,17], 'mdp' => 'test7', 'role' => 'stagiaire'),
    array('id' => 8 ,'nom' => 'jaffari', 'prenom' => 'sajjad', 'totem' => '2.jpg', 'note' => [13,15,19], 'mdp' => 'test8', 'role' => 'stagiaire'),
    array('id' => 9 ,'nom' => 'vautour', 'prenom' => 'jessy', 'totem' => '3.jpg', 'note' => [10,15,17], 'mdp' => 'test9', 'role' => 'stagiaire'),
    array('id' => 10 ,'nom' => 'jeannine', 'prenom' => 'christiane', 'totem' => '1.jpg', 'note' => [10,17,14], 'mdp' => 'test10', 'role' => 'stagiaire')
  );
  return $stagiaires;
}

function stagiaireParId($id) {
  $stagiaire = NULL;
  foreach(listeStagiaires() as $s) {

    if ($s['id'] == $id) {
      $stagiaire = $s;
      break;
    }
  }
  return $stagiaire;
}

function stagiaireparmoyenne() {
  $tab2 = array();
  $stagiaire = listeStagiaires();
  for($i=0; $i<sizeof($stagiaire); $i++){

    $note = $stagiaire[$i]['note'];
    $resultat = 0;
    $moyenne = 0;
    $nbrnote = sizeof($note);

    foreach($note as $s){
      $moyenne += $s;
    }
    $resultat = round(($moyenne/$nbrnote), 2);

    $tab2[$i] = array('nom' => $stagiaire[$i]['nom'], 'prenom' => $stagiaire[$i]['prenom'], 'moyenne' => $resultat);
  }
  return $tab2;
}
?>
