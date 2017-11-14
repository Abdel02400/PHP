<?php
include('routes.php');
include_once('config.php');
$db = new PDO('mysql:host=localhost;dbname=quizz;charset=utf8','root','1993Aruu');


if(isset($_GET['route'])){
  $route = $_GET['route'];
}



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Module 2 : Quizz APP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH . 'css/style.css'?>">
  </head>
  <body>
    <div class="container">
      <h1>Module 2 : Quizz APP</h1>
      <header>
        <nav>
          <ul class="nav nav-tabs">
              <li><a href="?route=question/list">Liste des questions</a></li>
              <li><a href="?route=question/add">Ajouter une questions</a></li>
              <li><a href="?route=category/manage">Catégories</a></li>
              <li><a href="?route=qcm">QCM</a></li>
          </ul>
        </nav>
      </header>
    </div>
    <?php

    if(isset($route)){

      include($routes[$route]);
    }
    ?>
  </body>
</html>
