<?php
include_once('bdd.php');
include_once('config.php');
include_once('class/USER.php');
$erreur = NULL;
session_start();

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $requser = $db->prepare("SELECT * FROM  users WHERE username = ? AND password = ?");
    $requser->execute(array($username, $password));
    if($requser->rowCount() == 1) {
          $info = $requser->fetch(PDO::FETCH_OBJ);
          $_SESSION['username'] = $info->username;
          $_SESSION['role'] = $info->role;
          $_SESSION['id'] = $info->id;
          header('location:accueil.php');
    }
    else {
         $erreur = "<p style='color:red'>Identifiant ou mot de passe incorrect</p>";
    }
}
?>
<html>
  <head lang="fr">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH . 'css/style.css'?>">
    <title>Page de connexion</title>
  </head>
  <body>
    <div class="container">
          <h1 class="text-center">App Biblio</h1>
          <form class="form-signin" method="post">
            <h2 class="form-signin-heading text-center">Se connecter</h2>
            <label for="inputNom" class="sr-only">Nom</label>
            <input type="text" class="form-control" placeholder="Votre nom" name="username" required autofocus>
            <label for="inputPassword" class="sr-only">Mot de passe</label>
            <input type="password" class="form-control" placeholder="Votre mot de passe" name="password" required autofocus>
            <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Valider</button>
            <?php
              echo $erreur;
            ?>
          </form>
    </div>
  </body>
</html>
