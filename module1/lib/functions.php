<?php

function verif1($str) {

  $initial = $str[0];
  $reste = substr($str , 1);
  $initialMajus = strtoupper($initial);
  $resteMinus = strtolower($reste);

  return $initialMajus . $reste;
}

function afficheallnote($tab) {

  $nbrnote = sizeof($tab);
  $resultat = "";
  if ($nbrnote === 0) {

    $resultat = "Aucune Note";
    return $resultat;
  }
  else {

    foreach($tab as $i){
      $resultat .= $i . " , ";
    }
    return $resultat;
  }
}

function afficherdernierenote($tab) {

  $nbrnote = sizeof($tab);
  if ($nbrnote === 0) {

    $resultat = AUCUNE_NOTE_MSG ;
    return $resultat;
  }
  else {

    $resultat = $tab[$nbrnote - 1];
    return $resultat;
  }
}

function affichermoyenne($tab){

  $moyenne = 0;
  $nbrnote = sizeof($tab);
  if ($nbrnote === 0) {

    $resultat = "Aucune Moyenne";
    return $resultat;
  }
  else {

    foreach($tab as $i){
      $moyenne += $i;
    }

    $resultat = round(($moyenne/$nbrnote), 2);

    if($resultat < 10) {

      $resultat = "<span style='color:red'>" . $resultat . "</span>";
    }
    return $resultat;
  }
}

function afficheStagiaireDetails($stagiaire) {

  $output = '';
  $output .= '<div class="col-md-9">';
  $output .= '<h2>Infos concernant le stagiaire ' . strtoupper($stagiaire['nom']) . " " . verif1($stagiaire['prenom']) . '</h2>';
  $output .= '<img src="' . ASSETS_PATH . 'img/totems/' . $stagiaire['totem'] . '" alt ="" style="width:100%"';
  $output .= '</div>';

  return $output;
}

?>
