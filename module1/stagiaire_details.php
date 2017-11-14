<?php
include('lib/functions.php');
include('datasource.php');
include_once('config.php');
include('header.php');

//print_r($_GET); // affiche le contenu du tableau associatif $_GET
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stagiaire = stagiaireParId($id);
  if ($stagiaire != NULL) {
    echo '<div class="container">';
    echo '<div class="row">';
    echo afficheStagiaireDetails($stagiaire);
    echo '</div>';
    $tab2 = stagiaireparmoyenne();
    function cmp($a, $b){
      if ($a['moyenne'] == $b['moyenne']) {
           return 0;
       }
       return ($a['moyenne'] < $b['moyenne']) ? 1 : -1;
    }

    usort($tab2 ,'cmp');

    echo '
    <div class="col-md-3">
      <div style="margin:3px; float:left; padding:10; border:1px #777 solid; width:100%">
        <h4>Meilleurs stagiaires</h4>
        <p style="font-size:1.5em; color:green">Stagiaire '. $tab2[0]['nom'] . " " . $tab2[0]['prenom'] . '  ('. $tab2[0]['moyenne'] .')</p>
        <p>Stagiaire '. $tab2[1]['nom'] . " " . $tab2[1]['prenom'] . '  ('. $tab2[1]['moyenne'] .')</p>
        <p>Stagiaire '. $tab2[2]['nom'] . " " . $tab2[2]['prenom'] . '  ('. $tab2[2]['moyenne'] .')</p>
      </div>
    </div>';
    echo '</div>';
  }
  else {
    echo "Stagiaire non trouvé";
  }
}
else {
  echo "Aucun paramètre Id fourni";

}
//var_dump($stagiaire);

?>



<?php
include('footer.php');
?>
