<?php
include('routes.php');
include('bdd.php');

session_start();
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$id_userreservation = $_SESSION['id'];

if (isset($_GET['route'])) {
  $route = $_GET['route'];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>App biblio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>

    <header>
      <nav>
        <ul class="nav nav-tabs">
          <li><a href="?route=book/manage">Liste des livres</a></li>
          <li><a href="?route=author/manage">Liste des auteurs</a></li>
          <?php if($role == 'Administrateur'): ?>
          <li><a href="?route=user/manage">Liste des utilisateurs</a></li>
          <li><a href="?route=reservation/manage">Liste des reservations</a></li>
        <?php else: ?>
          <li><a href="?route=reservation/manage">Mes reservations</a></li>
          <?php endif ?>
          <li>
            <a href="logout.php"><span>Bienvenue <?= $username ?></span> (deconnexion)</a>
          </li>
        </ul>
      </nav>
    </header>

<div class="container">

  <h1 class="text-center">App biblio</h1>
  <?php
  if (isset($route)) include($routes[$route]);
  ?>

</div>
  </body>
</html>
