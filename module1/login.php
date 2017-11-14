<?php
include('datasource.php');
$stagiaire = listeStagiaires();
session_start();



if (isset($_POST['nom']) && isset($_POST['mdp'])) {
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];

    foreach($stagiaire as $s) {

      if(($nom == $s['nom']) && ($mdp == $s['mdp'])) {

        if($s['role'] === 'stagiaire') {
        header('location:stagiaire_details.php?id='. $s['id'] .'');
        return true;

        }
      }
    }
    $_SESSION['erreur'] = "<p style='color:red'>Identifiant ou mot de passe incorrect</p>";
    header('location:index.php');

}
?>
