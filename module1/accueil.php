<?php

include('lib/functions.php');
include('datasource.php');
include('config.php');
$stagiaires = listeStagiaires();


?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="<?php echo ASSETS_PATH . 'js/tablesorter.js'?>"></script>
<script>
    $(document).ready(function() {
        $('#table').tablesorter();
    });
</script>
<?php include('header.php') ?>
  <div class="container mt-3">
    <h1 class="center titre">liste des stagiaires</h1>
    <div class="row">
      <div class="col-md-9">
        <table class="table table-striped table-bordered" id="table">
          <thead class="ligne1">
            <tr>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Photo du stagiaire</th>
              <th>Notes</th>
            </tr>
          </thead>
          <?php
            foreach($stagiaires as $i){
              echo '<tr>
              <td><a href="stagiaire_details.php?id='.$i['id'].'">' . strtoupper($i['nom']) . '</a></td>
              <td>' . verif1($i['prenom']) . '</td>
              <td><img src="' . ASSETS_PATH . 'img/totems/' . $i['totem'] . '"></td>
              <td>Toute les notes : ' . afficheallnote($i['note']) . '<br/>
              Dernière note : ' . afficherdernierenote($i['note']) . '<br/>
              Moyenne : ' . affichermoyenne($i['note']) . '
              </td>
              </tr>';
            }
          ?>
        </table>
      </div>
      <?php
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
      ?>
    </div>
  </div>
<?php include('footer.php') ?>
