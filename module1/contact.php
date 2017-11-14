<?php include('header.php'); ?>
<?php include('datasource.php'); ?>

<h2>Contact</h2>

<div class="container">
  <div class="row">
    <div class="col-md-9">
      <form  action="form.php" method="POST">
        <div class="form-group">
          <label for="objet">Objet</label>
          <input class="form-control" type="text" name="objet" />
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" name="message"></textarea>
        </div>

        <input type="submit" value="Valider">
      </form>
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
<?php include('footer.php'); ?>
